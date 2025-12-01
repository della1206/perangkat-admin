<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PerangkatDesaSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('perangkat_desa')->insert([
            ['warga_id' => 1, 'jabatan' => 'Kepala Desa', 'kontak' => '081200000001'],
            ['warga_id' => 2, 'jabatan' => 'Sekretaris Desa', 'kontak' => '081200000002'],
            ['warga_id' => 3, 'jabatan' => 'Kaur Umum', 'kontak' => '081200000003'],
            ['warga_id' => 4, 'jabatan' => 'Kaur Keuangan', 'kontak' => '081200000004'],
            ['warga_id' => 5, 'jabatan' => 'Kaur Perencanaan', 'kontak' => '081200000005'],
            ['warga_id' => 6, 'jabatan' => 'Kasi Pemerintahan', 'kontak' => '081200000006'],
            ['warga_id' => 7, 'jabatan' => 'Kasi Kesejahteraan', 'kontak' => '081200000007'],
            ['warga_id' => 8, 'jabatan' => 'Kasi Pelayanan', 'kontak' => '081200000008'],
            ['warga_id' => 9, 'jabatan' => 'Kadus RW 01', 'kontak' => '081200000009'],
            ['warga_id' => 10, 'jabatan' => 'Kadus RW 02', 'kontak' => '081200000010'],
            ['warga_id' => 11, 'jabatan' => 'Kadus RW 03', 'kontak' => '081200000011'],
            ['warga_id' => 12, 'jabatan' => 'Kadus RW 04', 'kontak' => '081200000012'],
            ['warga_id' => 13, 'jabatan' => 'Kadus RW 05', 'kontak' => '081200000013'],
            ['warga_id' => 14, 'jabatan' => 'Staff Administrasi', 'kontak' => '081200000014'],
            ['warga_id' => 15, 'jabatan' => 'Operator Desa', 'kontak' => '081200000015'],
            ['warga_id' => 16, 'jabatan' => 'Pendamping Desa', 'kontak' => '081200000016'],
            ['warga_id' => 17, 'jabatan' => 'Linmas', 'kontak' => '081200000017'],
            ['warga_id' => 18, 'jabatan' => 'Babinsa', 'kontak' => '081200000018'],
            ['warga_id' => 19, 'jabatan' => 'Bhabinkamtibmas', 'kontak' => '081200000019'],
            ['warga_id' => 20, 'jabatan' => 'Petugas Kebersihan', 'kontak' => '081200000020'],
        ]);
    }
}
