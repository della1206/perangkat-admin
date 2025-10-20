<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\WargaController;
use App\Http\Controllers\LembagaDesaController;
use App\Http\Controllers\PerangkatDesaController;

// Redirect root ke dashboard
Route::get('/', function () {
    return redirect()->route('dashboard.index');
});

// Dashboard
Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard.index');

// CRUD Warga
Route::resource('warga', WargaController::class);

// CRUD Lembaga Desa
Route::resource('lembaga', LembagaDesaController::class);

// Perangkat Desa
Route::get('perangkat-desa', [PerangkatDesaController::class, 'index'])->name('perangkat.index');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');