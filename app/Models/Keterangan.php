<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Keterangan extends Model
{
    use HasFactory;

    protected $fillable = [
        'keterangan_data', // Tambahkan kolom JSON
    ];

    protected $casts = [
        'keterangan_data' => 'array', // Mengonversi JSON menjadi array
    ];

    public function pengaju()
    {
        return $this->hasOne(Pengaju::class, 'id_keterangan');
    }
}
