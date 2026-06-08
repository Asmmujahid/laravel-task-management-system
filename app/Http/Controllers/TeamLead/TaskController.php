<?php

namespace App\Http\Controllers\TeamLead;

use App\Http\Controllers\Controller;
use App\Http\Requests\TaskRequest;
use App\Models\Task;
use App\Models\Team;
use App\Models\Category;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Notifications\TaskAssigned;

class TaskController extends Controller
{
    // ================= INDEX =================
    public function index()
    {
        // TEAM IDS OF LOGGED IN TEAM LEAD
        $teams = Team::where('lead_id', Auth::id())
            ->pluck('id');

        $tasks = Task::with([
                'team',
                'category',
                'creator',
                'assignedUser'
            ])
            ->where(function ($query) use ($teams) {

                // TASKS ASSIGNED TO TEAM LEAD
                $query->where('assigned_to', Auth::id())

                    // TASKS OF TEAM LEAD TEAMS
                    ->orWhereIn('team_id', $teams);
            })
            ->latest()
            ->get();

        return view('team_lead.tasks.index', compact('tasks'));
    }

    // ================= CREATE =================
    public function create()
    {
        $teams = Team::where('lead_id', Auth::id())
            ->with('members')
            ->get();

        $categories = Category::all();

        return view('team_lead.tasks.create', compact(
            'teams',
            'categories'
        ));
    }

    // ================= STORE =================
    public function store(TaskRequest $request)
    {
        $request->validate([
            'title'       => 'required|string|max:255',
            'team_id'     => 'required|exists:teams,id',
            'category_id' => 'required|exists:categories,id',
            'due_date'    => 'nullable|date',
        ]);

        $team = Team::with('members')
            ->findOrFail($request->team_id);

        foreach ($team->members as $member) {

            Task::create([
                'title'       => $request->title,
                'description' => $request->description,
                'team_id'     => $team->id,
                'assigned_to' => $member->id,
                'created_by'  => Auth::id(),
                'category_id' => $request->category_id,
                'status'      => $request->status,
                'due_date'    => $request->due_date,
            ]);
        }

        return redirect()
            ->route('team_lead.tasks.index')
            ->with('success', 'Task assigned successfully.');
    }

    // ================= SHOW =================
    public function show($id)
    {
        $task = Task::with([
                'team',
                'category',
                'creator',
                'assignedUser'
            ])
            ->findOrFail($id);

        return view('team_lead.tasks.show', compact('task'));
    }

    // ================= EDIT =================
// ================= EDIT =================
public function edit($id)
{
    $task = Task::findOrFail($id);

    $teams = Team::where('lead_id', Auth::id())
        ->with('members')
        ->get();

    // GET ALL TEAM MEMBERS
    $teamMembers = collect();

    foreach ($teams as $team) {
        $teamMembers = $teamMembers->merge($team->members);
    }

    $categories = Category::all();

    return view('team_lead.tasks.edit', compact(
        'task',
        'teams',
        'teamMembers',
        'categories'
    ));
}

    // ================= UPDATE =================
public function update(Request $request, $id)
{
    $task = Task::findOrFail($id);

    // OLD STATUS
    $oldStatus = $task->status;

    $request->validate([

        'status' => 'required|in:pending,in_progress,completed',

        'team_id' => 'required|exists:teams,id',

        'assigned_to' => 'required|exists:users,id',
    ]);

    // UPDATE TASK
    $task->update([

        'status' => $request->status,

        'team_id' => $request->team_id,

        'assigned_to' => $request->assigned_to,
    ]);

    // GET UPDATED USER
    $user = User::find($request->assigned_to);

    // SEND NOTIFICATION
    if ($user) {

        $user->notify(

            new \App\Notifications\TaskStatusNotification($task)

        );
    }

    return redirect()
        ->route('team_lead.tasks.index')
        ->with('success', 'Task updated successfully');
}
    // ================= ASSIGN FORM =================
    public function assignForm($id)
    {
        $task = Task::with('category')
            ->findOrFail($id);

        $teams = Team::with('members')
            ->where('lead_id', Auth::id())
            ->get();

        return view(
            'team_lead.tasks.assign',
            compact('task', 'teams')
        );
    }

    // ================= ASSIGN TO TEAM MEMBER =================
    public function assignToTeam(Request $request, $id)
    {
        $request->validate([
            'team_id' => 'required|exists:teams,id'
        ]);

        // ORIGINAL TASK
        $task = Task::findOrFail($id);

        // TEAM
        $team = Team::with('members')
            ->findOrFail($request->team_id);

        // FIRST TEAM MEMBER
        $member = $team->members->first();

        if (!$member) {

            return back()->with(
                'error',
                'No team members found.'
            );
        }

        // UPDATE SAME TASK
        $task->update([

            // ASSIGN TO TEAM MEMBER
            'assigned_to' => $member->id,

            // SAVE TEAM
            'team_id' => $team->id,
        ]);

           // SEND NOTIFICATION TO TEAM MEMBER
    $user = User::find($member->id);

    if ($user) {

        $user->notify(
            new TaskAssigned($task)
        );
    }

        return redirect()
            ->route('team_lead.tasks.index')
            ->with('success', 'Task assigned successfully.');
    }

    // ================= DELETE =================
    public function destroy($id)
    {
        $task = Task::findOrFail($id);

        $task->delete();

        return back()
            ->with('success', 'Task deleted successfully');
    }
}