<?php
use App\Http\Controllers\laravel_example\AuthController;
use App\Http\Controllers\laravel_example\SurahController;
use App\Http\Controllers\laravel_example\AyahController;
use Illuminate\Support\Facades\Route;

// Public Routes
Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

// Protected Routes (Require Authentication)
Route::middleware('auth:sanctum')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout']);

    // Surah Routes
    Route::get('/surahs', [SurahController::class, 'index']);
    Route::get('/surahs/{id}', [SurahController::class, 'show']);



    // Ayah Routes
    Route::get('/ayahs', [AyahController::class, 'index']);
    Route::get('/ayahs/{id}', [AyahController::class, 'show']);
});
