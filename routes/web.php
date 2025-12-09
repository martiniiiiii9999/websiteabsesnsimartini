<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AbsensiController;

Route::get('/', function () {
    return view('welcome');
});

// Routes Absensi
Route::get('/absensi', [AbsensiController::class, 'index'])->name('absensi.index');
Route::get('/absensi/daftar', [AbsensiController::class, 'daftar'])->name('absensi.daftar');
Route::post('/absensi', [AbsensiController::class, 'store'])->name('absensi.store');
Route::put('/absensi/{id}', [AbsensiController::class, 'update'])->name('absensi.update');
Route::delete('/absensi/{id}', [AbsensiController::class, 'destroy'])->name('absensi.destroy');
