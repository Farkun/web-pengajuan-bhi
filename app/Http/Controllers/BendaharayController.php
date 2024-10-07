<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pengaju;
use App\Models\Keterangan;
use App\Models\Status;
use Illuminate\Support\Facades\Auth;

class BendaharayController extends Controller
{
    public function index()
    {
        // Mengambil semua pengajuan yang sudah diteruskan ke bendahara yayasan
        $forwardedPengajus = Pengaju::whereNotNull('forwarded_at')
            ->whereDoesntHave('keterangan', function ($query) {
                // Menggunakan keterangan_data untuk mengecualikan data dari bendahara yayasan
                $query->where('keterangan_data', 'LIKE', '%bendahara yayasan%');
            })
            ->with(['user', 'keterangan']) // Load relasi user dan keterangan
            ->get();

        // Mengirim data ke view 'bendahara.index'
        return view('bendaharay.data', compact('forwardedPengajus'));
    }

    public function show($id)
    {
        return view('bendaharay.detail', ['id' => $id]);
    }

    public function store(Request $request)
    {
        \Log::info('Request data:', $request->all());

        $request->validate([
            'pengaju_id' => 'required|exists:pengajus,id',
            'keterangan' => 'required|string',
            'status' => 'required|string',
            'user_id' => 'required|exists:users,id',
        ]);

        $pengaju = Pengaju::find($request->pengaju_id);

        if ($pengaju) {
            // Set forwarded_at menjadi null untuk mengembalikan ke accountant
            $pengaju->forwarded_at = null;
            $pengaju->save();

            // Temukan entri keterangan berdasarkan id_keterangan dari tabel pengajus
            $keterangan = Keterangan::find($pengaju->id_keterangan);

            if (!$keterangan) {
                // Jika tidak ada keterangan, buat entri baru
                $keterangan = new Keterangan();
                $keterangan->keterangan_data = json_encode([]); // Atur default jika diperlukan
                $keterangan->save();

                // Update pengaju dengan id_keterangan yang baru
                $pengaju->update([
                    'id_keterangan' => $keterangan->id,
                ]);
            }

            // Ambil data keterangan yang ada atau buat array baru jika kosong
            $keteranganData = $keterangan->keterangan_data;

            // Cek apakah $keteranganData masih berupa string JSON atau sudah array
            if (is_string($keteranganData)) {
                $keteranganData = json_decode($keteranganData, true);
            } elseif (!is_array($keteranganData)) {
                $keteranganData = []; // Jika bukan string JSON atau array, buat array kosong
            }

            \Log::info('Keterangan Data Sebelum Update:', $keteranganData);

            // Tambahkan data untuk bendahara sesuai dengan format yang mirip dengan approval
            $keteranganData['bendahara yayasan'] = [
                'id' => Auth::id(),
                'keterangan' => $request->keterangan,
                'id_status' => 2  // Contoh status 'Tolak'
            ];

            \Log::info('Keterangan Data Setelah Update:', $keteranganData);

            // Simpan data keterangan yang telah diperbarui ke dalam kolom JSON
            $keterangan->keterangan_data = json_encode($keteranganData);
            $keterangan->save();

            return response()->json([
                'success' => true,
                'message' => 'Pengajuan berhasil ditolak dan dikembalikan ke accountant.'
            ]);
        }

        return response()->json([
            'success' => false,
            'message' => 'Pengajuan tidak ditemukan.'
        ]);
    }

    public function approveAll(Request $request)
    {
        $user = Auth::user();

        // Ambil semua pengajuan yang telah diteruskan ke Bendahara Yayasan
        // dan belum disetujui oleh Bendahara Yayasan
        $pengajus = Pengaju::whereNotNull('forwarded_at')
            ->whereHas('keterangan', function ($query) {
                $query->where(function ($subQuery) {
                    // Cek apakah di JSON `keterangan_data->bendahara yayasan->id_status` belum ada status "Setuju" (id_status = 1)
                    $subQuery->whereJsonDoesntContain('keterangan_data->bendahara yayasan->id_status', 1);
                });
            })->get();

        if ($pengajus->isEmpty()) {
            return response()->json([
                'success' => false,
                'message' => 'Tidak ada pengajuan yang tersedia untuk disetujui.'
            ]);
        }

        foreach ($pengajus as $pengaju) {
            // Temukan atau buat entri keterangan
            $keterangan = Keterangan::find($pengaju->id_keterangan);
            if (!$keterangan) {
                $keterangan = new Keterangan();
                $keterangan->keterangan_data = json_encode([]);
                $keterangan->save();
                $pengaju->update(['id_keterangan' => $keterangan->id]);
            }

            // Update keterangan_data untuk Bendahara Yayasan
            $keteranganData = $keterangan->keterangan_data;
            if (is_string($keteranganData)) {
                $keteranganData = json_decode($keteranganData, true);
            } elseif (!is_array($keteranganData)) {
                $keteranganData = [];
            }

            $keteranganData['bendahara yayasan'] = [
                'id' => $user->id,
                'keterangan' => null,
                'id_status' => 1 // Status 'Setuju'
            ];

            // Simpan keterangan
            $keterangan->keterangan_data = json_encode($keteranganData);
            $keterangan->save();

            // Pengajuan di-forward ke Bendahara (tidak null)
            $pengaju->forwarded_at = now();
            $pengaju->save();
        }

        return response()->json([
            'success' => true,
            'message' => 'Semua pengajuan berhasil disetujui dan diteruskan ke Bendahara.'
        ]);
    }
}
