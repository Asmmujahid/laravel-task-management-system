<?php

namespace App\Http\Controllers\TeamLead;

use App\Http\Controllers\Controller;
use App\Models\Task;
use App\Models\Team;
use App\Models\Category;
use App\Models\Comment;
use Illuminate\Support\Facades\Auth;

class TeamLeadController extends Controller
{
    public function dashboard()
    {
        $teams = Team::where('lead_id', Auth::id())
            ->with('members')
            ->get();

        $teamIds = $teams->pluck('id');

        $memberIds = collect();

        foreach ($teams as $team) {
            $memberIds = $memberIds->merge(
                $team->members->pluck('id')
            );
        }

        $tasks = Task::whereIn(
            'assigned_to',
            $memberIds
        )->get();

        $totalTasks = $tasks->count();

        $completedTasks = $tasks
            ->where('status', 'completed')
            ->count();

        $pendingTasks = $tasks
            ->where('status', 'pending')
            ->count();

        $inProgressTasks = $tasks
            ->where('status', 'in_progress')
            ->count();

        $teamMembers = $memberIds
            ->unique()
            ->count();

        $totalTeams = $teams->count();

        $totalCategories = Category::count();

        $totalSubmissions = Comment::whereHas(
            'task',
            function ($query) use ($teamIds) {
                $query->whereIn('team_id', $teamIds);
            }
        )->count();

        return view(
            'team_lead.dashboard',
            compact(
                'totalTasks',
                'completedTasks',
                'pendingTasks',
                'inProgressTasks',
                'teamMembers',
                'totalTeams',
                'totalCategories',
                'totalSubmissions'
            )
        );
    }
}