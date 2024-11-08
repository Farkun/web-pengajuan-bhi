<?php

namespace App\Http\Controllers;

use App\Notifications\StatusNotification;
use Illuminate\Http\Request;
use App\Models\Pengaju;
use App\Models\Keterangan;
use App\Models\Status;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use Notification;

class ApprovalController extends Controller
{
    public function index()
    {
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

        // Kirim data ke view
        return view('approval.status', [
            'pengajus' => $pengajus,
            'statusPending' => $statusPending
        ]);
    }

    public function store(Request $request)
    {
        // Validasi input
        $request->validate([
            'pengaju_id' => 'required|exists:pengajus,id',
            'keterangan' => 'nullable|string',
            'status' => 'required|string',
            'user_id' => 'required|exists:users,id',
        ]);

        // Temukan pengajuan berdasarkan ID
        $pengaju = Pengaju::findOrFail($request->pengaju_id);

        // Dapatkan ID pengguna yang sedang login
        $userId = Auth::id();

        // Ambil data keterangan yang ada atau buat baru jika tidak ada
        $keterangan = $pengaju->keterangan()->firstOrCreate([]);

        // Ambil data keterangan yang ada dan tambahkan keterangan baru
        $keteranganData = $keterangan->keterangan_data ?? [];

        if ($userId == 3) { // Misalnya Cindy memiliki ID 3
            $keteranganData['cindy'] = [
                'id' => $userId,
                'keterangan' => $request->keterangan,
                'id_status' => Status::firstOrCreate(['status' => $request->status])->id
            ];
        } elseif ($userId == 9) { // Misalnya Runi memiliki ID 9
            $keteranganData['runi'] = [
                'id' => $userId,
                'keterangan' => $request->keterangan,
                'id_status' => Status::firstOrCreate(['status' => $request->status])->id
            ];
        }

        // Simpan data keterangan ke tabel
        $keterangan->update([
            'keterangan_data' => $keteranganData,
        ]);

        // Update pengajuan dengan ID keterangan
        $pengaju->update([
            'id_keterangan' => $keterangan->id,
        ]);

        // Tentukan status akhir berdasarkan keterangan
        $finalStatus = $this->determineFinalStatus($pengaju->id);

        // Update status pengajuan dengan status akhir yang ditentukan
        if ($finalStatus) {
            $pengaju->update([
                'id_status' => $finalStatus,
            ]);
        }

        if ($finalStatus) {
            // Tentukan pesan notifikasi berdasarkan finalStatus
            switch ($finalStatus) {
                case 1:
                    $message = 'Approval Menyetujui Data Pengajuan';
                    break;
                case 2:
                    $message = 'Approval Menolak Data Pengajuan';
                    break;
                case 3:
                    $message = 'Approval Pending Data Pengajuan';
                    break;
                default:
                    $message = 'Approval Status Tidak Diketahui';
                    break;
            }
        
            // Kirim notifikasi ke pengaju berdasarkan pengaju_id
            $userPengaju = User::find($pengaju->user_id);
            if ($userPengaju) {
                $userPengaju->notify(new StatusNotification($pengaju, $message));
            }
        
            // Jika status adalah 1 (Setuju), kirim notifikasi ke semua accountant
            if ($finalStatus == 1) {
                $userAccountants = User::where('role', 4)->get();
                Notification::send($userAccountants, new StatusNotification($pengaju, $message));
            }
        }

        return response()->json(['success' => true, 'message' => 'Keterangan berhasil disimpan.']);
    }

