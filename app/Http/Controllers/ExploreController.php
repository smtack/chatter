<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class ExploreController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {
        $posts = Post::with(['user', 'profile'])
        ->withCount('likes')
        ->withExists(['likes as liked_by_user' => function($query) {
            $query->where('user_id', Auth::id());
        }])
        ->latest()
        ->paginate(10);

        return view('explore', compact('posts'));
    }
}
