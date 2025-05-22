<?php

use App\Http\Controllers\DosenController;
use App\Http\Controllers\MahasiswaController;
use App\Http\Controllers\DashboardController;
use Illuminate\Support\Facades\Route;

Route::get('/', [DashboardController::class, 'index'])->name('homepage'); //supaya bisa balik ke halaman homepage selamat datang klo di klik
Route::resource(name: 'dosen', controller: DosenController::class);
Route::resource(name: 'mahasiswa', controller: MahasiswaController::class);
Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
