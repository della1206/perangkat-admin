<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Warga;
use App\Models\PerangkatDesa;
use App\Models\LembagaDesa;

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
    }
}