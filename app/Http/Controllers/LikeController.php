<?php

namespace App\Http\Controllers;

use App\Models\Chirp;
use Illuminate\Support\Facades\Auth;

class LikeController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Chirp $chirp)
    {
        Auth::user()->likes()->toggle($chirp->id);

        return back();
    }
}
