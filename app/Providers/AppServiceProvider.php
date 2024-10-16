<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

use App\Models\Pengaju;
use App\Models\Status;
use App\Models\User;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        view()->composer(['pengaju.status', 'pengaju.result', 'pengaju.dashboard'], function ($view) {
            $userId = Auth::id();
            $pengajus = Pengaju::where('user_id', $userId)->get();
            $view->with('pengajus', $pengajus);

            $latestPengajus = Pengaju::where('user_id', $userId)
                ->latest()
                ->limit(3)
                ->get();

            // Mengirim data ke view
            $view->with('latestPengajus', $latestPengajus);
        });

        view()->composer(['approval.status'], function ($view) {
            // Ambil semua pengajuan untuk approval, kecualikan yang forwarded_at tidak null
            $pengajus = Pengaju::whereNull('forwarded_at') // Tambahkan filter forwarded_at null
                ->whereDoesntHave('keterangan', function ($query) {
                    // Menggunakan keterangan_data untuk mengecualikan data dari bendahara yayasan
                    $query->where('keterangan_data', 'LIKE', '%bendahara yayasan%');
                })
                ->with(['user', 'keterangan']) // Load relasi user dan keterangan
                ->get();

            // Ambil status yang diperlukan
            $statusPending = Status::where('status', 'pending')->first()->id;

            $view->with([
                'pengajus' => $pengajus,
                'statusPending' => $statusPending
            ]);
        });

        View::composer(['pengaju.detailp', 'pengaju.details', 'approval.detailstat', 'accountant.detail', 'accountant.detailket', 'bendaharay.detail', 'bendahara.detail'], function ($view) {
            // Ambil ID dari parameter rute
            $id = Route::current()->parameter('id');

            // Cari data pengaju berdasarkan ID
            $pengaju = Pengaju::find($id);

            // Kirimkan data pengaju ke view
            $view->with('pengaju', $pengaju);
        });

        Carbon::setLocale('id');

        View::composer(
            ['pengaju.dashboard', 'superadmin.dashboard', 'accountant.dashboard', 'bendahara.dashboard', 'bendaharay.dashboard', 'approval.status'],
            function ($view) {
                $view->with([
                    'currentDate' => Carbon::now()->isoFormat('dddd, D MMMM YYYY'),
                    // Tambahkan data lain yang ingin dibagikan ke semua dashboard
                ]);
            }
        );

        // Membuat variabel approvedPengajus tersedia di semua view
        View::composer(['accountant.data', 'accountant.dashboard', 'accountant.rekap'], function ($view) {
            // Ambil ID status "Setujui"
            $setujuStatusId = Status::where('status', 'Setujui')->first()->id;

            // Mengambil data pengajuan yang sudah disetujui dan tidak memiliki keterangan dari bendahara yayasan
            $approvedPengajus = Pengaju::where('id_status', $setujuStatusId)
                ->whereNull('forwarded_at')
                ->whereDoesntHave('keterangan', function ($query) {
                    // Menggunakan keterangan_data untuk mengecualikan data dari bendahara yayasan
                    $query->where('keterangan_data', 'LIKE', '%bendahara yayasan%');
                })
                ->with(['user', 'keterangan']) // Load relasi user dan keterangan
                ->get();

            $totaldat = $approvedPengajus->count();

            // Ambil ID status untuk pengajuan yang "Tolak"
            $tolakStatusId = Status::where('status', 'Tolak')->first()->id;

            // ID user untuk Bendahara Yayasan
            $bendaharaYayasanId = 10;

            // Mengambil semua pengajuan dengan relasi 'user' dan 'keterangan'
            $pengajus = Pengaju::with(['user', 'keterangan'])->get();

            // Filter pengajuan yang ditolak oleh bendahara yayasan
            $filteredPengajus = $pengajus->filter(function ($pengaju) use ($bendaharaYayasanId) {
                $keteranganData = $pengaju->keterangan->keterangan_data ?? null;

                // Jika keterangan_data adalah string JSON, decode menjadi array
                if (is_string($keteranganData)) {
                    $keteranganData = json_decode($keteranganData, true);
                }

                // Pastikan keterangan_data adalah array
                if (!is_array($keteranganData)) {
                    return false;
                }

                // Periksa apakah 'bendahara yayasan' ada di dalam keterangan_data
                $bendaharaData = $keteranganData['bendahara yayasan'] ?? null;

                // Abaikan jika tidak ada data untuk Bendahara Yayasan
                if (is_null($bendaharaData)) {
                    return false;
                }

                // Cek apakah id_status adalah 2 (Tolak)
                return $bendaharaData['id_status'] == 2;
            });

            // Proses pengajuan ditunda (status Ditunda)
            $filteredPengajus->each(function ($pengaju) {
                $keteranganData = $pengaju->keterangan->keterangan_data ?? null;

                if (is_string($keteranganData)) {
                    $keteranganData = json_decode($keteranganData, true);
                }

                if (is_array($keteranganData)) {
                    $bendaharaData = $keteranganData['bendahara yayasan'] ?? null;

                    if ($bendaharaData && $bendaharaData['id_status'] == 2) {
                        $pengaju->status = (object) [
                            'id' => $bendaharaData['id_status'],
                            'status' => 'Ditunda',
                            'badge_class' => 'badge-danger'
                        ];
                        $pengaju->displayed_keterangan = $bendaharaData['keterangan'] ?? 'Tidak ada keterangan.';
                    }
                }
            });

            // Pengajuan menunggu (status Menunggu)
            $pendingPengajus = $pengajus->filter(function ($pengaju) {
                $keteranganData = $pengaju->keterangan->keterangan_data ?? null;

                if (is_string($keteranganData)) {
                    $keteranganData = json_decode($keteranganData, true);
                }

                if (is_array($keteranganData)) {
                    $bendaharaData = $keteranganData['bendahara yayasan'] ?? null;
                    return is_null($bendaharaData) && !is_null($pengaju->forwarded_at);
                }

                return false;
            });

            // Proses pengajuan menunggu
            $pendingPengajus->each(function ($pengaju) {
                $pengaju->status = (object) [
                    'id' => null,
                    'status' => 'Menunggu',
                    'badge_class' => 'badge-secondary'
                ];
                $pengaju->displayed_keterangan = 'Pengajuan sudah diteruskan, menunggu tindakan Bendahara Yayasan.';
            });

            // Gabungkan pengajuan ditunda dan menunggu
            $finalPengajus = $filteredPengajus->merge($pendingPengajus);

            // Hitung total rekap
            $totalrek = $finalPengajus->count();

            // Kirimkan variabel ke view
            $view->with(compact('approvedPengajus', 'finalPengajus', 'totaldat', 'totalrek'));
        });

        // Menggunakan view composer untuk mengirimkan data ke seluruh tampilan
        View::composer(['bendaharay.data', 'bendaharay.dashboard'], function ($view) {
            // Mengambil semua pengajuan yang sudah diteruskan ke bendahara yayasan
            $forwardedPengajus = Pengaju::whereNotNull('forwarded_at')
                ->whereDoesntHave('keterangan', function ($query) {
                    // Menggunakan keterangan_data untuk mengecualikan data dari bendahara yayasan
                    $query->where('keterangan_data', 'LIKE', '%bendahara yayasan%');
                })
                ->with(['user', 'keterangan']) // Load relasi user dan keterangan
                ->get();

            $totaldat = $forwardedPengajus->count();

            // Mengirim data ke semua tampilan
            $view->with([
                'forwardedPengajus' => $forwardedPengajus,
                'totaldat' => $totaldat
            ]);
        });

        View::composer(['bendahara.status', 'bendahara.dashboard'], function ($view) {
            // Mengambil semua pengajuan yang sudah diteruskan ke bendahara yayasan dengan status 1
            $approvedPengajus = Pengaju::whereNotNull('forwarded_at')
                ->where('id_status', 1) // Hanya ambil yang statusnya 1
                ->whereHas('keterangan', function ($query) {
                    // Menggunakan keterangan_data untuk mengecualikan data dari bendahara yayasan
                    $query->where('keterangan_data', 'LIKE', '%bendahara yayasan%');
                })
                ->with(['user', 'keterangan']) // Load relasi user dan keterangan
                ->get();

            $total = $approvedPengajus->count();

            // Mengirim data ke semua tampilan
            $view->with([
                'approvedPengajus' => $approvedPengajus,
                'total' => $total
            ]);
        });

        View::composer(['superadmin.daftarakun', 'superadmin.dashboard'], function ($view) {
            $users = User::join('roles', 'users.role', '=', 'roles.id')
                ->select('users.*', 'roles.role as role_name')
                ->get();

            $total = $users->count();

            // Mengirim data ke semua tampilan
            $view->with([
                'users' => $users,
                'total' => $total
            ]);
        });
    }
}
