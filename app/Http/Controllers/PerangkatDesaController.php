<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PerangkatDesaController extends Controller
{
    public function index()
    {
        // Data dummy dulu, nanti bisa diganti query ke database
        $perangkat_desa = [
            [
                'perangkat_id' => 1,
                'warga_id' => 101,
                'jabatan' => 'Sekretaris',
                'nip' => '123456789',
                'kontak' => '081234567890',
                'periode_mulai' => '2023-01-01',
                'periode_selesai' => '2025-01-01',
                'foto' => 'sekre.jpg'
            ],
            [
                'perangkat_id' => 2,
                'warga_id' => 102,
                'jabatan' => 'Bendahara',
                'nip' => '987654321',
                'kontak' => '081298765432',
                'periode_mulai' => '2022-01-01',
                'periode_selesai' => '2024-01-01',
                'foto' => 'bendahara.jpg'
            ],
            [
                'perangkat_id' => 3,
                'warga_id' => 103,
                'jabatan' => 'Kepala Desa',
                'nip' => '111223344',
                'kontak' => '081356789012',
                'periode_mulai' => '2021-01-01',
                'periode_selesai' => '2026-01-01',
                'foto' => 'kepala.jpg'
            ]
        ];

        // Tampilkan data ke view
        return view('admin.perangkat_desa', compact('perangkat_desa'));
    }
}
