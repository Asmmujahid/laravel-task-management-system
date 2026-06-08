<?php

namespace App\Http\Controllers\TeamLead;

use App\Http\Controllers\Controller;
use App\Models\Comment;
use App\Models\Team;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use App\Notifications\TeamLeadSubmissionNotification;
use App\Notifications\SubmissionReviewNotification;
use App\Notifications\AdminSubmissionStatusNotification;

class SubmissionController extends Controller
{
    public function index()
    {
        $teamIds = Team::where('lead_id', Auth::id())
            ->pluck('id');

        $submissions = Comment::with([
            'task',
            'task.files',
            'task.team',
            'task.assignedUser',
            'user',
            'category'
        ])
        ->whereHas('task', function ($query) use ($teamIds) {
            $query->whereIn('team_id', $teamIds);
        })
        ->latest()
        ->get();

        return view('team_lead.submissions.index', [
            'submissions' => $submissions
        ]);
    }

    public function review(Request $request, $id)
    {
        $request->validate([
            'review' => 'required|string|max:3000'
        ]);

        $comment = Comment::findOrFail($id);

        $comment->review = $request->review;
        $comment->save();

        /*
    |--------------------------------------------------------------------------
    | SEND REVIEW NOTIFICATION TO TEAM MEMBER
    |--------------------------------------------------------------------------
    */

    if ($comment->user) {

        $comment->user->notify(
            new SubmissionReviewNotification($comment)
        );
    }

        return redirect()->back()
            ->with('success', 'Review Submitted Successfully');
    }

    public function finalSubmit($id)
    {
        $comment = Comment::findOrFail($id);

        $comment->lead_submit = 1;
        $comment->save();



    /**
     * ====================================
     * SEND NOTIFICATION TO ADMIN
     * ====================================
     */

    $admins = User::where('role', 'admin')->get();

    foreach ($admins as $admin) {

        $admin->notify(

            new TeamLeadSubmissionNotification(
                $comment,
                Auth::user()
            )

        );
    }

        return redirect()->back()
            ->with('success', 'Task Submitted To Admin Successfully');
    }

    public function edit($id)
    {
        $submission = Comment::with([
            'task',
            'category',
            'user'
        ])->findOrFail($id);

        return view('team_lead.submissions.edit', [
            'submission' => $submission
        ]);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'comment' => 'required|string|max:5000'
        ]);

        $submission = Comment::findOrFail($id);

        $submission->comment = $request->comment;
        $submission->save();

        return redirect()
            ->route('team_lead.submissions')
            ->with('success', 'Submission Updated Successfully');
    }

    public function delete($id)
    {
        $submission = Comment::findOrFail($id);
        $submission->delete();

        return redirect()->back()
            ->with('success', 'Deleted Successfully');
    }
}