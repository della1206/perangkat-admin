<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class DashboardController extends Controller
{
    public function index()
    {
        // Middleware sudah menangani auth, jadi langsung return view
        return view('dashboard');
    }
}