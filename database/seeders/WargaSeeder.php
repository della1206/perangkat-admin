<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;

class WargaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create('id_ID');
        $numberOfWarga = 100;

        echo "Menambahkan $numberOfWarga data warga...\n";

        for ($i = 1; $i <= $numberOfWarga; $i++) {
            DB::table('warga')->insert([
                'no_ktp'        => $faker->unique()->nik(),
                'nama'          => $faker->name(),
                'jenis_kelamin' => $faker->randomElement(['L', 'P']), // Sesuai dengan kode L/P
                'agama'         => $faker->randomElement(['Islam', 'Kristen', 'Katolik', 'Hindu', 'Buddha', 'Konghucu']),
                'pekerjaan'     => $faker->randomElement([
                    'Petani', 'Pedagang', 'PNS', 'Guru', 'Dokter', 'Perawat', 
                    'Karyawan Swasta', 'Wiraswasta', 'Buruh', 'Nelayan', 'Ibu Rumah Tangga',
                    'Pelajar', 'Mahasiswa', 'Pensiunan', 'TNI', 'Polri'
                ]),
                'telp'          => $faker->phoneNumber(),
                'email'         => $faker->unique()->safeEmail(),
                'created_at'    => now(),
                'updated_at'    => now()
            ]);

            // Progress indicator
            if ($i % 10 === 0) {
                echo "Progress: $i/$numberOfWarga\n";
            }
        }
        
        echo "Seeder Warga selesai. $numberOfWarga data warga berhasil ditambahkan.\n";
    }
}