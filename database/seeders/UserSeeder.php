<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        // Admin
        User::create([
            'nim' => 'admin001',
            'name' => 'Admin',
            'role' => 'admin',
            'password' => Hash::make('admin123'), // HASH PASSWORD!
        ]);

        // Dosen
        User::create([
            'nim' => 'dosen001',
            'name' => 'Dosen Contoh',
            'role' => 'dosen',
            'password' => Hash::make('dosen123'),
        ]);

        // Mahasiswa
        User::create([
            'nim' => '01',
            'name' => 'adel',
            'role' => 'mahasiswa',
            'password' => Hash::make('mhs123'),
        ]);
    }
}
