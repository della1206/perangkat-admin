<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\WargaController;
use App\Http\Controllers\LembagaDesaController;
use App\Http\Controllers\PerangkatDesaController;

<<<<<<< HEAD
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
=======
// Redirect root ke dashboard
Route::get('/', function () {
    return redirect()->route('dashboard.index');
});

// Dashboard
Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard.index');
>>>>>>> 59432ac6662f10f497865ea45af921c8593438ac

// CRUD Warga
Route::resource('warga', WargaController::class);

// CRUD Lembaga Desa
Route::resource('lembaga', LembagaDesaController::class);

// Perangkat Desa
Route::get('perangkat-desa', [PerangkatDesaController::class, 'index'])->name('perangkat.index');
<<<<<<< HEAD

=======
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
>>>>>>> 59432ac6662f10f497865ea45af921c8593438ac
