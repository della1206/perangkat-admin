<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\WargaController;
use App\Http\Controllers\LembagaDesaController;
use App\Http\Controllers\PerangkatDesaController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\JabatanLembagaController;

// Saat buka root, arahkan ke login dulu
Route::get('/', function () {
    return redirect()->route('login');
});

// Halaman login & register
Route::get('/login', [AuthController::class, 'index'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.process');
Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
Route::post('/register', [AuthController::class, 'register'])->name('register.process');

// Setelah login berhasil → ke halaman success
Route::get('/success', [AuthController::class, 'success'])->name('login.success');

// Logout
Route::get('/logout', [AuthController::class, 'logout'])->name('logout');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout.post');

// Dashboard (hanya bisa diakses setelah login)
Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard.index');

// CRUD Warga
Route::resource('warga', WargaController::class);

// CRUD Lembaga Desa
Route::resource('lembaga', LembagaDesaController::class);

Route::get('/user', [UserController::class, 'index'])->name('user.index');

Route::resource('user', UserController::class);


// Perangkat Desa
Route::get('perangkat-desa', [PerangkatDesaController::class, 'index'])->name('perangkat.index');

// Route untuk Jabatan Lembaga
Route::resource('jabatan-lembaga', JabatanLembagaController::class);
