<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     */
    public function create(): View
    {
        return view('auth.login');
    }

    /**
     * Handle an incoming authentication request.
     */
    public function store(LoginRequest $request): RedirectResponse
    {
        $request->authenticate();

        $request->session()->regenerate();

        $user = Auth::user();

        // Arahkan pengguna berdasarkan peran mereka
        if ($user->hasRole(1)) {
            return redirect()->intended(route('superadmin.dashboard'));
        } elseif ($user->hasRole(2)) {
            return redirect()->intended(route('pengaju.dashboard'));
        } elseif ($user->hasRole(3)) {
            return redirect()->intended(route('approval.status'));
        } elseif ($user->hasRole(4)) {
            return redirect()->intended(route('accountant.dashboard'));
        } elseif ($user->hasRole(5)) {
            return redirect()->intended(route('bendahara.dashboard'));
        } elseif ($user->hasRole(6)) {
            return redirect()->intended(route('bendaharay.dashboard'));
        }


        return redirect()->intended(RouteServiceProvider::HOME);
    }

    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/login');
    }
}
