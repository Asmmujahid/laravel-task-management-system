<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Task;
use App\Models\Team;

class ReportController extends Controller
{
    public function index()
    {
        $totalUsers = User::count();
        $totalTeams = Team::count();
        $totalTasks = Task::count();

        $completedTasks = Task::where('status', 'completed')->count();
        $pendingTasks = Task::where('status', 'pending')->count();
        $progressTasks = Task::where('status', 'in_progress')->count();

        $tasksByStatus = Task::selectRaw('status, COUNT(*) as total')
            ->groupBy('status')
            ->get();

        $recentTasks = Task::with(['assignedUser', 'creator'])
            ->latest()
            ->take(5)
            ->get();

        return view('admin.reports.index', compact(
            'totalUsers',
            'totalTeams',
            'totalTasks',
            'completedTasks',
            'pendingTasks',
            'progressTasks',
            'tasksByStatus',
            'recentTasks'
        ));
    }
}