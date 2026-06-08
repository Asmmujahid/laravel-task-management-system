<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Comment;
use Illuminate\Http\Request;
use App\Notifications\AdminSubmissionStatusNotification;

class TaskSubmissionController extends Controller
{
    public function index()
    {
        $submissions = Comment::with([
            'task',
            'task.files',
            'task.team.lead',
            'category',
            'user'
        ])
        ->where('lead_submit', 1)
        ->latest()
        ->get();

        return view('admin.submissions.index', compact('submissions'));
    }

public function updateStatus(Request $request, $id)
{
    $request->validate([
        'status' => 'required|in:approved,rejected,correction'
    ]);

    $submission = Comment::findOrFail($id);
    $submission->status = $request->status;
    $submission->save();

     /*
        |--------------------------------------------------------------------------
        | SEND NOTIFICATION TO TEAM LEAD
        |--------------------------------------------------------------------------
        */

        if ($submission->task &&
            $submission->task->team &&
            $submission->task->team->lead) {

            $submission->task
                ->team
                ->lead
                ->notify(
                    new AdminSubmissionStatusNotification($submission)
                );
        }

         /*
    |--------------------------------------------------------------------------
    | SEND NOTIFICATION TO TEAM MEMBER
    |--------------------------------------------------------------------------
    */

    if ($submission->user) {

        $submission->user->notify(
            new AdminSubmissionStatusNotification($submission)
        );
    }

    return back()->with('success', 'Status Updated Successfully');
}

    // EDIT PAGE
    public function edit($id)
    {
        $submission = Comment::with([
            'task',
            'category',
            'task.team.lead'
        ])->findOrFail($id);

        return view('admin.submissions.edit', compact('submission'));
    }

    // UPDATE
    public function update(Request $request, $id)
    {
        $request->validate([
            'comment' => 'required|string|max:5000'
        ]);

        $submission = Comment::findOrFail($id);

        $submission->comment = $request->comment;
        $submission->save();

        return redirect()
            ->route('admin.task.submissions')
            ->with('success', 'Submission Updated Successfully');
    }

    // DELETE
    public function delete($id)
    {
        Comment::findOrFail($id)->delete();

        return back()->with('success', 'Submission Deleted Successfully');
    }
}