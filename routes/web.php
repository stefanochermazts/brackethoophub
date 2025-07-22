<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\LanguageController;
use App\Http\Controllers\TournamentController;
use App\Http\Controllers\TournamentWizardController;

// Test route
Route::get('/test', function () {
    return view('test');
})->name('test');

// Language switching
Route::get('/language/{locale}', [LanguageController::class, 'switch'])->name('language.switch');

// Public routes
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/features', [HomeController::class, 'features'])->name('features');
Route::get('/pricing', [HomeController::class, 'pricing'])->name('pricing');
Route::get('/about', [HomeController::class, 'about'])->name('about');
Route::get('/contact', [HomeController::class, 'contact'])->name('contact');

// Authentication routes
Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login']);
    Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
    Route::post('/register', [AuthController::class, 'register']);
});

Route::post('/logout', [AuthController::class, 'logout'])->name('logout')->middleware('auth');

// Admin routes (accessible to admin and organizer)
Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('dashboard');
    Route::get('/users', [AdminController::class, 'users'])->name('users');
    
    // Tournament management
    Route::resource('tournaments', TournamentController::class);
    
    // Tournament wizard
    Route::prefix('tournaments/wizard')->name('tournaments.wizard.')->group(function () {
        Route::get('/step1', [TournamentWizardController::class, 'step1'])->name('step1');
        Route::post('/step1', [TournamentWizardController::class, 'storeStep1'])->name('store.step1');
        Route::get('/step2', [TournamentWizardController::class, 'step2'])->name('step2');
        Route::post('/step2', [TournamentWizardController::class, 'storeStep2'])->name('store.step2');
        Route::get('/step3', [TournamentWizardController::class, 'step3'])->name('step3');
        Route::post('/step3', [TournamentWizardController::class, 'storeStep3'])->name('store.step3');
        Route::get('/step4', [TournamentWizardController::class, 'step4'])->name('step4');
        Route::post('/step4', [TournamentWizardController::class, 'storeStep4'])->name('store.step4');
        Route::get('/review', [TournamentWizardController::class, 'review'])->name('review');
        Route::post('/store', [TournamentWizardController::class, 'store'])->name('store');
        Route::get('/cancel', [TournamentWizardController::class, 'cancel'])->name('cancel');
    });
});

// Admin-only routes (accessible only to admin)
Route::middleware(['auth', 'admin.only'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/settings', [AdminController::class, 'settings'])->name('settings');
});
