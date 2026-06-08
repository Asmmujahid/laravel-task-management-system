<?php

namespace App\Http\Controllers\TeamLead;

use App\Http\Controllers\Controller;
use App\Models\Team;
use App\Models\User;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TeamController extends Controller
{
    // ================= INDEX =================
    public function index()
    {
        $teams = Team::where('lead_id', Auth::id())
            ->with('members', 'category')
            ->get();

        return view('team_lead.teams.index', compact('teams'));
    }

    // ================= CREATE =================
    public function create()
    {
        $users = User::where('role', 'team_member')
            ->whereNull('team_id')
            ->get();

        $categories = Category::all();

        return view('team_lead.teams.create', compact('users', 'categories'));
    }

    // ================= STORE =================
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'category_id' => 'required|exists:categories,id',
            'members' => 'required|array'
        ]);

        $team = Team::create([
            'name' => $request->name,
            'lead_id' => Auth::id(), // ✅ important
            'category_id' => $request->category_id,
        ]);

        User::whereIn('id', $request->members)
            ->update(['team_id' => $team->id]);

              /**
     * ====================================
     * SEND NOTIFICATION TO TEAM MEMBERS
     * ====================================
     */

    $members = User::whereIn('id', $request->members)->get();

    foreach ($members as $member) {

        $member->notify(

            new \App\Notifications\TeamCreatedNotification($team)

        );
    }

        return redirect()->route('team_lead.teams.index')
            ->with('success', 'Team created successfully');
    }

    // ================= EDIT =================
    public function edit($id)
    {
        $team = Team::findOrFail($id);

        $users = User::where('role', 'team_member')->get();
        $categories = Category::all();

        return view('team_lead.teams.edit', compact('team', 'users', 'categories'));
    }

    // ================= UPDATE =================
    public function update(Request $request, $id)
    {
        $team = Team::findOrFail($id);

        $team->update([
            'name' => $request->name,
            'category_id' => $request->category_id,
        ]);

        User::where('team_id', $team->id)->update(['team_id' => null]);

        if ($request->members) {
            User::whereIn('id', $request->members)
                ->update(['team_id' => $team->id]);
        }

        return redirect()->route('team_lead.teams.index')
            ->with('success', 'Team updated successfully');
    }

    // ================= DELETE =================
    public function destroy($id)
    {
        $team = Team::findOrFail($id);

        User::where('team_id', $team->id)->update(['team_id' => null]);

        $team->delete();

        return back()->with('success', 'Team deleted successfully');
    }

    // ================= REMOVE MEMBER =================
    public function removeMember($id)
    {
        $user = User::find($id);

        if ($user) {
            $user->team_id = null;
            $user->save();
        }

        return back()->with('success', 'Member removed');
    }
}