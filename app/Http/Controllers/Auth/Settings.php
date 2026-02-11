<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class Settings extends Controller
{
    public function index()
    {
        return view('auth.settings');
    }

    public function updateProfile(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'username' => [
                'required', 'string', 'max:16',
                Rule::unique('users')->ignore(Auth::id())
            ],
            'email' => [
                'required', 'string', 'email', 'max:255',
                Rule::unique('users')->ignore(Auth::id())
            ],
        ]);

        Auth::user()->update($validated);

        $request->session()->regenerate();

        return redirect('/settings')->with('success', 'Profile Updated!');
    }

    public function updateAvatar(Request $request)
    {
        $request->validate([
            'avatar' => 'required|image|mimes:jpg,png|max:2048',
        ]);

        $oldPath = Auth::user()->avatar;

        $path = $request->file('avatar')->store('avatars', 'public');

        Auth::user()->update(['avatar' => $path]);

        if ($oldPath !== 'avatars/default.png') {
            Storage::disk('public')->delete($oldPath);
        }

        $request->session()->regenerate();

        return redirect('/settings')->with('success', 'Avatar Updated!');
    }

    public function updatePassword(Request $request)
    {
        $validated = $request->validate([
            'current_password' => 'required|current_password',
            'new_password' => 'required|confirmed|min:8',
        ]);

        Auth::logoutOtherDevices($request->current_password);

        Auth::user()->update([
            'password' => Hash::make($validated['new_password']),
        ]);

        Auth::login(Auth::user());

        $request->session()->regenerate();

        return redirect('/settings')->with('success', 'Password Updated!');
    }

    public function deleteProfile(Request $request)
    {
        $request->validate([
            'password' => 'required|current_password',
        ]);

        Auth::user()->delete();

        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/')->with('success', 'Your profile has been deleted');
    }
}
