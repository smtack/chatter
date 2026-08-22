<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Support\Facades\Auth;

class LikeController extends Controller
{
    /**
     * Display the likes page
     */
    public function index()
    {
        $posts = auth()->user()
            ->likes()
            ->with(['user', 'profile'])
            ->withCount('likes')
            ->withExists(['likes as liked_by_user' => function($query) {
                $query->where('user_id', Auth::id());
            }])
            ->latest()
            ->paginate(10);

        return view('likes', compact('posts'));
    }

    /**
     * Toggle like
     */
    public function toggle(Post $post)
    {
        Auth::user()->likes()->toggle($post->id);

        return back();
    }
}
