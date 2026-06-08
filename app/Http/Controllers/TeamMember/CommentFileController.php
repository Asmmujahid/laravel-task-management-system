<?php

namespace App\Http\Controllers\TeamMember;

use App\Http\Controllers\Controller;
use App\Models\Task;
use App\Models\Comment;
use App\Models\File;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Notifications\CommentAdded;

class CommentFileController extends Controller
{
    public function index()
    {
        $tasks = Task::where('assigned_to', Auth::id())
            ->latest()
            ->get();

        $categories = Category::latest()->get();

        $records = Comment::with([
                'task',
                'category',
                'task.files'
            ])
            ->where('user_id', Auth::id())
            ->latest()
            ->get();

        return view('team_member.comment_file', compact(
            'tasks',
            'categories',
            'records'
        ));
    }

    public function store(Request $request)
{
    $request->validate([

        'task_id'      => 'required|exists:tasks,id',
        'category_id'  => 'required|exists:categories,id',
        'comment'      => 'required|string|max:2000',
        'files.*'      => 'nullable|file|max:10240'

    ]);

    /**
     * ============================================
     * SAVE COMMENT
     * ============================================
     */
    $comment = Comment::create([

        'task_id'      => $request->task_id,
        'category_id'  => $request->category_id,
        'user_id'      => Auth::id(),
        'comment'      => $request->comment,

    ]);

    /**
     * ============================================
     * SAVE FILES
     * ============================================
     */
    if ($request->hasFile('files')) {

        foreach ($request->file('files') as $uploadFile) {

            $filename =
                time().'_'.$uploadFile->getClientOriginalName();

            $uploadFile->move(
                public_path('uploads/tasks'),
                $filename
            );

            File::create([

                'task_id'   => $request->task_id,
                'user_id'   => Auth::id(),
                'file_path' => $filename,

            ]);
        }
    }

    /**
     * ============================================
     * FIND TASK WITH TEAM LEAD
     * ============================================
     */
    $task = Task::with('team.lead')
        ->find($request->task_id);

    /**
     * ============================================
     * SEND NOTIFICATION TO TEAM LEAD
     * ============================================
     */
    if (
        $task &&
        $task->team &&
        $task->team->lead
    ) {

        $teamLead = $task->team->lead;

        $teamLead->notify(

            new CommentAdded(
                $task,
                $comment,
                Auth::user()
            )

        );
    }

    return back()->with(
        'success',
        'Task Work Submitted Successfully'
    );
}

    public function editComment($id)
    {
        $comment = Comment::where('user_id', Auth::id())
            ->findOrFail($id);

        $tasks = Task::where('assigned_to', Auth::id())->get();

        $categories = Category::latest()->get();

        return view('team_member.edit_comment', compact(
            'comment',
            'tasks',
            'categories'
        ));
    }

    public function updateComment(Request $request, $id)
    {
        $request->validate([
            'task_id'      => 'required|exists:tasks,id',
            'category_id'  => 'required|exists:categories,id',
            'comment'      => 'required|string|max:2000'
        ]);

        $comment = Comment::where('user_id', Auth::id())
            ->findOrFail($id);

        $comment->update([

            'task_id'      => $request->task_id,
            'category_id'  => $request->category_id,
            'comment'      => $request->comment

        ]);

        return redirect()
            ->route('team_member.comments.files')
            ->with('success', 'Updated Successfully');
    }

    public function deleteComment($id)
    {
        Comment::where('user_id', Auth::id())
            ->findOrFail($id)
            ->delete();

        return back()->with('success', 'Deleted Successfully');
    }

    public function deleteFile($id)
    {
        $file = File::where('user_id', Auth::id())
            ->findOrFail($id);

        $path = public_path('uploads/tasks/'.$file->file_path);

        if (file_exists($path)) {

            unlink($path);

        }

        $file->delete();

        return back()->with(
            'success',
            'File Deleted Successfully'
        );
    }
}