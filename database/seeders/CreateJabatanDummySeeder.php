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
        $jumlahJabatan = 50;

        // Ambil ID lembaga dari tabel lembaga_desa untuk relasi FK
        $lembagaIds = DB::table('lembaga_desa')->pluck('lembaga_id')->toArray();

        // Pastikan ada data di tabel lembaga_desa sebelum melanjutkan
        if (empty($lembagaIds)) {
            echo "Peringatan: Tidak ada data di tabel lembaga_desa. Jalankan CreateLembagaDummySeeder terlebih dahulu.\n";
            return;
        }

        echo "Menambahkan $jumlahJabatan Jabatan Lembaga...\n";

        // Daftar jabatan dalam lembaga desa (bahasa Indonesia)
        $daftarJabatan = [
            'Ketua',
            'Wakil Ketua',
            'Sekretaris',
            'Bendahara',
            'Koordinator Bidang Pemberdayaan',
            'Koordinator Bidang Kesehatan',
            'Koordinator Bidang Pendidikan',
            'Koordinator Bidang Ekonomi',
            'Koordinator Bidang Pemuda',
            'Koordinator Bidang Perempuan',
            'Koordinator Bidang Lingkungan',
            'Koordinator Bidang Sosial',
            'Koordinator Bidang Infrastruktur',
            'Anggota',
            'Anggota Bidang Pemberdayaan',
            'Anggota Bidang Kesehatan',
            'Anggota Bidang Pendidikan',
            'Anggota Bidang Ekonomi',
            'Anggota Bidang Pemuda',
            'Anggota Bidang Perempuan',
            'Anggota Bidang Lingkungan',
            'Anggota Bidang Sosial',
            'Sekretaris I',
            'Sekretaris II',
            'Bendahara I',
            'Bendahara II',
            'Ketua Harian',
            'Wakil Sekretaris',
            'Wakil Bendahara',
            'Staf Administrasi',
            'Staf Keuangan',
            'Staf Program',
            'Staf Monitoring',
            'Staf Evaluasi',
            'Ketua Komisi A',
            'Ketua Komisi B',
            'Ketua Komisi C',
            'Ketua Komisi D',
            'Anggota Komisi A',
            'Anggota Komisi B',
            'Anggota Komisi C',
            'Anggota Komisi D',
            'Ketua Panitia',
            'Wakil Ketua Panitia',
            'Sekretaris Panitia',
            'Bendahara Panitia',
            'Anggota Panitia',
            'Koordinator Wilayah',
            'Koordinator Dusun',
            'Koordinator RW'
        ];

        foreach (range(1, $jumlahJabatan) as $index) {
            
            $randomLembagaId = $faker->randomElement($lembagaIds);

            // Tambahkan data ke tabel jabatan_lembaga
            DB::table('jabatan_lembaga')->insert([
                'lembaga_id'   => $randomLembagaId,
                'nama_jabatan' => $faker->randomElement($daftarJabatan),
                'level'        => $faker->numberBetween(1, 5), // Level 1-5
                'created_at'   => now(),
                'updated_at'   => now(),
            ]);
        }
        
        echo "Seeder Jabatan Lembaga selesai. $jumlahJabatan jabatan telah ditambahkan.\n";
    }
}