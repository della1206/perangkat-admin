<?php

namespace App\Http\Controllers;

use App\Models\Warga;
use App\Models\LembagaDesa; // Ganti ini
use App\Models\JabatanLembaga; // Pastikan ini juga benar
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\PerangkatDesa;


class DashboardController extends Controller
{
    public function index()
    {
        // Data untuk dashboard
        $totalWarga = Warga::count();
        $totalPerangkat = PerangkatDesa::count();
        $totalLembaga = LembagaDesa::count();
        $totalUser = User::count();
        
        // Statistik jenis kelamin warga - perbaiki nama variabel
        $wargaStats = [
            'laki_laki' => Warga::where('jenis_kelamin', 'Laki-laki')->count(),
            'perempuan' => Warga::where('jenis_kelamin', 'Perempuan')->count()
        ];
        
        $user = auth()->user();

        return view('dashboard', compact(
            'user', 
            'totalWarga', 
            'totalPerangkat', 
            'totalLembaga', 
            'totalUser',
            'wargaStats'  // Pastikan ini ada
        ));
        // Hitung total warga
        $totalWarga = Warga::count();
        
        // Hitung warga berdasarkan jenis kelamin
        $wargaLakiLaki = Warga::where('jenis_kelamin', 'Laki-laki')
                             ->orWhere('jenis_kelamin', 'laki-laki')
                             ->orWhere('jenis_kelamin', 'L')
                             ->orWhere('jenis_kelamin', 'LAKI-LAKI')
                             ->count();
        
        $wargaPerempuan = Warga::where('jenis_kelamin', 'Perempuan')
                               ->orWhere('jenis_kelamin', 'perempuan')
                               ->orWhere('jenis_kelamin', 'P')
                               ->orWhere('jenis_kelamin', 'PEREMPUAN')
                               ->count();
        
        // Hitung total lembaga aktif - menggunakan LembagaDesa
        $totalLembaga = LembagaDesa::count(); // Sesuaikan dengan field status jika ada
        
        // Jika ada field status di model LembagaDesa:
        // $totalLembaga = LembagaDesa::where('status', 'Aktif')->count();
        
        // Pastikan model JabatanLembaga sudah ada atau sesuaikan
        $totalJabatan = 0; // Default
        
        // Cek jika model JabatanLembaga ada
        if (class_exists('App\Models\JabatanLembaga')) {
            $totalJabatan = \App\Models\JabatanLembaga::count();
        }
        
        // Hitung persentase jenis kelamin
        $persentaseLaki = $totalWarga > 0 ? round(($wargaLakiLaki / $totalWarga) * 100, 1) : 0;
        $persentasePerempuan = $totalWarga > 0 ? round(($wargaPerempuan / $totalWarga) * 100, 1) : 0;
        
        return view('dashboard', [
            'totalWarga' => $totalWarga,
            'wargaLakiLaki' => $wargaLakiLaki,
            'wargaPerempuan' => $wargaPerempuan,
            'totalLembaga' => $totalLembaga,
            'totalJabatan' => $totalJabatan,
            'persentaseLaki' => $persentaseLaki,
            'persentasePerempuan' => $persentasePerempuan,
        ]);
    }
}