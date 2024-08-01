<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Role;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            ['role' => 'admin'],
            ['role' => 'pengaju'],
            ['role' => 'approval'],
            ['role' => 'accountant'],
            ['role' => 'bendahara'],
        ];

        Role::insert($data);
    }
}
