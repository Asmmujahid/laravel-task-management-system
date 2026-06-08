<?php

namespace App\Http\Controllers\TeamMember;

use App\Http\Controllers\Controller;
use App\Models\Task;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


use App\Notifications\TaskStatusNotification;


class TaskController extends Controller
{
    /**
     * =====================================================
     * SHOW ALL ASSIGNED TASKS TO TEAM MEMBER
     * =====================================================
     */
    // ================= TASK LIST =================
    public function index()
    {
        $tasks = Task::with([
                'team.lead',
                'category',
                'creator'
            ])
            ->where('assigned_to', Auth::id())
            ->latest()
            ->get();

        return view('team_member.tasks', compact('tasks'));
    }

    // ================= UPDATE STATUS =================
    public function updateStatus(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|in:pending,in_progress,completed',
        ]);

        $task = Task::where('id', $id)
            ->where('assigned_to', Auth::id())
            ->firstOrFail();

        $task->update([
            'status' => $request->status,
        ]);

        /**
         * ============================================
         * SEND NOTIFICATION TO TEAM LEAD
         * ============================================
         */

        // TEAM LEAD USER
        $teamLead = $task->team->lead ?? null;

        if ($teamLead) {

            $teamLead->notify(
                new TaskStatusNotification($task)
            );
        }

        return redirect()->back()
            ->with('success', 'Task status updated successfully.');
    }

    /**
     * =====================================================
     * SHOW SINGLE TASK DETAILS
     * =====================================================
     */
    public function show($id)
    {
        $task = Task::with([
                'creator',
                'team',
                'category'
            ])
            ->where('assigned_to', Auth::id())
            ->findOrFail($id);

        return view('team_member.show_task', compact('task'));
    }

    /**
     * =====================================================
     * MARK TASK COMPLETE
     * =====================================================
     */
    public function complete($id)
    {
        $task = Task::where('assigned_to', Auth::id())
            ->findOrFail($id);

        $task->update([
            'status' => 'completed'
        ]);

        /**
         * ============================================
         * SEND NOTIFICATION TO TEAM LEAD
         * ============================================
         */
        $teamLead = $task->team->lead ?? null;

        if ($teamLead) {

            $teamLead->notify(
                new TaskStatusNotification($task)
            );
        }

        return back()->with('success', 'Task marked as completed.');
    }
}