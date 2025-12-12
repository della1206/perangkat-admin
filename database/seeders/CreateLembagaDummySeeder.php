<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class CreateLembagaDummySeeder extends Seeder
{
    /**
     * Jalankan seeder database.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create('id_ID');
        $numberOfLembaga = 90;

        echo "Menambahkan $numberOfLembaga Lembaga Desa...\n";

        // Insert data ke tabel lembaga_desa (Tabel Induk)
        foreach (range(1, $numberOfLembaga) as $index) {
            DB::table('lembaga_desa')->insert([
                'nama_lembaga' => $faker->randomElement(['BPD', 'PKK', 'Karang Taruna', 'LPMD', 'Posyandu']) . ' ' . $faker->citySuffix,
                'deskripsi'    => $faker->sentence(10),
                'kontak'       => $faker->phoneNumber,
            ]);
        }
        
        echo "Seeder Lembaga Desa selesai.\n";
    }
}