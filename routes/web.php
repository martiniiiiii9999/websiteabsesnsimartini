<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\AbsensiController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Routes Absensi
    Route::get('/absensi', [AbsensiController::class, 'index'])->name('absensi.index');
    Route::get('/absensi/daftar', [AbsensiController::class, 'daftar'])->name('absensi.daftar');
    Route::get('/absensi/{id}/edit', [AbsensiController::class, 'edit'])->name('absensi.edit');
    Route::post('/absensi', [AbsensiController::class, 'store'])->name('absensi.store');
    Route::put('/absensi/{id}', [AbsensiController::class, 'update'])->name('absensi.update');
    Route::delete('/absensi/{id}', [AbsensiController::class, 'destroy'])->name('absensi.destroy');
});

require __DIR__.'/auth.php';
