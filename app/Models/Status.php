<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Status extends Model
{
    use HasFactory;
    protected $fillable = [
        'status'
    ];
    public function pengajus()
{
    return $this->hasMany(Pengaju::class, 'id_status');
}
}
