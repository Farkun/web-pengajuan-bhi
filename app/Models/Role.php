<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class Role extends Model
{
    use HasFactory;
    protected $fillable = [
        'role'
    ];

    public static function getRoleTypes()
    {
        return self::pluck('role')->unique()->toArray();
    } 
    public function users()
    {
        return $this->hasMany(User::class, 'role');
    }
}
