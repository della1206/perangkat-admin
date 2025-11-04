<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class AuthController extends Controller
{
    // Tampilkan halaman login
    public function index()
    {
        return view('pages.auth.login');
    }

    // Proses login
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required',
            'password' => 'required|min:3',
        ]);

        $username = $request->input('email');
        $password = $request->input('password');

        // Cari user berdasarkan username
        $user = User::where('email', $username)->first();

        if (!$user || !Hash::check($password, $user->password)) {
            return back()->with('error', 'Username atau password salah.')->withInput();
        }

        // Simpan data user ke session
        session([
            'user_id' => $user->id,
            // 'username' => $user->username,
            'email' => $user->email,
        ]);

        return redirect()->route('dashboard.index')->with('message', 'Login berhasil!');
    }

    // Halaman sukses setelah login
    public function success()
    {
        if (!session()->has('user_id')) {
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

    // Halaman register
    public function showRegister()
    {
        return view('pages.auth.register');
    }

    // Proses register
    public function register(Request $request)
    {
        $request->validate([
    'name' => 'required|string|max:255',
    // 'username' => 'required|min:3|alpha_num|unique:users,username',
    'email' => 'required|email|unique:users,email',
    'password' => [
        'required',
        'min:6',
        'confirmed',
        'regex:/[A-Z]/'  // <-- harus ada minimal satu huruf kapital
    ],
], [
    'password.regex' => 'Password harus mengandung minimal satu huruf kapital.'
]);


        // Simpan user baru ke database
        $user = User::create([
            'name' => $request->name,
            // 'username' => $request->username,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        return redirect()->route('login')->with('success', 'Registrasi berhasil! Silakan login.');
    }
}
