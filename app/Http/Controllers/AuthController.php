<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    // Tampilkan halaman login
    public function index()
    {
        // Jika sudah login DAN role ada, redirect ke dashboard
        if (Auth::check() && !empty(Auth::user()->role)) {
            return redirect()->route('dashboard.index');
        }
        
        // Jika sudah login tapi role kosong, tetap di login page
        // atau bisa ke halaman khusus untuk set role
        
        return view('pages.auth.login');
    }

    // Proses login
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required',
            'password' => 'required|min:3',
        ]);

        // Cek user dengan Auth attempt
        $credentials = $request->only('email', 'password');
        
        if (Auth::attempt($credentials)) {
            $user = Auth::user();
            
            // Jika role kosong/null, set default 'User'
            if (empty($user->role)) {
                $user->role = 'User';
                $user->save();
            }
            
            // Simpan session
            session([
                'user_id' => $user->id,
                'email' => $user->email,
                'name' => $user->name,
                'role' => $user->role,
            ]);

            return redirect()->route('dashboard.index')->with('success', 'Login berhasil!');
        }

        return back()->with('error', 'Email atau password salah.')->withInput();
    }

    // Logout
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        
        return redirect()->route('login')->with('success', 'Berhasil logout.');
    }

    // Tampilkan halaman register
    public function showRegister()
    {
        // Jika sudah login, redirect ke dashboard
        if (Auth::check()) {
            return redirect()->route('dashboard.index');
        }
        
        return view('pages.auth.register');
    }

    // Proses register
    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:6|confirmed',
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => 'User', // DEFAULT ROLE
        ]);

        return redirect()->route('login')->with('success', 'Registrasi berhasil! Silakan login.');
    }
}