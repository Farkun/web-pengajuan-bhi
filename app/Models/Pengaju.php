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
        'id_status',
        'id_statusdana',
        'id_keterangan',
        'forwarded_at'
    ];
    
    // Definisikan relasi dengan model User
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}