<?php

namespace App\Http\Controllers\TeamLead;

use App\Http\Controllers\Controller;
use App\Models\Task;
use App\Models\Team;
use Illuminate\Support\Facades\Auth;

class ProgressController extends Controller
{
    public function index()
    {
        $teamIds = Team::where('lead_id', Auth::id())
                    ->pluck('id');

        $tasks = Task::with([
                    'assignedUser',
                    'team',
                    'category',
                    'comments.user',
                    'files.user'
                ])
                ->whereIn('team_id', $teamIds)
                ->get();

        return view('team_lead.progress.index', compact('tasks'));
    }
}