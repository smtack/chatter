<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {
        $feedIds = Auth::user()->friendsOfMine()->wherePivot('accepted', true)->pluck('friend_id')
            ->merge(Auth::user()->friendOf()->wherePivot('accepted', true)->pluck('user_id'))
            ->push(Auth::id());

        $posts = Post::with(['user', 'profile'])
            ->whereIn('user_id', $feedIds)
            ->withCount('likes')
            ->withExists(['likes as liked_by_user' => function($query) {
                $query->where('user_id', Auth::id());
            }])
            ->latest()
            ->paginate(10);

        return view('home', ['posts' => $posts]);
    }
}
