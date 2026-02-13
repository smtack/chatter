<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Facades\Auth;

class FriendshipController extends Controller
{
    public function index()
    {
        $pendingFriendRequests = Auth::user()->receivedFriendRequests()->get();

        $friends = Auth::user()->friends();

        return view('friends', compact('pendingFriendRequests', 'friends'));
    }

    public function addFriend(User $user)
    {
        if (!$user) {
            return back();
        } else if (Auth::id() === $user->id) {
            return back();
        } else if (Auth::user()->hasSentFriendRequest($user)) {
            return back();
        } else if (Auth::user()->hasReceivedFriendRequest($user)) {
            return $this->acceptFriendRequest($user);
        } else if (Auth::user()->isFriendsWith($user)) {
            return back();
        }

        Auth::user()->friendsOfMine()->attach($user);

        return back()->with('success', 'Friend request sent!');
    }

    public function acceptFriendRequest(User $user)
    {
        if (!Auth::user()->hasReceivedFriendRequest($user)) {
            return back();
        }

        Auth::user()->receivedFriendRequests()->updateExistingPivot($user->id, [
            'accepted' => true,
        ]);

        return back()->with('success', 'Friend request accepted!');
    }

    public function removeFriend(User $user)
    {
        Auth::user()->friendsOfMine()->detach($user);
        Auth::user()->friendOf()->detach($user);

        return back()->with('success', "You are no longer friends with $user->name");
    }
}
