<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\LogoutController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\SettingsController;
use Illuminate\Support\Facades\Route;

// Register
Route::view('/register', 'auth.register')
    ->middleware('guest')
    ->name('register');

Route::post('/register', RegisterController::class)
    ->middleware('guest');

// Login
Route::view('/login', 'auth.login')
    ->middleware('guest')
    ->name('login');

Route::post('/login', LoginController::class)
    ->middleware('guest');

// Logout
Route::post('/logout', LogoutController::class)
    ->middleware('auth')
    ->name('logout');

// Profile settings
Route::get('/settings', [SettingsController::class, 'index'])
    ->middleware('auth')
    ->name('auth.update');

Route::post('/update-profile', [SettingsController::class, 'updateProfile'])
    ->middleware('auth')
    ->name('auth.update-profile');

Route::post('/update-avatar', [SettingsController::class, 'updateAvatar'])
    ->middleware('auth')
    ->name('auth.update-avatar');

Route::post('/update-bio', [SettingsController::class, 'updateBio'])
    ->middleware('auth')
    ->name('auth.update-bio');

Route::post('/update-password', [SettingsController::class, 'updatePassword'])
    ->middleware('auth')
    ->name('auth.update-password');

Route::post('/delete-profile', [SettingsController::class, 'deleteProfile'])
    ->middleware('auth')
    ->name('auth.delete-profile');
