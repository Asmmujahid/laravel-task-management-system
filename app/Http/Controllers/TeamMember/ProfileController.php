<?php

namespace App\Http\Controllers\TeamMember;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    public function edit()
    {
        $user = Auth::user();
        return view('team_member.profile.edit', compact('user'));
    }

    public function update(Request $request)
{
    $user = Auth::user();

    $request->validate([
        'name' => 'required|string|max:255',
        'email' => 'required|email|unique:users,email,' . $user->id,
        'password' => 'nullable|min:6|confirmed',
        'avatar' => 'nullable|image|mimes:jpg,png,jpeg|max:2048'
    ]);

    $user->name = $request->name;
    $user->email = $request->email;

    // Password update
    if ($request->password) {
        $user->password = Hash::make($request->password);
    }

    // Avatar upload
    if ($request->hasFile('avatar')) {
        $file = $request->file('avatar');
        $filename = time() . '.' . $file->getClientOriginalExtension();
        $file->move(public_path('uploads/avatars'), $filename);

        $user->avatar = $filename;
    }

    $user->save();

    return back()->with('success', 'Profile updated successfully!');
}
}
