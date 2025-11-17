<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class DashboardController extends Controller
{
    public function index()
    {
        // Jika belum login, kembalikan ke login
        if (!session()->has('user_id')) {
            return redirect()->route('login')->with('error', 'Silakan login terlebih dahulu.');
        }

        // Ambil data user
        $user = User::find(session('user_id'));

        return view('pages.dashboard', compact('user'));
    }
}
