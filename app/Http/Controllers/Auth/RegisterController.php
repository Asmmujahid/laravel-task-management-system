<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth; // ✅ IMPORTANT

class RegisterController extends Controller
{
   public function showRegistrationForm()
{
    return redirect()->route('home', [
        'form' => 'register'
    ]);
}

    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6|confirmed',
            'role' => 'required|in:admin,team_lead,team_member',
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => $request->role,
        ]);

        Auth::login($user);

        // ✅ FIXED ROUTES
        if ($user->role == 'admin') return redirect()->route('admin.dashboard');
        if ($user->role == 'team_lead') return redirect()->route('team_lead.dashboard');
        if ($user->role == 'team_member') return redirect()->route('team_member.dashboard');

        return redirect('/');
    }
}