<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pengaju;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;

class PengajuController extends Controller
{
    public function index(Request $request)
    {
        // Ambil ID pengguna yang sedang login
        $userId = Auth::id();

        // Ambil data pengajuan hanya untuk pengguna yang sedang login
        $pengajus = Pengaju::where('user_id', $userId)->get();

        $pengajus = Pengaju::all();
        if ($request->routeIs('pengaju.status')) {
            return view('pengaju.status', compact('pengajus'));
        } elseif ($request->routeIs('pengaju.result')) {
            return view('pengaju.result', compact('pengajus'));
        }

        abort(404);

        $latestPengajus = Pengaju::where('user_id', $userId)
            ->latest()
            ->limit(3)
            ->get(); // Mengambil 3 data terbaru berdasarkan tanggal
        return view('pengaju.dashboard', compact('latestPengajus'));
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
            'nomor_rekening' => 'required|string|max:50',
            'nama_bank' => 'required|string',
            'invoice' => 'nullable|file|mimes:pdf,jpeg,png,jpg|max:2048', // Validasi untuk invoice
        ]);


        // Pastikan folder invoices ada
        $invoiceFolder = 'invoices';
        if (!Storage::disk('public')->exists($invoiceFolder)) {
            Storage::disk('public')->makeDirectory($invoiceFolder);
        }

        // Proses upload invoice jika ada
        $invoicePath = null;
        if ($request->hasFile('invoice')) {
            $invoice = $request->file('invoice');

            // Generate a unique file name
            $invoiceName = time() . '_' . $invoice->getClientOriginalName();

            // Simpan file ke folder 'invoices' di dalam disk 'public'
            $invoicePath = $invoice->storeAs('invoices', $invoiceName, 'public');
        }

        $pengaju = new Pengaju();
        $pengaju->tanggal = $validated['val-date'];
        $pengaju->user_id = Auth::id(); // Menetapkan ID pengguna yang sedang login
        $pengaju->nama_pengaju = $validated['val-username'];
        $pengaju->deskripsi = $validated['val-suggestions'];
        $pengaju->total = str_replace('.', '', $validated['val-currency']);
        $pengaju->nomor_rekening = $validated['nomor_rekening'];
        $pengaju->nama_bank = $validated['nama_bank'];
        $pengaju->invoice = $invoicePath;
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

    public function show($id)
    {
        return view('pengaju.detailp', ['id' => $id]);
    }

    public function shows($id)
    {
        return view('pengaju.details', ['id' => $id]);
    }

}