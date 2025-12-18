<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AnggotaLembagaSeeder extends Seeder
{
    public function run(): void
    {
        $data = [];

        for ($i = 1; $i <= 100; $i++) {
            $data[] = [
                'anggota_id'  => $i,
                'lembaga_id'  => rand(1, 5),   // pastikan lembaga_desa ada
                'warga_id'    => rand(1, 50),  // pastikan warga ada
                'jabatan_id'  => rand(1, 5),   // pastikan jabatan ada
                'tgl_mulai'   => '2024-01-01',
                'tgl_selesai' => null,
            ];
        }

        DB::table('anggota_lembaga')->insert($data);
    }
}
