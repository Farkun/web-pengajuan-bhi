<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Contracts\View\View;
use Carbon\Carbon;
use App\Models\User;

class DashboardController extends Controller
{
    public function superadmin()
    {
        $user = Auth::user(); // Mendapatkan pengguna yang sedang login
        return view('superadmin.dashboard', ['user' => $user]);
    }
    public function pengaju()
    {
        $user = Auth::user(); // Mendapatkan pengguna yang sedang login
        return view('pengaju.dashboard', ['user' => $user]);
    }

    public function accountant()
    {
        $user = Auth::user(); // Mendapatkan pengguna yang sedang login
        return view('accountant.dashboard', ['user' => $user]);
    }

    public function bendahara()
    {
        $user = Auth::user(); // Mendapatkan pengguna yang sedang login
        return view('bendahara.dashboard', ['user' => $user]);
    }

    public function approval()
    {
        $user = Auth::user(); // Mendapatkan pengguna yang sedang login
        return view('approval.status', ['user' => $user]);
    }

    public function bendaharay()
    {
        $user = Auth::user(); // Mendapatkan pengguna yang sedang login
        return view('bendaharay.dashboard', ['user' => $user]);
    }

    public function dashboardTgl()
    {
        return [
            'currentDate' => Carbon::now()->isoFormat('dddd, D MMMM YYYY'),
            // Tambahkan data lain jika diperlukan
        ];
    }

    public function showDashboard(Request $request, $dashboardType)
{
    $data = $this->dashboardTgl();

    switch ($dashboardType) {
        case 'pengaju':
            return view('pengaju.dashboard', $data);
        case 'superadmin':
            return view('superadmin.dashboard', $data);
        case 'accountant':
            return view('accountant.dashboard', $data);
        case 'bendahara':
            return view('bendahara.dashboard', $data);
        case 'approval':
            return view('approval.status', $data);
        case 'bendaharay':
                return view('bendaharay.dashboard', $data);
        default:
            abort(404); // Menangani kasus di mana jenis dashboard tidak ditemukan
    }
}
}