    protected function determineFinalStatus($pengajuId)
    {
        // Ambil pengajuan berdasarkan ID
        $pengaju = Pengaju::findOrFail($pengajuId);

        // Ambil semua keterangan terkait pengajuan melalui relasi
        $keterangan = $pengaju->keterangan;

        // Jika tidak ada keterangan, kembalikan status 'belum dibaca'
        if (!$keterangan) {
            return Status::where('status', 'belum dibaca')->first()->id;
        }

        // Mendapatkan ID status dari tabel statuses
        $statusTolak = Status::where('status', 'Tolak')->first()->id;
        $statusSetuju = Status::where('status', 'Setujui')->first()->id;
        $statusPending = Status::where('status', 'Pending')->first()->id;

        // Ambil status berdasarkan user dari keterangan_data
        $statusCindy = $keterangan->keterangan_data['cindy']['id_status'] ?? null;
        $statusRuni = $keterangan->keterangan_data['runi']['id_status'] ?? null;

        if ($statusCindy && $statusRuni) {
            if ($statusCindy == $statusTolak || $statusRuni == $statusTolak) {
                return $statusTolak;
            }
            if ($statusCindy == $statusSetuju && $statusRuni == $statusSetuju) {
                return $statusSetuju;
            }
            if ($statusCindy == $statusPending || $statusRuni == $statusPending) {
                return $statusPending;
            }
        } elseif ($statusCindy) {
            if ($statusCindy == $statusTolak) {
                return $statusTolak;
            }
            if ($statusCindy == $statusPending) {
                return $statusPending;
            }
            if ($statusCindy == $statusSetuju && !$statusRuni) {
                return null; // Belum semua pihak memberikan persetujuan
            }
        } elseif ($statusRuni) {
            if ($statusRuni == $statusTolak) {
                return $statusTolak;
            }
            if ($statusRuni == $statusPending) {
                return $statusPending;
            }
            if ($statusRuni == $statusSetuju && !$statusCindy) {
                return null; // Belum semua pihak memberikan persetujuan
            }
        }

        // Default jika tidak ada status yang ditetapkan
        return null; // Atau nilai khusus lain
    }

    public function laporan()
    {
        // Ambil data pengajuan yang sudah cair
        $pengajuans = Pengaju::where('id_statusdana', 1)->get();

        // Kirim data pengajuan ke view
        return view('approval.laporan', compact('pengajuans'));
    }

    public function showDashboard()
    {
        // Ambil semua data pencairan
        $totalCairSelasa = Pengaju::whereNotNull('forwarded_at')
            ->where('id_statusdana', 1) // Asumsi kolom status cair menandakan dana sudah dicairkan
            ->whereDay('tanggal', '=', Carbon::now()->startOfWeek()->addDays(1)->day) // Selasa
            ->sum('total'); // Menghitung total dana cair di hari Selasa

        $totalCairJumat = Pengaju::whereNotNull('forwarded_at')
            ->where('id_statusdana', 1)
            ->whereDay('tanggal', '=', Carbon::now()->startOfWeek()->addDays(4)->day) // Jumat
            ->sum('total'); // Menghitung total dana cair di hari Jumat

        $totalCairMinggu = Pengaju::whereNotNull('forwarded_at')
            ->where('id_statusdana', 1)
            ->whereBetween('tanggal', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()])
            ->sum('total'); // Menghitung total dana cair selama minggu ini

        // Persentase berdasarkan total mingguan (contoh)
        $persenSelasa = ($totalCairMinggu > 0) ? ($totalCairSelasa / $totalCairMinggu) * 100 : 0;
        $persenJumat = ($totalCairMinggu > 0) ? ($totalCairJumat / $totalCairMinggu) * 100 : 0;

        // Mengirimkan data ke view
        return view('approval.laporan', [
            'totalSelasa' => $totalCairSelasa,
            'totalJumat' => $totalCairJumat,
            'totalMinggu' => $totalCairMinggu,
            'persenSelasa' => $persenSelasa,
            'persenJumat' => $persenJumat,
            'tanggalSelasa' => Carbon::now()->startOfWeek()->addDays(1)->format('d F Y'),
            'tanggalJumat' => Carbon::now()->startOfWeek()->addDays(4)->format('d F Y'),
        ]);
    }

    public function show($id)
    {
        return view('approval.detailstat', ['id' => $id]);
    }

    public function shows($id)
    {
        return view('approval.detaillap', ['id' => $id]);
    }


}
