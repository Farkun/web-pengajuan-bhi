<?php

namespace App\Http\Controllers;

use App\Models\Pengaju;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\User;
use App\Notifications\SendNotification;
use Notification;

class AccountantController extends Controller
{
    private function getApprovedPengajus()
    {
        // Ambil ID status "Setujui"
        $setujuStatusId = \App\Models\Status::where('status', 'Setujui')->first()->id;

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

        return compact('approvedPengajus', 'totaldat');
    }

    // Method untuk halaman dashboard
    public function accountantDashboard()
    {
        // Ambil data pengajuan yang sudah disetujui
        $approvedPengajus = $this->getApprovedPengajus();

        // Ambil data pengajuan yang sudah diteruskan
        $forwardedPengajus = $this->getForwardedPengajus();

        // Gabungkan data dari kedua method
        $data = array_merge($approvedPengajus, $forwardedPengajus);

        // Kirimkan semua data ke view
        return view('accountant.dashboard', $data);
    }

    // Method untuk halaman index
    public function index()
    {
        $data = $this->getApprovedPengajus();
        return view('accountant.index', $data);
    }

    public function getForwardedPengajus()
    {
        // ID user untuk Bendahara Yayasan
        $bendaharaYayasanId = 10;

        // Mengambil semua pengajuan dengan relasi 'user' dan 'keterangan'
        $pengajus = Pengaju::with(['user', 'keterangan'])
            ->get();

        $filteredPengajus = $pengajus->filter(function ($pengaju) use ($bendaharaYayasanId) {
            // Ambil keterangan_data dari relasi keterangan
            $keteranganData = $pengaju->keterangan->keterangan_data ?? null;

            // Jika keterangan_data berbentuk string JSON, decode menjadi array
            if (is_string($keteranganData)) {
                $keteranganData = json_decode($keteranganData, true);
            }

            // Pastikan keterangan_data adalah array, jika tidak, abaikan pengajuan ini
            if (!is_array($keteranganData)) {
                return false;
            }

            // Periksa apakah 'bendahara yayasan' ada di dalam keterangan_data
            $bendaharaData = $keteranganData['bendahara yayasan'] ?? null;

            // Jika tidak ada data untuk Bendahara Yayasan, abaikan pengajuan ini
            if (is_null($bendaharaData)) {
                return false;
            }

            // Cek apakah id_status dari Bendahara Yayasan adalah 2 (Tolak)
            return $bendaharaData['id_status'] == 2;
        });

        // Proses setiap pengajuan yang sudah difilter (untuk status Ditunda)
        $filteredPengajus->each(function ($pengaju) {
            $keteranganData = $pengaju->keterangan->keterangan_data ?? null;

            // Decode jika keterangan_data berbentuk string JSON
            if (is_string($keteranganData)) {
                $keteranganData = json_decode($keteranganData, true);
            }

            // Pastikan $keteranganData adalah array
            if (is_array($keteranganData)) {
                // Ambil data Bendahara Yayasan
                $bendaharaData = $keteranganData['bendahara yayasan'] ?? null;

                if ($bendaharaData && $bendaharaData['id_status'] == 2) { // Status Tolak (Ditunda)
                    $pengaju->status = (object) [
                        'id' => $bendaharaData['id_status'],
                        'status' => 'Ditunda',
                        'badge_class' => 'badge-danger'
                    ];
                    $pengaju->displayed_keterangan = $bendaharaData['keterangan'] ?? 'Tidak ada keterangan.';
                }
            }
        });

        // Menambah pengajuan yang belum diteruskan untuk status Menunggu
        $pendingPengajus = $pengajus->filter(function ($pengaju) {
            $keteranganData = $pengaju->keterangan->keterangan_data ?? null;

            // Jika keterangan_data berbentuk string JSON, decode menjadi array
            if (is_string($keteranganData)) {
                $keteranganData = json_decode($keteranganData, true);
            }

            // Pastikan $keteranganData adalah array
            if (is_array($keteranganData)) {
                $bendaharaData = $keteranganData['bendahara yayasan'] ?? null;

                // Menampilkan "Menunggu" jika tidak ada data dari Bendahara Yayasan
                return is_null($bendaharaData) && !is_null($pengaju->forwarded_at);
            }

            return false;
        });

        // Proses pengajuan dengan status "Menunggu"
        $pendingPengajus->each(function ($pengaju) {
            $pengaju->status = (object) [
                'id' => null,
                'status' => 'Menunggu',
                'badge_class' => 'badge-secondary'
            ];
            $pengaju->displayed_keterangan = 'Pengajuan sudah diteruskan, menunggu tindakan Bendahara Yayasan.';
        });

        // Gabungkan filteredPengajus (Ditunda) dan pendingPengajus (Menunggu)
        $finalPengajus = $filteredPengajus->merge($pendingPengajus);

        $totalrek = $finalPengajus->count();

        return compact('finalPengajus', 'totalrek');
    }

