<?php

namespace App\Http\Controllers;

use App\Exports\ExportData;
use Illuminate\Http\Request;
use App\Models\Pengaju;
use App\Models\Keterangan;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Facades\Excel;

class BendaharaController extends Controller
{
    public function getBendaharaPengajus()
    {
        // Mengambil semua pengajuan yang sudah diteruskan ke bendahara yayasan dengan status 1
        $approvedPengajus = Pengaju::whereNotNull('forwarded_at')
            ->where('id_status', 1) // Hanya ambil yang statusnya 1
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

    public function show($id)
    {
        return view('bendahara.detail', ['id' => $id]);
    }

    public function export_excel()
    {
        return Excel::download(new ExportData,"data-bendahara.xlsx");
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

