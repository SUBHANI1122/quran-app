<?php

use App\Http\Controllers\laravel_example\Reports\ProfitLossController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\language\LanguageController;
use App\Http\Controllers\pages\UserProfile;
use App\Http\Controllers\dome_carlow\HomeController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\form_wizard\Numbered as FormWizardNumbered;
use App\Http\Controllers\form_wizard\Icons as FormWizardIcons;
use App\Http\Controllers\form_validation\Validation;
use App\Http\Controllers\laravel_example\PageController;

Auth::routes();


Route::get('/', [PageController::class, 'index'])->name('index');
Route::get('/about-us', [PageController::class, 'aboutUs'])->name('about');
Route::get('/quran', [PageController::class, 'quran'])->name('quran');
Route::get('/contact-us', [PageController::class, 'contactUs'])->name('contact');
Route::get('/blogs', [PageController::class, 'blogs'])->name('blogs');
Route::get('/quran-bil-awunwan', [PageController::class, 'quranBilAunwan'])->name('quran-bil-awunwan');

Route::group(['middleware' => 'auth'], function () {
  Route::get('home', [HomeController::class, 'dashboard'])->name('dashboard');
});
// Main Page Route
// Route::any('/', [LoginController::class, 'showLoginForm'])->name('login');

// Route to handle the login submission
Route::post('/login', [LoginController::class, 'login'])->name('login.post');

Route::get('/date/time', [HomeController::class, 'date_time'])->name('dome-carlow.date_time');
Route::get('/personal/info', [HomeController::class, 'personal_info'])->name('dome-carlow.personal_info');
Route::get('/payment', [HomeController::class, 'payment'])->name('dome-carlow.payment');
// locale
Route::get('/lang/{locale}', [LanguageController::class, 'swap']);

Route::get('/user-security', [UserProfile::class, 'security'])->name('user-security');




// Route::get('/form/wizard-numbered', [FormWizardNumbered::class, 'index'])->name('form-wizard-numbered');
// Route::get('/form/wizard-icons', [FormWizardIcons::class, 'index'])->name('form-wizard-icons');
Route::get('/topics', [Validation::class, 'index'])->name('topics.index');
Route::get('/topic/create', [Validation::class, 'create'])->name('topic.create');
Route::get('/topics/{topic}/edit', function ($id) {
  return view('content.laravel-example.topics.edit', ['topic_id' => $id]);
})->name('topic.edit');

Route::delete('/topics/{topic}', [Validation::class, 'destroy']);
Route::post('/topics/set-topic-of-the-day/{id}', [Validation::class, 'setTopicOfTheDay']);












// In your routes file (web.php or api.php depending on your setup)




// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
