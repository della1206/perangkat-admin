<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run()
    {
        // Buat superadmin
        User::create([
            'name' => 'Super Admin',
            'email' => 'superadmin@example.com',
            'password' => Hash::make('password123'),
            'role' => 'superadmin'
        ]);

        // Buat admin
        User::create([
            'name' => 'Administrator',
            'email' => 'admin@example.com',
            'password' => Hash::make('password123'),
            'role' => 'admin'
        ]);

        // Buat beberapa warga contoh
        User::create([
            'name' => 'Warga Contoh',
            'email' => 'warga@example.com',
            'password' => Hash::make('password123'),
            'role' => 'warga'
        ]);
    }
}