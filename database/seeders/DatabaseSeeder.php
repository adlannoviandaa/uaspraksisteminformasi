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

        $this->call(UserSeeder::class);

    }
}
