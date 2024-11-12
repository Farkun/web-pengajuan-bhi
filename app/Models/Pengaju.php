<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pengaju extends Model
{
    use HasFactory;
    protected $fillable = [
        'tanggal',
        'user_id',
        'nama_pengaju',
        'deskripsi',
        'total',
        'nomor_rekening',
        'nama_bank',
        'invoice',
        'id_status',
        'id_statusdana',
        'received_at',
        'id_keterangan',
        'forwarded_at',
        'bukti_pembayaran'
    ];

    // Definisikan relasi dengan model User
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function keterangan()
    {
        return $this->belongsTo(Keterangan::class, 'id_keterangan');
    }

    public function status()
    {
        return $this->belongsTo(Status::class, 'id_status');
    }
}