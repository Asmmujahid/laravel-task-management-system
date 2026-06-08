<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Team;  // ✅ Add Team Model
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    // -------------------------------
    // LIST USERS
    // -------------------------------
    public function index()
    {
        $users = User::with('team')->orderBy('id', 'desc')->get();
        return view('admin.users.index', compact('users'));
    }

    // -------------------------------
    // SHOW CREATE FORM
    // -------------------------------
    public function create()
    {
        $teams = Team::all(); // ✅ FIXED
        return view('admin.users.create', compact('teams'));
    }

    // -------------------------------
    // STORE USER
    // -------------------------------
    public function store(Request $request)
    {
        $request->validate([
            'name'     => 'required|string|max:255',
            'email'    => 'required|email|unique:users',
            'password' => 'required|min:6',
            'role'     => 'required|in:admin,team_lead,team_member',
            'team_id'  => 'nullable|exists:teams,id'
        ]);

        User::create([
            'name'     => $request->name,
            'email'    => $request->email,
            'password' => Hash::make($request->password),
            'role'     => $request->role,
            'team_id'  => $request->team_id,
        ]);

        return redirect()->route('admin.users.index')->with('success', 'User created successfully.');
    }

    // -------------------------------
    // SHOW EDIT FORM
    // -------------------------------
    public function edit($id)
    {
        $user  = User::findOrFail($id);
        $teams = Team::all(); // ✅ FIXED

        return view('admin.users.edit', compact('user', 'teams'));
    }

    // -------------------------------
    // UPDATE USER
    // -------------------------------
    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);

        $request->validate([
            'name'    => 'required|string|max:255',
            'email'   => 'required|email|unique:users,email,' . $id,
            'role'    => 'required|in:admin,team_lead,team_member',
            'team_id' => 'nullable|exists:teams,id'
        ]);

        $user->update([
            'name'    => $request->name,
            'email'   => $request->email,
            'role'    => $request->role,
            'team_id' => $request->team_id,
        ]);

        return redirect()->route('admin.users.index')->with('success', 'User updated successfully.');
    }

    // -------------------------------
    // DELETE USER
    // -------------------------------
    public function destroy($id)
    {
        User::destroy($id);
        return redirect()->back()->with('success', 'User deleted successfully.');
    }
}
