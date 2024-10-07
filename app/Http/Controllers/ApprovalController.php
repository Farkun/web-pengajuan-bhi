<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pengaju;
use App\Models\Keterangan;
use App\Models\Status;
use Illuminate\Support\Facades\Auth;

class ApprovalController extends Controller
{
    public function index()
    {
        // Ambil semua pengajuan untuk approval
        $pengajus = Pengaju::whereDoesntHave('keterangan', function ($query) {
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

    public function show($id)
    {
        return view('approval.detailstat', ['id' => $id]);
    }

    public function shows($id)
    {
        return view('approval.detaillap', ['id' => $id]);
    }


}
