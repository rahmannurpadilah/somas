<?php

use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('admin.dashboard');
});

// ===== LOGIN =====
Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showLogin'])
        ->name('auth.login');

    Route::post('/login', [AuthController::class, 'login'])
        ->name('auth.login.post');

    // ===== REGISTER =====
    // Route::get('/register', [AuthController::class, 'showRegis'])
    //     ->name('auth.register');

    // Route::post('/register', [AuthController::class, 'register'])
    //     ->name('auth.register.post');

    // ===== FORGOT PASSWORD =====
    Route::get('/forgot-password', [AuthController::class, 'showForgotPassword'])
        ->name('auth.forgot-password');

    Route::post('/forgot-password', [AuthController::class, 'sendResetLink']);

    // ===== RESET PASSWORD =====
    Route::get('/reset-password/{token}', [AuthController::class, 'showResetPassword'])
        ->name('auth.reset-password');

    Route::post('/reset-password', [AuthController::class, 'resetPassword']);
});

require __DIR__.'/admin.php';
require __DIR__.'/user.php';
