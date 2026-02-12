<?php

namespace App\Http\Controllers;

use App\Models\Chirp;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SearchController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {
        $keyword = $request->query('s');

        $chirps = Chirp::with('user')
            ->withCount('likes')
            ->withExists(['likes as liked_by_user' => function($query) {
                $query->where('user_id', Auth::id());
            }])
            ->where('message', 'like', "%$keyword%")
            ->latest()
            ->paginate(15)
            ->withQueryString();

        return view('search', compact('chirps'));
    }
}
