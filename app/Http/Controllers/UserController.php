<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Role;

class UserController extends Controller
{
    public function getIndex()
    {
        $users = User::join('roles', 'users.role', '=', 'roles.id')
            ->select('users.*', 'roles.role as role_name')
            ->get();

        $total = $users->count();

        return  compact('users', 'total');
    }

    public function superadminDashboard()
    {
        $data = $this->getIndex();
        return view('superadmin.dashboard', $data);
    }

    // Method untuk halaman index
    public function index()
    {
        $data = $this->getIndex();
        return view('superadmin.daftarakun', $data);
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

    public function destroy($id)
    {
        // Hapus semua data pengaju yang terkait dengan user
        DB::table('pengajus')->where('user_id', $id)->delete();

        // Hapus data pengaju menggunakan Query Builder
        DB::table('users')->where('id', $id)->delete();

        // Redirect ke halaman user status dengan pesan sukses
        return redirect()->route('superadmin.daftarakun')->with('success', 'Data user berhasil dihapus.');
    }

    public function resetPassword(Request $request, $id)
    {
        // Password default yang akan digunakan
        $defaultPassword = 'bhs123';

        // Cari user berdasarkan ID
        $user = User::find($id);

        if ($user) {
            // Reset password user ke default
            $user->password = Hash::make($defaultPassword);
            $user->save();

            // Redirect dengan pesan sukses
            return redirect()->back()->with('success', 'Password berhasil direset ke password default.');
        } else {
            // Jika user tidak ditemukan
            return redirect()->back()->with('error', 'User tidak ditemukan.');
        }
    }
}
