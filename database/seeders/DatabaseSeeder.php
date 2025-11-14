<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class DefaultUserSeeder extends Seeder
{
    /**
     * Jalankan database seeder.
     */
    public function run(): void
    {
        $password = '12345678'; // Password yang diminta

        DB::table('users')->insert([
            // Role Admin
            [
                'identifier' => '12345678',
                'name' => 'Admin SITAMA',
                'role' => 'admin',
                'password' => Hash::make($password),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            // Role Dosen
            [
                'identifier' => '12345678',
                'name' => 'Dr. Pembimbing',
                'role' => 'dosen',
                'password' => Hash::make($password),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            // Role Mahasiswa
            [
                'identifier' => '12345678',
                'name' => 'Mahasiswa SITAMA',
                'role' => 'mahasiswa',
                'password' => Hash::make($password),
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
