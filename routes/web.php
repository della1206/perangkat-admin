<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\WargaController;
use App\Http\Controllers\LembagaDesaController;
use App\Http\Controllers\PerangkatDesaController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\JabatanLembagaController;

// Redirect root ke login
Route::get('/', function () {
    return redirect()->route('login');
});

// Authentication Routes (tanpa middleware)
Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'index'])->name('login');
    Route::post('/login', [AuthController::class, 'login'])->name('login.process');
    Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
    Route::post('/register', [AuthController::class, 'register'])->name('register.process');
});

// Logout
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Protected Routes (harus login)
Route::middleware(['auth'])->group(function () {
    // Dashboard - semua role bisa akses
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard.index');
    
    // Warga - semua role bisa akses
    Route::resource('warga', WargaController::class);
    
    // Route manual untuk warga
    Route::get('/warga', [WargaController::class, 'index'])->name('warga.index');
    Route::get('/warga/create', [WargaController::class, 'create'])->name('warga.create');
    Route::post('/warga', [WargaController::class, 'store'])->name('warga.store');
    Route::get('/warga/{warga}/edit', [WargaController::class, 'edit'])->name('warga.edit');
    Route::put('/warga/{warga}', [WargaController::class, 'update'])->name('warga.update');
    Route::delete('/warga/{warga}', [WargaController::class, 'destroy'])->name('warga.destroy');
    
    // Perangkat Desa - semua role bisa akses
    Route::resource('perangkat-desa', PerangkatDesaController::class);
    
    // Lembaga Desa - semua role bisa akses
    Route::resource('lembaga', LembagaDesaController::class);
    Route::delete('/lembaga/{id}/foto/{index}', [LembagaDesaController::class, 'deleteFoto'])
        ->name('lembaga.delete-foto');

    // Jabatan Lembaga - semua role bisa akses
    Route::resource('jabatan-lembaga', JabatanLembagaController::class);
    
    // User Management 
    // SEMUA YANG LOGIN BISA MELIHAT (INDEKS)
    Route::get('/user', [UserController::class, 'index'])->name('user.index');
    
    // TAMBAH USER - hanya super_admin dan admin yang bisa akses
    Route::middleware(['checkrole:super_admin,admin'])->group(function () {
        Route::get('/user/create', [UserController::class, 'create'])->name('user.create');
        Route::post('/user', [UserController::class, 'store'])->name('user.store');
    });
    
    // EDIT USER - hanya super_admin dan admin yang bisa akses
    Route::middleware(['checkrole:super_admin,admin'])->group(function () {
        Route::get('/user/{user}/edit', [UserController::class, 'edit'])->name('user.edit');
        Route::put('/user/{user}', [UserController::class, 'update'])->name('user.update');
    });
    
    // HAPUS USER - hanya super_admin dan admin yang bisa akses
    Route::middleware(['checkrole:super_admin,admin'])->group(function () {
        Route::delete('/user/{user}', [UserController::class, 'destroy'])->name('user.destroy');
    });
    
    // DETAIL USER - semua yang login bisa melihat
    Route::get('/user/{user}', [UserController::class, 'show'])->name('user.show');
});

// Fallback Route
Route::fallback(function () {
    return redirect()->route('dashboard.index');
});