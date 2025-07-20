<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LanguageController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Language switching
Route::get('language/{locale}', [LanguageController::class, 'switch'])->name('language.switch');

// Public website routes with SetLocale middleware
Route::middleware(['setlocale'])->group(function () {
    Route::get('/', [HomeController::class, 'index'])->name('home');
    Route::get('/features', [HomeController::class, 'features'])->name('features');
    Route::get('/pricing', [HomeController::class, 'pricing'])->name('pricing');
    Route::get('/about', [HomeController::class, 'about'])->name('about');
    Route::get('/contact', [HomeController::class, 'contact'])->name('contact');
});

// Authentication routes
Route::get('/login', [App\Http\Controllers\AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [App\Http\Controllers\AuthController::class, 'login']);
Route::get('/register', [App\Http\Controllers\AuthController::class, 'showRegister'])->name('register');
Route::post('/register', [App\Http\Controllers\AuthController::class, 'register']);
Route::post('/logout', [App\Http\Controllers\AuthController::class, 'logout'])->name('logout');

// Admin routes
Route::prefix('admin')->middleware(['auth', 'admin'])->group(function () {
    Route::get('/', [App\Http\Controllers\AdminController::class, 'dashboard'])->name('admin.dashboard');
    Route::get('/users', function () {
        return view('admin.users');
    })->name('admin.users');
    Route::get('/settings', function () {
        return view('admin.settings');
    })->name('admin.settings');
});
