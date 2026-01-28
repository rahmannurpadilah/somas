<?php

use App\Http\Controllers\ApifyWebhookController;
use Illuminate\Support\Facades\Route;

Route::post('/webhook/apify', [ApifyWebhookController::class, 'handle'])->name('apify.webhook');