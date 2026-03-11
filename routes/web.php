<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
| Static, content-driven pages for asylummadetrack.com
| Plus dynamic routes for track league management.
|--------------------------------------------------------------------------
*/

// --------------------------------------------------
// Core pages (static Blade views)
// --------------------------------------------------
Route::view('/', 'pages.home')->name('home');
Route::view('/rules', 'pages.rules')->name('rules');
Route::view('/services', 'pages.services')->name('operations');
Route::view('/about', 'pages.about')->name('about');
Route::view('/contact', 'pages.contact')->name('contact');

// Registration (dynamic form)
Route::get('/registration', [\App\Http\Controllers\Public\RegistrationController::class, 'create'])->name('registration');
Route::post('/registration', [\App\Http\Controllers\Public\RegistrationController::class, 'store'])->name('registration.store');
Route::get('/registration/confirmation/{id}', [\App\Http\Controllers\Public\RegistrationController::class, 'confirmation'])->name('registration.confirmation');

// --------------------------------------------------
// Legal / informational
// --------------------------------------------------
Route::view('/privacy', 'pages.privacy')->name('privacy');
Route::view('/terms', 'pages.terms')->name('terms');

// --------------------------------------------------
// Legacy redirects
// --------------------------------------------------
require __DIR__ . '/legacy.php';

// --------------------------------------------------
// Dynamic public routes (schedule, results, standings)
// --------------------------------------------------
require __DIR__ . '/public.php';

// --------------------------------------------------
// Authentication routes
// --------------------------------------------------
Route::middleware('guest')->group(function () {
    Route::get('login', [\App\Http\Controllers\Auth\AuthenticatedSessionController::class, 'create'])->name('login');
    Route::post('login', [\App\Http\Controllers\Auth\AuthenticatedSessionController::class, 'store']);
    Route::get('register', [\App\Http\Controllers\Auth\RegisteredUserController::class, 'create'])->name('register');
    Route::post('register', [\App\Http\Controllers\Auth\RegisteredUserController::class, 'store']);
    Route::get('forgot-password', [\App\Http\Controllers\Auth\PasswordResetLinkController::class, 'create'])->name('password.request');
    Route::post('forgot-password', [\App\Http\Controllers\Auth\PasswordResetLinkController::class, 'store'])->name('password.email');
});

Route::middleware('auth')->group(function () {
    Route::post('logout', [\App\Http\Controllers\Auth\AuthenticatedSessionController::class, 'destroy'])->name('logout');
    
    // Profile routes (all authenticated users)
    Route::prefix('profile')->name('profile.')->group(function () {
        Route::get('/', [\App\Http\Controllers\ProfileController::class, 'index'])->name('index');
        Route::put('/', [\App\Http\Controllers\ProfileController::class, 'update'])->name('update');
        Route::put('/password', [\App\Http\Controllers\ProfileController::class, 'updatePassword'])->name('password');
    });
});

// --------------------------------------------------
// Portal routes (require authentication + roles)
// --------------------------------------------------
require __DIR__ . '/admin.php';
require __DIR__ . '/team.php';
require __DIR__ . '/driver.php';

// --------------------------------------------------
// Fallback (404)
// --------------------------------------------------
Route::fallback(function () {
    return response()
        ->view('errors.404', [], 404);
});
