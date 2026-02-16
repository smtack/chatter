<?php

use App\Http\Controllers\Auth\Login;
use App\Http\Controllers\Auth\Logout;
use App\Http\Controllers\Auth\Register;
use App\Http\Controllers\Auth\Settings;
use App\Http\Controllers\PostController;
use App\Http\Controllers\FriendshipController;
use App\Http\Controllers\LikeController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ReplyController;
use App\Http\Controllers\SearchController;
use Illuminate\Support\Facades\Route;

Route::view('/', 'welcome')
    ->middleware('guest');

Route::middleware('auth')->group(function() {
    Route::get('/home', [PostController::class, 'index']);
    Route::post('/posts', [PostController::class, 'store']);
    Route::get('/posts/{post}', [PostController::class, 'show']);
    Route::get('/posts/{post}/edit', [PostController::class, 'edit']);
    Route::put('/posts/{post}', [PostController::class, 'update']);
    Route::delete('/posts/{post}', [PostController::class, 'destroy']);
});

Route::middleware('auth')->group(function() {
    Route::post('/replies/{post}', [ReplyController::class, 'store']);
    Route::get('/replies/{reply}/edit', [ReplyController::class, 'edit']);
    Route::put('/replies/{reply}', [ReplyController::class, 'update']);
    Route::delete('/replies/{reply}', [ReplyController::class, 'destroy']);
});

Route::post('/posts/{post}/like', LikeController::class)
        ->middleware('auth')
        ->name('post.like');

Route::get('/search', SearchController::class);

// Register Routes
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

// Update Profile
Route::get('/settings', [Settings::class, 'index'])
    ->middleware('auth')
    ->name('auth.update');

Route::post('/update-profile', [Settings::class, 'updateProfile'])
    ->middleware('auth')
    ->name('auth.update-profile');

Route::post('/update-avatar', [Settings::class, 'updateAvatar'])
    ->middleware('auth')
    ->name('auth.update-avatar');

Route::post('/update-password', [Settings::class, 'updatePassword'])
    ->middleware('auth')
    ->name('auth.update-password');

Route::post('/delete-profile', [Settings::class, 'deleteProfile'])
    ->middleware('auth')
    ->name('auth.delete-profile');

// User Profile
Route::get('/profile/{user:username}', ProfileController::class)
    ->name('profile');

// Friends
Route::get('/friends', [FriendshipController::class, 'index'])
    ->middleware('auth')
    ->name('friends');

Route::post('/friends/{user}/add', [FriendshipController::class, 'addFriend'])
    ->middleware('auth')
    ->name('friends.add');

Route::patch('/friends/{user}/accept', [FriendshipController::class, 'acceptFriendRequest'])
    ->middleware('auth')
    ->name('friends.accept');

Route::delete('/friends/{user}/remove', [FriendshipController::class, 'removeFriend'])
    ->middleware('auth')
    ->name('friends.remove');