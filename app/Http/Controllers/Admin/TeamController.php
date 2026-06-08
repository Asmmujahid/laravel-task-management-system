<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Team;
use App\Models\User;
use App\Models\Category;
use Illuminate\Http\Request;

class TeamController extends Controller
{
    // ================= INDEX =================
    public function index()
    {
        $teams = Team::with('lead', 'members', 'category')->get();
        return view('admin.teams.index', compact('teams'));
    }

    // ================= CREATE =================
    public function create()
    {
        $leads = User::where('role', 'team_lead')->get();
        $categories = Category::all();
        $members = User::where('role', 'team_member')->get();

        return view('admin.teams.create', compact('leads', 'categories', 'members'));
    }

    // ================= STORE =================
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|unique:teams,name',
            'lead_id' => 'required|exists:users,id',
            'category_id' => 'required|exists:categories,id',
            'members' => 'required|array'
        ]);

        $team = Team::create([
            'name' => $request->name,
            'lead_id' => $request->lead_id,
            'category_id' => $request->category_id,
        ]);

        User::whereIn('id', $request->members)
            ->update(['team_id' => $team->id]);

        return redirect()->route('admin.teams.index')
            ->with('success', 'Team created successfully');
    }

    // ================= EDIT =================
    public function edit($id)
    {
        $team = Team::findOrFail($id);

        $leads = User::where('role', 'team_lead')->get();
        $categories = Category::all();
        $members = User::where('role', 'team_member')->get();

        return view('admin.teams.edit', compact(
            'team', 'leads', 'categories', 'members'
        ));
    }

    // ================= UPDATE =================
    public function update(Request $request, $id)
    {
        $team = Team::findOrFail($id);

        $request->validate([
            'name' => 'required',
            'lead_id' => 'required|exists:users,id',
            'category_id' => 'required|exists:categories,id',
        ]);

        $team->update([
            'name' => $request->name,
            'lead_id' => $request->lead_id,
            'category_id' => $request->category_id,
        ]);

        // remove old members
        User::where('team_id', $team->id)->update(['team_id' => null]);

        // assign new members
        if ($request->members) {
            User::whereIn('id', $request->members)
                ->update(['team_id' => $team->id]);
        }

        return redirect()->route('admin.teams.index')
            ->with('success', 'Team updated successfully');
    }

    // ================= DESTROY =================
    public function destroy($id)
    {
        $team = Team::findOrFail($id);

        User::where('team_id', $team->id)
            ->update(['team_id' => null]);

        $team->delete();

        return back()->with('success', 'Team deleted successfully');
    }
}