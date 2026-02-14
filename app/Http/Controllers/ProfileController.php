<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(User $user)
    {
        $posts = Post::with('user')
            ->withCount('likes')
            ->withExists(['likes as liked_by_user' => function($query) {
                $query->where('user_id', Auth::id());
            }])
            ->where('user_id', '=', $user->id)
            ->latest()
            ->paginate(15);

        return view('profile', compact('user', 'posts'));
    }
}
