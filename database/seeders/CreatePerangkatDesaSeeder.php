<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class CreatePerangkatDesaSeeder extends Seeder
{
    /**
     * Jalankan seeder database.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create('id_ID');
        $jumlahPerangkat = 30;

        // Ambil ID warga dari tabel warga untuk relasi FK
        $wargaIds = DB::table('warga')->pluck('warga_id')->toArray();

        // Pastikan ada data di tabel warga sebelum melanjutkan
        if (empty($wargaIds)) {
            echo "Peringatan: Tidak ada data di tabel warga. Jalankan seeder warga terlebih dahulu.\n";
            return;
        }

        echo "Menambahkan $jumlahPerangkat Perangkat Desa...\n";

        // Daftar jabatan perangkat desa di Indonesia
        $daftarJabatan = [
            'Kepala Desa',
            'Sekretaris Desa',
            'Kepala Seksi Pemerintahan',
            'Kepala Seksi Kesejahteraan',
            'Kepala Seksi Pelayanan',
            'Kepala Urusan Keuangan',
            'Kepala Urusan Perencanaan',
            'Kepala Urusan Umum',
            'Kepala Dusun I',
            'Kepala Dusun II',
            'Kepala Dusun III',
            'Kepala Dusun IV',
            'Kepala Dusun V',
            'Staf Administrasi',
            'Staf Keuangan',
            'Staf Pembangunan',
            'Operator Sistem Informasi Desa',
            'Operator Badan Permusyawaratan Desa',
            'Bendahara Desa',
            'Ketua Badan Permusyawaratan Desa',
            'Anggota Badan Permusyawaratan Desa',
            'Ketua Lembaga Pemberdayaan Masyarakat Desa',
            'Anggota Lembaga Pemberdayaan Masyarakat Desa',
            'Pamong Desa',
            'Juru Tulis',
            'Juru Penerang',
            'Juru Pengairan',
            'Juru Kesehatan',
            'Juru Pendidikan',
            'Juru Kebersihan'
        ];

        foreach (range(1, $jumlahPerangkat) as $index) {

            $randomWargaId = $faker->randomElement($wargaIds);

            // Generate tanggal periode (maks 5 tahun ke belakang)
            $periodeMulai = $faker->dateTimeBetween('-5 years', 'now');
            $periodeSelesai = $faker->optional(0.7)->dateTimeBetween($periodeMulai, '+4 years');

            // Generate NIP (Nomor Induk Pegawai) dengan format Indonesia
            $nip = null;
            if ($faker->boolean(80)) {
                // Format: Tahun lahir + bulan lahir + 6 digit acak
                $tahun = $faker->numberBetween(1960, 1995);
                $bulan = str_pad($faker->numberBetween(1, 12), 2, '0', STR_PAD_LEFT);
                $acak = $faker->numerify('######');
                $nip = $tahun . $bulan . $acak;
            }

            // Generate nomor kontak Indonesia
            $kontak = $this->generateNomorIndonesia($faker);

            // Tambahkan data ke tabel perangkat_desa
            DB::table('perangkat_desa')->insert([
                'warga_id' => $randomWargaId,
                'jabatan' => $faker->randomElement($daftarJabatan),
                'nip' => $nip,
                'kontak' => $kontak,
                'periode_mulai' => $periodeMulai,
                'periode_selesai' => $periodeSelesai,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }

        echo "Seeder Perangkat Desa selesai. $jumlahPerangkat data telah ditambahkan.\n";
    }

    /**
     * Generate nomor telepon Indonesia yang realistis
     */
    private function generateNomorIndonesia($faker)
    {
        $prefixes = ['+62', '0'];
        $prefix = $faker->randomElement($prefixes);
        
        if ($prefix === '+62') {
            // Format +62 8xx xxxx xxxx
            $operator = $faker->randomElement(['812', '813', '814', '815', '816', '817', '818', '819', '852', '853', '857', '858', '859']);
            $number = $faker->numerify('#### ###');
            return "$prefix $operator $number";
        } else {
            // Format 08xx xxxx xxxx
            $operator = $faker->randomElement(['0812', '0813', '0814', '0815', '0816', '0817', '0818', '0819', '0852', '0853', '0857', '0858', '0859']);
            $number = $faker->numerify('#### ###');
            return "$operator $number";
        }
    }
}