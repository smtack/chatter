<?php

namespace App\Http\Controllers;

use App\Models\Chirp;
use App\Models\User;

class ProfileController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(User $user)
    {
        $chirps = Chirp::with('user')
            ->where('user_id', '=', $user->id)
            ->latest()
            ->paginate(15);

        return view('profile', compact('user', 'chirps'));
    }
}
