<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\HotelController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
| Backend Laravel + React + Sanctum (Token)
|--------------------------------------------------------------------------
*/

// =======================
// AUTH - ROUTES PUBLIQUES
// =======================
Route::get('/test', function () {
    return response()->json(['ok' => true]);
});

Route::post('/register', [AuthController::class, 'register']);
Route::post('/login',    [AuthController::class, 'login']);
Route::post('/forgot-password', [AuthController::class, 'forgotPassword']);
Route::post('/reset-password',  [AuthController::class, 'resetPassword']);

// =======================
// AUTH - ROUTES PROTÉGÉES
// =======================
Route::middleware('auth:sanctum')->group(function () {

    Route::post('/logout', [AuthController::class, 'logout']);

    Route::get('/user', function (Request $request) {
        return response()->json($request->user());
    });

    // =======================
    // HOTELS (CRUD)
    // =======================
    Route::apiResource('hotels', HotelController::class);
});
