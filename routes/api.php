<?php

use App\Http\Controllers\Api\V1\CarController;
use App\Http\Controllers\Api\V1\CarRequestController;
use App\Http\Controllers\Api\V1\CreditCalculatorController;
use Illuminate\Support\Facades\Route;

Route::prefix('v1')->group(function () {
    Route::get('/cars', [CarController::class, 'index']);
    Route::get('/cars/{id}', [CarController::class, 'show']);
    Route::get('/credit/calculate', [CreditCalculatorController::class, 'calculate']);
    Route::post('/request', [CarRequestController::class, 'store']);
});
