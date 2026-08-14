<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\User;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{
    use AuthorizesRequests;

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
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
    public function store(Request $request, User $profile)
    {
        $validated = $request->validate([
            'message' => 'required|string|min:3|max:255',
        ], [
            'message.required' => 'Please write something to post!',
            'message.max' => 'Posts must be 255 characters or less.',
        ]);

        Auth::user()->posts()->create([
            'message' => $validated['message'],
            'profile_id' => $profile->id,
        ]);

        return redirect()->back();
    }

    /**
     * Display the specified resource.
     */
    public function show(Post $post)
    {
        $post->load('user')
            ->loadCount('likes')
            ->loadExists(['likes as liked_by_user' => function($query) {
                $query->where('user_id', Auth::id());
            }]);

        $replies = $post->replies()
            ->with('user')
            ->latest()
            ->paginate(15);

        return view('posts.show', compact('post', 'replies'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Post $post)
    {
        $this->authorize('update', $post);

        session(['url.intended' => url()->previous()]);

        return view('posts.edit', compact('post'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Post $post)
    {
        $this->authorize('update', $post);

        $validated = $request->validate([
            'message' => 'required|string|min:3|max:255',
        ], [
            'message.required' => 'Please write something to post!',
            'message.max' => 'Posts must be 255 characters or less.',
        ]);

        $post->update($validated);

        return redirect()
            ->to(session()->pull('url.intended', route('home')))
            ->with('success', 'Your Post has been updated!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Post $post)
    {
        $this->authorize('delete', $post);

        $post->delete();

        return redirect()->back()->with('success', 'Your Post has been deleted!');
    }
}
