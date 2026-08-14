<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {
        $keyword = $request->query('s');

        $users = User::where('name', 'like', "%$keyword%")
            ->orWhere('username', 'like', "%$keyword")
            ->latest()
            ->paginate(10)
            ->withQueryString();

        return view('search', compact('users'));
    }
}
