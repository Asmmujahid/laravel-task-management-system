<?php

namespace App\Http\Controllers\TeamMember;

use App\Http\Controllers\Controller;
use App\Models\Task;
use App\Models\Team;
use Illuminate\Support\Facades\Auth;

class TeamMemberController extends Controller
{
    /**
     * =====================================================
     * TEAM MEMBER DASHBOARD
     * =====================================================
     */
public function dashboard()
{
    $userId = Auth::id();

    $tasks = Task::where('assigned_to', $userId)->get();

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

    $team = Team::whereHas('members', function ($q) use ($userId) {
        $q->where('id', $userId);
    })
    ->with('lead')
    ->first();

    $teamLead = $team?->lead;

    return view(
        'team_member.dashboard',
        compact(
            'totalTasks',
            'completedTasks',
            'pendingTasks',
            'inProgressTasks',
            'teamLead'
        )
    );
}
}