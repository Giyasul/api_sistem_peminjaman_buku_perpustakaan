<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\LoanController;
use App\Http\Controllers\LogAktivitasController;
use App\Http\Controllers\MemberController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

// Public routes
Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

// Protected routes (JWT required)
Route::middleware(['auth:api', 'log.activity'])->group(function () {

    // Auth
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::get('/me', [AuthController::class, 'me']);
    // User
    Route::apiResource('user', UserController::class)->except(['store']);
    // kategori buku
    Route::apiResource('categories', KategoriController::class);
    // buku
    Route::apiResource('book', BookController::class);
    // member
    Route::apiResource('member', MemberController::class);
    // loan
    Route::apiResource('loan', LoanController::class);
    // log aktivitas
    Route::get('/log', [LogAktivitasController::class, 'index']);
});
