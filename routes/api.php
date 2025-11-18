<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\UserController;

// --- PUBLIK (Bisa diakses siapa saja) ---
Route::post('/register', [AuthController::class, 'register']); // Tugas Syakila
Route::post('/login', [AuthController::class, 'login']);       // Tugas Ossa

// --- PROTECTED (Harus Login / Punya Token) ---
Route::group(['middleware' => 'auth:api'], function () {

    // User Biasa & Admin boleh akses
    Route::get('/products', [ProductController::class, 'index']); // Tugas Shelfina

    // --- KHUSUS ADMIN (RBAC) ---
    Route::group(['middleware' => 'role:admin'], function () {
        Route::put('/products/{id}', [ProductController::class, 'update']); // Tugas Karin
        Route::get('/users', [UserController::class, 'index']);             // Tugas Bening
    });

});

// Route Penyelamat (Biar ga error 500 kalau token salah)
Route::get('/login', function () {
    return response()->json(['error' => 'Token tidak valid (Unauthorized)'], 401);
})->name('login');
