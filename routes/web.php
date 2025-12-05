<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\WargaController;
use App\Http\Controllers\LembagaDesaController;
use App\Http\Controllers\PerangkatDesaController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\JabatanLembagaController;
use App\Http\Controllers\MediaController;

// Saat buka root, arahkan ke login dulu
Route::get('/', function () {
    return redirect()->route('login');
});

// Halaman login & register (bisa diakses tanpa login)
Route::get('/login', [AuthController::class, 'index'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.process');
Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
Route::post('/register', [AuthController::class, 'register'])->name('register.process');

// Logout
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// ROUTE TANPA MIDDLEWARE DULU UNTUK PERBAIKAN
Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard.index');
Route::resource('warga', WargaController::class);
Route::resource('lembaga', LembagaDesaController::class);
Route::resource('perangkat_desa', PerangkatDesaController::class);
Route::resource('jabatan-lembaga', JabatanLembagaController::class);
Route::resource('user', UserController::class);
Route::delete('/media/{id}', [MediaController::class, 'destroy'])->name('media.destroy');
Route::delete('/media/perangkat_desa/{id}', [MediaController::class, 'destroyPerangkatDesa'])->name('media.perangkat_desa.delete');

// Route khusus untuk testing - bypass semua middleware
Route::get('/test-login', function() {
    $user = \App\Models\User::where('email', 'della@gmail.com')->first();
    if ($user) {
        \Illuminate\Support\Facades\Auth::login($user);
        return redirect('/dashboard')->with('success', 'Login manual berhasil!');
    }
    return 'User tidak ditemukan';
});