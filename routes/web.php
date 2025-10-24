<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\WargaController;
use App\Http\Controllers\LembagaDesaController;
use App\Http\Controllers\PerangkatDesaController;

// Halaman login
Route::get('/login', [AuthController::class, 'index'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.process');
Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
Route::post('/register', [AuthController::class, 'register'])->name('register.process');
Route::get('/success', [AuthController::class, 'success'])->name('login.success');
Route::get('/logout', [AuthController::class, 'logout'])->name('logout');

// Saat buka root, arahkan ke login dulu
Route::get('/', function () {
    return redirect()->route('login');
});

// Dashboard (muncul setelah login)
Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

// CRUD Warga
Route::resource('warga', WargaController::class);

// CRUD Lembaga Desa
Route::resource('lembaga', LembagaDesaController::class);

// Perangkat Desa
Route::get('perangkat-desa', [PerangkatDesaController::class, 'index'])->name('perangkat.index');

