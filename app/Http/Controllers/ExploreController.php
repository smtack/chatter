<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class ExploreController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {
        $posts = Post::with(['user', 'profile'])->latest()->paginate(10);

        return view('explore', compact('posts'));
    }
}
