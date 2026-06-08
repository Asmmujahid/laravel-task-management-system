<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Task;
use App\Models\Team;
use App\Models\Category;

class AdminController extends Controller
{
    public function dashboard()
    {
        $totalUsers = User::count();

        $totalTeams = Team::count();

        $totalTasks = Task::count();

        $completedTasks = Task::where('status', 'completed')->count();

        $pendingTasks = Task::where('status', 'pending')->count();

        $progressTasks = Task::where('status', 'in_progress')->count();

        $categoriesCount = class_exists(Category::class)
            ? Category::count()
            : 0;

        $recentTasks = Task::latest()
            ->take(5)
            ->get();

            $submissionsCount = \App\Models\Comment::where('lead_submit',1)->count();

             $settingsCount = \App\Models\Setting::count();
        return view('admin.dashboard', compact(
            'totalUsers',
            'totalTeams',
            'totalTasks',
            'completedTasks',
            'pendingTasks',
            'progressTasks',
            'categoriesCount',
            'recentTasks',
            'submissionsCount',
'settingsCount',
        ));
    }
}