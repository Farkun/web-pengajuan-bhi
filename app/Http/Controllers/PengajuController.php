<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pengaju;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class PengajuController extends Controller
{
    public function create()
    {
        // Tampilkan form untuk menambahkan pengajuan
        return view('pengaju.dana');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'val-date' => 'required|date',
            'val-username' => 'required|string|max:255',
            'val-suggestions' => 'required|string',
            'val-currency' => 'required|numeric',
        ]);

        $pengaju = new Pengaju();
        $pengaju->tanggal = $validated['val-date'];
        $pengaju->user_id = Auth::id(); // Menetapkan ID pengguna yang sedang login
        $pengaju->nama_pengaju = $validated['val-username'];
        $pengaju->deskripsi = $validated['val-suggestions'];
        $pengaju->total = $validated['val-currency'];
        $pengaju->id_status = $request->id_status ?? null;
        $pengaju->id_statusdana = $request->id_statusdana ?? null;
        $pengaju->id_keterangan = $request->id_keterangan ?? null;
        $pengaju->forwarded_at = $request->forwarded_at ?? null;
        $pengaju->save();

        return redirect()->route('pengaju.dana')->with('success', 'Pengajuan berhasil ditambahkan.');
    }
}