<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;

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
<<<<<<< HEAD
        $numberOfLembaga = 100;
=======
        $numberOfLembaga = 1000;
>>>>>>> 69431c22075e6e06bc46eb911ace1883b6ca516a

        echo "Menambahkan $numberOfLembaga Lembaga Desa...\n";

        $jenisLembaga = [
            'BPD', 'PKK', 'Karang Taruna', 'LPMD', 'Posyandu', 
            'LKMD', 'RT', 'RW', 'Kelompok Tani', 'Kelompok Nelayan',
            'Dasawisma', 'TP PKK', 'BUMDes', 'Satgas PPK', 'Forum Desa'
        ];

        
        foreach (range(1, $numberOfLembaga) as $index) {
            DB::table('lembaga_desa')->insert([ 
                'nama_lembaga' => $faker->randomElement($jenisLembaga) . ' ' . $faker->randomElement(['Desa', 'Kampung', 'Dusun']) . ' ' . $faker->citySuffix,
                'ketua'        => $faker->name(),
                'deskripsi'    => 'Lembaga ' . $faker->randomElement($jenisLembaga) . ' yang bertugas untuk ' . $faker->sentence(8),
                'kontak'       => $faker->phoneNumber,
                'created_at'   => now(),
                'updated_at'   => now()
            ]);

            if ($index % 10 === 0) {
                echo "Progress: $index/$numberOfLembaga\n";
            }
        }
        
        echo "Seeder Lembaga Desa selesai. $numberOfLembaga data lembaga berhasil ditambahkan.\n";
    }
}