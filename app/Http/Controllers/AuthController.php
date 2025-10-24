<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AuthController extends Controller
{
    // Tampilkan halaman login
    public function index()
    {
        return view('auth.login');
    }

    // Proses login statis (Admin / Abc123)
    public function login(Request $request)
    {
        $request->validate([
            'username' => 'required',
            'password' => 'required|min:3',
        ]);

        $username = $request->input('username');
        $password = $request->input('password');
        $email = $request->input('email');

        // Cek apakah password mengandung huruf kapital
        if (!preg_match('/[A-Z]/', $password)) {
            return back()->with('error', 'Password harus mengandung minimal satu huruf kapital.')->withInput();
        }

        // Login hanya untuk Admin / Abc123
        if ($username === 'Admin' && $password === 'Abc123') {
            session([
                'username' => $username,
                'email' => $email ?? 'admin@example.com', // default kalau kosong
                'password' => $password,
            ]);
            return redirect()->route('login.success')->with('message', 'Login berhasil!');
        }

        return back()->with('error', 'Username atau password salah.')->withInput();
    }

    // Halaman sukses setelah login
    public function success()
    {
        if (!session()->has('username')) {
            return redirect()->route('login')->with('error', 'Silakan login terlebih dahulu.');
        }

        return view('auth.success');
    }

    // Logout
    public function logout(Request $request)
    {
        $request->session()->flush();
        return redirect()->route('login')->with('success', 'Berhasil logout.');
    }

    // Halaman register (hanya tampilan)
    public function showRegister()
    {
        return view('auth.register');
    }

    // Simulasi proses register (tidak mempengaruhi login)
    public function register(Request $request)
    {
        $request->validate([
            'username' => 'required|min:3|alpha_num',
            'email' => 'required|email',
            'password' => 'required|min:3',
            'confirm_password' => 'required|same:password',
        ]);

        return redirect()->route('login')->with('success', 'Registrasi berhasil! Silakan login dengan akun Admin / Abc123.');
    }
}
