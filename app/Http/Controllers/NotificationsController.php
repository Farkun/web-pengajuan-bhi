<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class NotificationsController extends Controller
{
    public function markAsRead($id)
    {
        // Cari notifikasi berdasarkan ID dan user yang sedang login
        $notification = auth()->user()->unreadNotifications->where('id', $id)->first();

        // Tandai sebagai dibaca jika notifikasi ditemukan
        if ($notification) {
            $notification->markAsRead();
            $redirectUrl = $notification->data['url'] ?? '/'; // Default ke beranda jika URL kosong
            return redirect($redirectUrl);
        }

        // Jika notifikasi tidak ditemukan, arahkan kembali ke beranda atau halaman yang sesuai
        return redirect('/');
    }
}
