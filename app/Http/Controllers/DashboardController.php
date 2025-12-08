<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class DashboardController extends Controller
{
    public function index()
    {
        // Data untuk dashboard
        $totalWarga = \App\Models\Warga::count();
        $totalPerangkat = \App\Models\PerangkatDesa::count();
        $totalLembaga = \App\Models\LembagaDesa::count();
        $totalUser = User::count();
        
        $user = auth()->user();

        return view('dashboard', compact('user', 'totalWarga', 'totalPerangkat', 'totalLembaga', 'totalUser'));
    }
}