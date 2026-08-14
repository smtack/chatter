<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class ProfileController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(User $user): View
    {
        $posts = $user->wall()
            ->with(['user', 'profile'])
            ->withCount('likes')
            ->withExists(['likes as liked_by_user' => function($query) {
                $query->where('user_id', Auth::id());
            }])
            ->latest()
            ->paginate(10);

        return view('profile', compact('user', 'posts'));
    }
}
