<?php

use App\Http\Controllers\ExploreController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\FriendshipController;
use App\Http\Controllers\LikeController;
use App\Http\Controllers\LocaleController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ReplyController;
use App\Http\Controllers\SearchController;
use Illuminate\Support\Facades\Route;

Route::redirect('/', '/register');

Route::get('lang/{lang}', LocaleController::class)->name('lang');

Route::get('/search', SearchController::class);

Route::get('/profile/{user:username}', ProfileController::class)->name('profile');

Route::middleware('auth')->group(function() {
    // Pages
    Route::get('/home', HomeController::class)->name('home');
    Route::get('/explore', ExploreController::class)->name('explore');

    // Post Routes
    Route::post('/posts/{profile}', [PostController::class, 'store'])->name('posts.store');
    Route::get('/posts/{post}', [PostController::class, 'show']);
    Route::get('/posts/{post}/edit', [PostController::class, 'edit']);
    Route::put('/posts/{post}', [PostController::class, 'update']);
    Route::delete('/posts/{post}', [PostController::class, 'destroy']);

    // Reply Routes
    Route::post('/replies/{post}', [ReplyController::class, 'store']);
    Route::get('/replies/{reply}/edit', [ReplyController::class, 'edit']);
    Route::put('/replies/{reply}', [ReplyController::class, 'update']);
    Route::delete('/replies/{reply}', [ReplyController::class, 'destroy']);

    // Likes
    Route::get('/likes', [LikeController::class, 'index'])->name('likes');
    Route::post('/posts/{post}/like', [LikeController::class, 'toggle'])->name('post.like');

    // Friends
    Route::get('/friends', [FriendshipController::class, 'index'])->name('friends');
    Route::post('/friends/{user}/add', [FriendshipController::class, 'addFriend'])->name('friends.add');
    Route::patch('/friends/{user}/accept', [FriendshipController::class, 'acceptFriendRequest'])->name('friends.accept');
    Route::delete('/friends/{user}/remove', [FriendshipController::class, 'removeFriend'])->name('friends.remove');
});

require __DIR__ . '/auth.php';
