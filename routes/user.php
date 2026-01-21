<?php

use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;

Route::middleware(['user'])->group(function () {

    // ===== LOGOUT =====
    Route::post('/logout', [AuthController::class, 'logout'])
        ->name('auth.logout');

    // ===== DELETE ACCOUNT =====
    Route::get('/delete-account', [AuthController::class, 'showDeleteAccount'])
        ->name('auth.delete-account');

    Route::post('/delete-account', [AuthController::class, 'deleteAccount'])
        ->name('auth.delete-account.confirm');

    // ===== DASHBOARD =====
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    // ===== CONTOH MODULE SOMAS =====
    Route::get('/content', function () {
        return view('content.index');
    });

});
