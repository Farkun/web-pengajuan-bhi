<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pengaju;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class PengajuController extends Controller
{
    public function index(Request $request)
    {
        $pengajus = Pengaju::all();
        if ($request->routeIs('pengaju.status')) {
            return view('pengaju.status', compact('pengajus'));
        } elseif ($request->routeIs('pengaju.result')) {
            return view('pengaju.result', compact('pengajus'));
        }

        abort(404);
    }
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
            'val-currency' => 'required|string',
        ]);

        $pengaju = new Pengaju();
        $pengaju->tanggal = $validated['val-date'];
        $pengaju->user_id = Auth::id(); // Menetapkan ID pengguna yang sedang login
        $pengaju->nama_pengaju = $validated['val-username'];
        $pengaju->deskripsi = $validated['val-suggestions'];
        $pengaju->total = str_replace('.', '', $validated['val-currency']);
        $pengaju->id_status = $request->id_status ?? null;
        $pengaju->id_statusdana = $request->id_statusdana ?? null;
        $pengaju->id_keterangan = $request->id_keterangan ?? null;
        $pengaju->forwarded_at = $request->forwarded_at ?? null;
        $pengaju->save();

        return redirect()->route('pengaju.result')->with('success', 'Pengajuan berhasil ditambahkan.');
    }

    public function destroy($id)
    {
        // Cari data pengaju berdasarkan ID
        $pengaju = Pengaju::findOrFail($id);

        // Hapus data pengaju
        $pengaju->delete();

        // Redirect ke halaman pengaju status dengan pesan sukses
        return redirect()->route('pengaju.result')->with('success', 'Data pengaju berhasil dihapus.');
    }
}