    // Method untuk halaman index
    public function indexForwarded()
    {
        $data = $this->getForwardedPengajus();
        return view('accountant.rekap', $data);
    }

    public function show($id)
    {
        return view('accountant.detail', ['id' => $id]);
    }

    public function forward(Request $request)
    {
        // Ambil ID pengajuan yang dipilih dari checkbox
        $selectedPengajus = $request->input('selected_pengajus', []);

        // Jika tidak ada data yang dipilih
        if (empty($selectedPengajus)) {
            return response()->json(['status' => 'error', 'message' => 'Tidak ada data yang dipilih untuk dikirim.']);
        }

        // Update kolom 'forwarded_at' untuk menandai pengajuan yang sudah dikirim ke bendahara
        Pengaju::whereIn('id', $selectedPengajus)->update([
            'forwarded_at' => now(),
        ]);

        $message = Auth::user()->name; // Dapatkan nama pengguna yang login

        $userOperator = User::where('role', 6)->get();
        // Kirim notifikasi untuk setiap pengajuan yang dipilih
        foreach ($selectedPengajus as $pengajuId) {
            $pengaju = Pengaju::find($pengajuId);
            Notification::send($userOperator, new SendNotification($pengaju, $message));
        }

        // Kirim response sukses dengan SweetAlert
        return response()->json(['status' => 'success', 'message' => 'Data berhasil dikirim ke bendahara yayasan.']);
    }

    public function forwardtwo(Request $request)
    {
        // Ambil ID pengajuan yang dipilih dari checkbox
        $selectedPengajus = $request->input('selected_pengajus', []);

        // Jika tidak ada data yang dipilih
        if (empty($selectedPengajus)) {
            return response()->json(['status' => 'error', 'message' => 'Tidak ada data yang dipilih untuk dikirim.']);
        }

        // Ambil semua pengajuan yang dipilih
        $pengajus = Pengaju::whereIn('id', $selectedPengajus)->get();

        // Loop untuk setiap pengajuan
        foreach ($pengajus as $pengaju) {
            // Ambil keterangan terkait pengajuan ini
            $keterangan = $pengaju->keterangan;

            if ($keterangan) {
                // Decode JSON dari keterangan_data
                $keteranganData = json_decode($keterangan->keterangan_data, true);

                // Jika ada entri terkait 'bendahara yayasan', hapus
                if (isset($keteranganData['bendahara yayasan'])) {
                    unset($keteranganData['bendahara yayasan']); // Menghapus data bendahara yayasan
                }

                // Encode ulang keterangan_data dan simpan
                $keterangan->keterangan_data = json_encode($keteranganData);
                $keterangan->save();
            }

            // Update kolom 'forwarded_at' untuk menandai pengajuan sudah dikirim ulang ke bendahara
            $pengaju->forwarded_at = now();
            $pengaju->save();
        }

        $message = Auth::user()->name; // Dapatkan nama pengguna yang login

        $userOperator = User::where('role', 6)->get();
        Notification::send($userOperator, new SendNotification($pengaju, $message));
        // Kirim response sukses dengan SweetAlert
        return response()->json(['status' => 'success', 'message' => 'Data berhasil dikirim ke bendahara yayasan.']);
    }

    public function shows($id)
    {
        return view('accountant.detailket', ['id' => $id]);
    }

    public function edit($id)
    {
        $pengaju = Pengaju::find($id);
        return view('accountant.edit', compact('pengaju'));
    }

    public function update(Request $request, $id)
    {
        // Validasi input jika perlu
        $request->validate([
            'deskripsi' => 'required|string',
            'total' => 'required|string', // Pastikan total adalah angka
        ]);

        // Menghapus titik pada input total untuk format Rupiah dan konversi ke float
        $total = str_replace('.', '', $request['total']); // Menghapus titik
        $total = floatval($total); // Mengonversi ke float

        // Update data
        Pengaju::find($id)->update([
            'deskripsi' => $request->deskripsi,
            'total' => $total
        ]);

        return redirect()->route('accountant.rekap')->with('success', 'Data berhasil diperbarui!');
    }
}
