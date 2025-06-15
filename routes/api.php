<?php

use App\Http\Controllers\laravel_example\AuthController;
use App\Http\Controllers\laravel_example\SurahController;
use App\Http\Controllers\laravel_example\AyahController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\form_validation\Validation;
use App\Http\Controllers\laravel_example\JuzController;
use App\Http\Controllers\laravel_example\TopicProgressController;


// Public Routes
Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

// Protected Routes (Require Authentication)
// Route::middleware('auth:sanctum')->group(function () {
Route::post('/logout', [AuthController::class, 'logout']);

// Surah Routes
Route::get('/surahs', [SurahController::class, 'index']);
Route::get('/surahs/{id}', [SurahController::class, 'show']);

Route::get('/juzs', [JuzController::class, 'index']);


// Ayah Routes
Route::get('/ayahs', [AyahController::class, 'index']);
Route::get('/ayahs/{id}', [AyahController::class, 'show']);

Route::get('/topics', [Validation::class, 'topicsApi']);
Route::get('/topics-of-the-day/{topic_id}', [Validation::class, 'getTopicOfTheDayById']);

Route::post('/topic-progress', [TopicProgressController::class, 'store']);
Route::get('/topic-progress/{user_id}', [TopicProgressController::class, 'getUserProgress']);



// });
