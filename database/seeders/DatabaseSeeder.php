<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Membuat 1 akun admin default
        User::create([
            'name' => 'Admin Showroom',
            'email' => 'admin@gmail.com',
            'password' => Hash::make('rahasia123'), // Hash::make berfungsi untuk mengenkripsi password agar aman
        ]);
    }
}
