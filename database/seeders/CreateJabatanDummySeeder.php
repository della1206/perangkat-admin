<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class CreateJabatanDummySeeder extends Seeder
{
    /**
     * Jalankan seeder database.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create('id_ID');
        $numberOfJabatan = 50;

        // Ini penting agar relasi FK (lembaga_id) terisi dengan data yang valid
        $lembagaIds = DB::table('lembaga_desa')->pluck('lembaga_id')->toArray();

        // Pastikan ada data di tabel induk sebelum melanjutkan
        if (empty($lembagaIds)) {
            echo "Peringatan: Tidak ada data di tabel lembaga_desa. Jalankan CreateLembagaDummySeeder terlebih dahulu.\n";
            return;
        }

        echo "Menambahkan $numberOfJabatan Jabatan Lembaga...\n";

        foreach (range(1, $numberOfJabatan) as $index) {
            
            $randomLembagaId = $faker->randomElement($lembagaIds);

            // Tambahkan data ke tabel jabatan_lembaga
            DB::table('jabatan_lembaga')->insert([
                'lembaga_id'   => $randomLembagaId,
                'nama_jabatan' => $faker->randomElement(['Ketua', 'Wakil Ketua', 'Sekretaris', 'Bendahara', 'Koordinator Bidang', 'Anggota']),
                'level'        => $faker->numberBetween(1, 4), 
            ]);
        }
        
        echo "Seeder Jabatan Lembaga selesai. $numberOfJabatan Jabatan telah ditambahkan.\n";
    }
}