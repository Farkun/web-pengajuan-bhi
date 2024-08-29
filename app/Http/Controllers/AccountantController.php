<?php

namespace App\Http\Controllers;

use App\Models\Pengaju;
use Illuminate\Http\Request;

class AccountantController extends Controller
{
    public function index()
    {
        // Mengambil data pengajuan yang sudah disetujui
        $approvedPengajus = Pengaju::where('id_status', \App\Models\Status::where('status', 'Setujui')->first()->id)
            ->whereNull('forwarded_at') // Hanya ambil data yang belum dikirim
            ->with(['user']) // Dengan relasi departement dan user jika diperlukan
            ->get();

        // Mengirim data ke view
        return view('accountant.index', compact('approvedPengajus'));
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

        // Kirim response sukses dengan SweetAlert
        return response()->json(['status' => 'success', 'message' => 'Data berhasil dikirim ke bendahara.']);
    }
}
