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
    Route::get('/categories/{id}/books', [KategoriController::class, 'books']);
    // buku
    Route::apiResource('book', BookController::class);
    Route::get('/books/dipinjam', [BookController::class, 'dipinjam']);
    // member
    Route::apiResource('member', MemberController::class);
    Route::get('/members/{id}/pinjaman', [MemberController::class, 'pinjaman']);
    // loan
    Route::apiResource('loan', LoanController::class);
    Route::get('/pinjaman/overdue', [LoanController::class, 'overdue']);
    Route::get('/pinjaman/aktif', [LoanController::class, 'aktif']);
    // log aktivitas
    Route::get('/log', [LogAktivitasController::class, 'index']);
});
