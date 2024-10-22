<?php

namespace App\Http\Controllers;

use App\Exports\ExportData;
use Illuminate\Http\Request;
use App\Models\Pengaju;
use App\Models\Keterangan;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\SudahCairExport;

class BendaharaController extends Controller
{
    public function getBendaharaPengajus()
    {
        // Mengambil semua pengajuan yang sudah diteruskan ke bendahara yayasan dengan status 1
        $approvedPengajus = Pengaju::whereNotNull('forwarded_at')
            ->where('id_status', 1) // Hanya ambil yang statusnya 1
            ->whereNull('id_statusdana') // Hanya ambil yang belum cair
            ->whereHas('keterangan', function ($query) {
                // Menggunakan keterangan_data untuk mengecualikan data dari bendahara yayasan
                $query->where('keterangan_data', 'LIKE', '%bendahara yayasan%');
            })
            ->with(['user', 'keterangan']) // Load relasi user dan keterangan
            ->get();

        $total = $approvedPengajus->count();

        // Mengirim data ke view 'bendaharay.data'
        return compact('approvedPengajus', 'total');
    }

    public function bendaharaDashboard()
    {
        $data = $this->getBendaharaPengajus();
        return view('bendahara.dashboard', $data);
    }

    // Method untuk halaman index
    public function index()
    {
        $data = $this->getBendaharaPengajus();
        return view('bendahara.status', $data);
    }

    public function updateCair(Request $request)
    {
        // Validasi input
        $request->validate([
            'pengaju_id' => 'required|exists:pengajus,id',
            'bukti_pembayaran' => 'required|file|mimes:pdf,jpg,jpeg,png',
        ]);

        // Mengunggah bukti pembayaran ke folder penyimpanan
        $buktiPembayaran = $request->file('bukti_pembayaran')->store('bukti_pembayaran', 'public');

        $id_statusdana = 1;

        // Update status pengajuan dan bukti pembayaran di database
        $pengaju = Pengaju::findOrFail($request->pengaju_id);
        $pengaju->id_statusdana = $id_statusdana; // Set status ke "Sudah Cair"
        $pengaju->bukti_pembayaran = $buktiPembayaran; // Simpan bukti pembayaran
        $pengaju->save();

        // Kembalikan respons JSON, bukan redirect
        return response()->json(['success' => true, 'message' => 'Pengajuan telah dicairkan dan bukti pembayaran telah disimpan.']);
    }

    public function laporan()
    {
        // Ambil data pengajuan yang sudah cair
        $pengajuans = Pengaju::where('id_statusdana', 1)->get();

        // Kirim data pengajuan ke view
        return view('bendahara.laporan', compact('pengajuans'));
    }

    public function show($id)
    {
        return view('bendahara.detail', ['id' => $id]);
    }

    public function shows($id)
    {
        return view('bendahara.detailap', ['id' => $id]);
    }

    public function export_excel()
    {
        return Excel::download(new ExportData, "data-bendahara.xlsx");
    }

    public function exportSudahCair()
    {
        return Excel::download(new SudahCairExport, 'pengajuan-sudah-cair.xlsx');
    }



}

// <?php

// namespace App\Http\Controllers;

// use Illuminate\Http\Request;
// use App\Models\Pengaju;
// use App\Models\Keterangan;
// use Illuminate\Support\Facades\Auth;

// class BendaharaController extends Controller
// {
//     public function index()
// {
//     // Mengambil semua pengajuan yang sudah diteruskan ke bendahara yayasan dengan status 1
//     $approvedPengajus = Pengaju::whereNotNull('forwarded_at')
//     ->where('id_status', 1) // Hanya ambil yang statusnya 1
//     ->where('keterangan', function ($query) {
//         // Menggunakan keterangan_data untuk mengecualikan data dari bendahara yayasan
//         $query->where('keterangan_data', 'LIKE', '%bendahara yayasan%');
//     })
//     ->with(['user', 'keterangan']) // Load relasi user dan keterangan
//     ->get();

// // Mengirim data ke view 'bendaharay.data'
// return view('bendahara.status', compact('approvedPengajus'));
// }
// }

