<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pengaju;

class BendaharayController extends Controller
{
    public function index()
    {
        // Mengambil semua pengajuan yang sudah diteruskan ke bendahara
        $forwardedPengajus = Pengaju::whereNotNull('forwarded_at')->with('user')->get();

        // Mengirim data ke view 'bendahara.index'
        return view('bendaharay.data', compact('forwardedPengajus'));
    }

    public function show($id)
    {
        return view('bendaharay.detail', ['id' => $id]);
    }
}
