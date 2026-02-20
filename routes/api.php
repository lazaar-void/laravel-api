<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\CustomerController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

// On combine auth.basic ET le rate limiting (60 requêtes / 1 minute)
Route::middleware(['auth.basic', 'throttle:60,1'])->group(function () {
    Route::get('/users', [CustomerController::class, 'index']);
});
