<?php

namespace App\Http\Controllers;

use App\Models\Chirp;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {
        $chirps = Chirp::with('user')
            ->where('message', 'like', '%' . $request->query('s') . '%')
            ->latest()
            ->paginate(15)
            ->withQueryString();

        return view('search', compact('chirps'));
    }
}
