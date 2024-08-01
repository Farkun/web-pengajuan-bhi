<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
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
}
