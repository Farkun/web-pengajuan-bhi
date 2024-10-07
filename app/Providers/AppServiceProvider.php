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
            // Ambil semua pengajuan untuk approval
            $pengajus = Pengaju::whereDoesntHave('keterangan', function ($query) {
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

        View::composer(['pengaju.detailp', 'pengaju.details', 'approval.detailstat', 'accountant.detail', 'accountant.detailket', 'bendaharay.detail'], function ($view) {
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
        View::composer(['accountant.data'], function ($view) {
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

            // Bagikan data ke semua views di dalam folder accountant
            $view->with('approvedPengajus', $approvedPengajus);
        });

        // Menggunakan view composer untuk mengirimkan data ke seluruh tampilan
        View::composer('bendaharay.data', function ($view) {
            // Mengambil semua pengajuan yang sudah diteruskan ke bendahara yayasan
            $forwardedPengajus = Pengaju::whereNotNull('forwarded_at')
                ->whereDoesntHave('keterangan', function ($query) {
                    // Menggunakan keterangan_data untuk mengecualikan data dari bendahara yayasan
                    $query->where('keterangan_data', 'LIKE', '%bendahara yayasan%');
                })
                ->with(['user', 'keterangan']) // Load relasi user dan keterangan
                ->get();

            // Mengirim data ke semua tampilan
            $view->with('forwardedPengajus', $forwardedPengajus);
        });
    }
}
