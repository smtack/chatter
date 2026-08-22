<?php

use App\Http\Controllers\Auth\Login;
use App\Http\Controllers\Auth\Logout;
use App\Http\Controllers\Auth\Register;
use App\Http\Controllers\Auth\Settings;
use Illuminate\Support\Facades\Route;

// Register
Route::view('/register', 'auth.register')
    ->middleware('guest')
    ->name('register');

Route::post('/register', Register::class)
    ->middleware('guest');

// Login
Route::view('/login', 'auth.login')
    ->middleware('guest')
    ->name('login');

Route::post('/login', Login::class)
    ->middleware('guest');

// Logout
Route::post('/logout', Logout::class)
    ->middleware('auth')
    ->name('logout');

// Profile settings
Route::get('/settings', [Settings::class, 'index'])
    ->middleware('auth')
    ->name('auth.update');

Route::post('/update-profile', [Settings::class, 'updateProfile'])
    ->middleware('auth')
    ->name('auth.update-profile');

Route::post('/update-avatar', [Settings::class, 'updateAvatar'])
    ->middleware('auth')
    ->name('auth.update-avatar');

Route::post('/update-bio', [Settings::class, 'updateBio'])
    ->middleware('auth')
    ->name('auth.update-bio');

Route::post('/update-password', [Settings::class, 'updatePassword'])
    ->middleware('auth')
    ->name('auth.update-password');

Route::post('/delete-profile', [Settings::class, 'deleteProfile'])
    ->middleware('auth')
    ->name('auth.delete-profile');
