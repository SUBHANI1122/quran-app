<?php

use App\Http\Controllers\laravel_example\Reports\ProfitLossController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\language\LanguageController;
use App\Http\Controllers\pages\UserProfile;
use App\Http\Controllers\dome_carlow\HomeController;
use App\Http\Controllers\Auth\LoginController;

Auth::routes();
Route::group(['middleware' => 'auth'], function () {
  Route::get('home', [HomeController::class, 'dashboard'])->name('dashboard');
});
// Main Page Route
Route::any('/', [LoginController::class, 'showLoginForm'])->name('login');

// Route to handle the login submission
Route::post('/login', [LoginController::class, 'login'])->name('login.post');

Route::get('/date/time', [HomeController::class, 'date_time'])->name('dome-carlow.date_time');
Route::get('/personal/info', [HomeController::class, 'personal_info'])->name('dome-carlow.personal_info');
Route::get('/payment', [HomeController::class, 'payment'])->name('dome-carlow.payment');
// locale
Route::get('/lang/{locale}', [LanguageController::class, 'swap']);

Route::get('/user-security', [UserProfile::class, 'security'])->name('user-security');










// In your routes file (web.php or api.php depending on your setup)




// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
