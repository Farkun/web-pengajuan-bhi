<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Role;

class UserController extends Controller
{
    public function index()
    {
        $users = User::join('roles', 'users.role', '=', 'roles.id')
                        ->select('users.*', 'roles.role as role_name')
                        ->get();
        return view('superadmin.daftarakun', compact('users'));
    }
    public function create()
    {
        $roles = Role::all();
        return view('superadmin.create', compact('roles'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'phone' => 'nullable|string|max:20',
            'role' => 'required|exists:roles,id',
        ]);

        $defaultPassword = 'bhs123';

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'password' => Hash::make($defaultPassword),
            'role' => $request->role,
        ]);

        return redirect()->route('superadmin.daftarakun')->with('success', 'User created successfully.');
    }
}
