<?php

namespace Database\Seeders;
// tess
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
        $numberOfPerangkat = 80;

        // Ambil ID warga dari tabel warga untuk relasi FK
        $wargaIds = DB::table('warga')->pluck('warga_id')->toArray();

        // Pastikan ada data di tabel warga sebelum melanjutkan
        if (empty($wargaIds)) {
            echo "Peringatan: Tidak ada data di tabel warga. Jalankan seeder warga terlebih dahulu.\n";
            return;
        }

        echo "Menambahkan $numberOfPerangkat Perangkat Desa...\n";

        // Daftar jabatan perangkat desa yang umum
        $jabatanList = [
            'Kepala Desa',
            'Sekretaris Desa',
            'Kasi Pemerintahan',
            'Kasi Kesejahteraan',
            'Kasi Pelayanan',
            'Kaur Keuangan',
            'Kaur Perencanaan',
            'Kaur Umum',
            'Kepala Dusun I',
            'Kepala Dusun II',
            'Kepala Dusun III',
            'Kepala Dusun IV',
            'Staf Administrasi',
            'Staf Keuangan',
            'Staf Pembangunan',
            'Operator SIPKD',
            'Operator BPD',
            'Bendahara Desa',
            'Ketua BPD',
            'Anggota BPD',
            'Ketua LPMD',
            'Anggota LPMD',
            'Pamong Desa',
            'Juru Tulis',
            'Juru Penerang'
        ];

        foreach (range(1, $numberOfPerangkat) as $index) {

            $randomWargaId = $faker->randomElement($wargaIds);

            // Generate tanggal periode (maks 5 tahun ke belakang)
            $periodeMulai = $faker->dateTimeBetween('-5 years', 'now');
            $periodeSelesai = $faker->optional(0.7)->dateTimeBetween($periodeMulai, '+4 years');

            // Generate NIP (Nomor Induk Pegawai) dengan format tertentu
            $nip = null;
            if ($faker->boolean(80)) {
                $nip = $faker->numerify('19##############'); // Contoh: 1980123123456789
            }

            // Tambahkan data ke tabel perangkat_desa
            DB::table('perangkat_desa')->insert([
                'warga_id' => $randomWargaId,
                'jabatan' => $faker->randomElement($jabatanList),
                'nip' => $nip,
                'kontak' => $faker->phoneNumber,
                'periode_mulai' => $periodeMulai,
                'periode_selesai' => $periodeSelesai,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }

        echo "Seeder Perangkat Desa selesai. $numberOfPerangkat data telah ditambahkan.\n";
    }
}
