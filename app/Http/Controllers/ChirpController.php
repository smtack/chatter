<?php

namespace App\Http\Controllers;

use App\Models\Chirp;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ChirpController extends Controller
{
    use AuthorizesRequests;
    
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $feedIds = Auth::user()->friendsOfMine()->wherePivot('accepted', true)->pluck('friend_id')
            ->merge(Auth::user()->friendOf()->wherePivot('accepted', true)->pluck('user_id'))
            ->push(Auth::id());

        $chirps = Chirp::with('user')
            ->whereIn('user_id', $feedIds)
            ->withCount('likes')
            ->withExists(['likes as liked_by_user' => function($query) {
                $query->where('user_id', Auth::id());
            }])
            ->latest()
            ->paginate(15);

        return view('chirps.index', ['chirps' => $chirps]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'message' => 'required|string|max:255',
        ], [
            'message.required' => 'Please write something to chirp!',
            'message.max' => 'Chirps must be 255 characters or less.',
        ]);

        Auth::user()->chirps()->create($validated);

        return redirect('/home')->with('success', 'Your Chirp has been posted!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Chirp $chirp)
    {
        $this->authorize('update', $chirp);

        return view('chirps.edit', compact('chirp'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Chirp $chirp)
    {
        $this->authorize('update', $chirp);

        $validated = $request->validate([
            'message' => 'required|string|max:255',
        ], [
            'message.required' => 'Please write something to chirp!',
            'message.max' => 'Chirps must be 255 characters or less.',
        ]);

        $chirp->update($validated);

        return redirect('/home')->with('success', 'Your Chirp has been updated!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Chirp $chirp)
    {
        $this->authorize('delete', $chirp);

        $chirp->delete();

        return redirect('/home')->with('success', 'Your Chirp has been deleted!');
    }
}
