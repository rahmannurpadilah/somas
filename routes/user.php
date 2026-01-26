<?php

use App\Http\Controllers\ApifyWebhookController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ContentSourcesController;
use App\Http\Controllers\ScrapeController;
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

    Route::prefix('content-source')->name('content-source.')->group(function () {
        
        Route::get('/index', [ContentSourcesController::class, 'index'])
            ->name('index');
    
        Route::get('/create', [ContentSourcesController::class, 'create'])
            ->name('create');
    
        Route::post('/create', [ContentSourcesController::class, 'make'])
            ->name('make');
    
        Route::get('/edit/{hash}', [ContentSourcesController::class, 'edit'])
            ->name('edit');
    
        Route::post('/edit', [ContentSourcesController::class, 'update'])
            ->name('update');
    
        Route::post('/delete/{hash}', [ContentSourcesController::class, 'delete'])
            ->name('delete');
    
    });
    
    Route::post('/scrape/{hash}', [ScrapeController::class, 'start'])->name('scrape');
    Route::post('/webhook/apify', [ApifyWebhookController::class, 'handle'])->name('apify.webhook');


    Route::prefix('content-ideas/')->name('content-ideas')->group(function () {
    });

});
