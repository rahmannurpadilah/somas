<?php

use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;

Route::middleware(['user'])->group(function () {
    
    Route::prefix('admin')->name('admin.')->group(function() {
        Route::get('/users/index', [UserController::class, 'index'])->name('user.index');
        Route::get('/user/create', [UserController::class, 'create'])->name('user.create');
        Route::post('/user/create', [UserController::class, 'make'])->name('user.make');
        Route::get('/user/edit/{hash}', [UserController::class, 'edit'])->name('user.edit');
        Route::post('/user/edit', [UserController::class, 'update'])->name('user.update');
        Route::post('/user/delete/{hash}', [UserController::class, 'delete'])->name('user.delete');
    });

});
