<?php

use App\Http\Controllers\AboutController;
use App\Http\Controllers\ProdukController;
use App\Http\Controllers\ProfilController;
use App\Http\Controllers\RegistrasiController;
use Illuminate\Support\Facades\Route;

Route::prefix('admin')->middleware('auth')->group(function () {

    Route::get('/about', [AboutController::class, 'index'])->name('about');
    Route::get('/profil', [ProfilController::class, 'index'])->name('profil');

      Route::prefix('produk')->group(function () {
        Route::get('/get-table', [ProdukController::class, 'getDataTable'])->name('produk.getTable');
        Route::get('/', [ProdukController::class, 'index'])->name('produk');
        Route::get('/create', [ProdukController::class, 'create'])->name('produk.create');
        Route::get('/detail/{id}', [ProdukController::class, 'show'])->name('produk.detail');
        Route::get('/edit/{id}', [ProdukController::class, 'edit'])->name('produk.edit');
        Route::post('/', [ProdukController::class, 'store'])->name('produk.store');
        Route::put('/{id}', [ProdukController::class, 'update'])->name('produk.update');
        Route::delete('/{id}', [ProdukController::class, 'destroy'])->name('produk.delete');
    });

    Route::prefix('registrasi')->group(function () {
        Route::get('/get-table', [RegistrasiController::class, 'getDataTable'])->name('registrasi.getTable');
        Route::get('/reset-password/{id}', [RegistrasiController::class, 'resetPassword'])->name('registrasi.resetPassword');
        Route::get('/', [RegistrasiController::class, 'index'])->name('registrasi');
        Route::get('/create', [RegistrasiController::class, 'create'])->name('registrasi.create');
        Route::get('/detail/{id}', [RegistrasiController::class, 'show'])->name('registrasi.detail');
        Route::get('/edit/{id}', [RegistrasiController::class, 'edit'])->name('registrasi.edit');
        Route::post('/', [RegistrasiController::class, 'store'])->name('registrasi.store');
        Route::put('/reset-password/{id}', [RegistrasiController::class, 'updatePassword'])->name('registrasi.updatePassword');
        Route::put('/{id}', [RegistrasiController::class, 'update'])->name('registrasi.update');
        Route::delete('/{id}', [RegistrasiController::class, 'destroy'])->name('registrasi.delete');
    });
});
