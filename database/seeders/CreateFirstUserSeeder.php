<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class CreateFirstUserSeeder extends Seeder
{
    /**
     * Jalankan seeder database.
     *
     * @return void
     */
    public function run()
    {
        // Membuat akun admin pertama sesuai permintaan tugas.
        User::create([
            'name' => 'Admin Desa',
            'email' => 'admindesa@gmail.com',
            // Pastikan password di-hash sebelum disimpan
            
            'password' => Hash::make('admin123'), 
        ]);
    }
}