<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AuthController extends Controller
{
    // Menampilkan form login
    public function index()
    {
        return view('auth.login');
    }

    // Memproses login
    public function login(Request $request)
    {
        // Validasi input
        $request->validate([
            'username' => 'required',
            'password' => [
                'required',
                'min:3',
                'regex:/[A-Z]/' // Harus ada huruf kapital
            ]
        ], [
            'username.required' => 'Username wajib diisi!',
            'password.required' => 'Password wajib diisi!',
            'password.min' => 'Password minimal 3 karakter!',
            'password.regex' => 'Password harus mengandung huruf kapital!'
        ]);

        // User contoh (hardcode)
        $validUser = "admin";
        $validPass = "Admin123";

        //update 4 

        if ($request->username === $validUser && $request->password === $validPass) {
            // Login berhasil → redirect ke halaman sukses
            return redirect()->route('auth.success')->with('username', $request->username);
        } else {
            // Login gagal
            return redirect()->back()->with('error', 'Username atau password salah!');
        }
    }

    // Halaman sukses
    public function success()
    {
        return view('auth.success');
    }
}
