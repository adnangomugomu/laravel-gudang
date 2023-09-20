<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class, 'index'])->name('home')->middleware('auth');
Route::get('/login', [AuthController::class, 'index'])->name('login')->middleware('guest');
Route::post('/login/store', [AuthController::class, 'store'])->name('login.store')->middleware('throttle:login');
Route::get('/logout', [AuthController::class, 'destroy'])->name('login.logout')->middleware('auth');
