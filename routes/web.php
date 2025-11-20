<?php

use App\Http\Controllers\InventoryController;
use App\Http\Controllers\PeminjamanController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SiswaController;
use App\Http\Controllers\TeacherController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PengembalianController;
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
});

Route::resource('teachers', TeacherController::class);
Route::resource('inventory', InventoryController::class);
Route::resource('siswa', SiswaController::class);

Route::resource('peminjaman', PeminjamanController::class);
Route::get('/peminjaman', [PeminjamanController::class, 'index'])->name('peminjaman.index');

Route::get('/cek-id/{role}/{id}', [PeminjamanController::class, 'cekId']);
Route::get('/cek-barang/{nama_barang}', [PeminjamanController::class, 'cekBarang']);

Route::get('/pengembalian', [PengembalianController::class, 'index'])->name('pengembalian.index');
Route::post('/pengembalian/approve/{id}', [PengembalianController::class, 'approveReturn'])->name('pengembalian.approve');


require __DIR__.'/auth.php';
