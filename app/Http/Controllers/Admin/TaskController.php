<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Task;
use App\Models\User;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Notifications\TaskAssigned;
use App\Notifications\TaskStatusNotification;

class TaskController extends Controller
{
    public function index()
    {
        $tasks = Task::with([
            'assignedUser',
            'creator',
            'category'
        ])->latest()->get();

        return view('admin.tasks.index', compact('tasks'));
    }

    public function create()
    {
        $users = User::where('role', 'team_lead')->get();

        $categories = Category::all();

        return view('admin.tasks.create', compact(
            'users',
            'categories'
        ));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'description' => 'nullable',
            'assigned_to' => 'required|exists:users,id',
            'category_id' => 'required|exists:categories,id',
            'status' => 'required',
            'due_date' => 'nullable|date',
        ]);

        $task = Task::create([
            'title' => $request->title,
            'description' => $request->description,
            'assigned_to' => $request->assigned_to,
            'category_id' => $request->category_id,
            'created_by' => auth()->id(),
            'status' => $request->status,
            'due_date' => $request->due_date,
        ]);

        $user = User::find($request->assigned_to);

        if ($user) {
            $user->notify(new TaskAssigned($task));
        }

        return redirect()
            ->route('admin.tasks.index')
            ->with('success', 'Task created successfully and notification sent.');
    }

    public function show($id)
    {
        $task = Task::with([
            'assignedUser',
            'creator',
            'category'
        ])->findOrFail($id);

        return view('admin.tasks.show', compact('task'));
    }

    public function edit($id)
    {
        $task = Task::findOrFail($id);

        $users = User::where('role', 'team_lead')->get();

        $categories = Category::all();

        return view('admin.tasks.edit', compact(
            'task',
            'users',
            'categories'
        ));
    }

    public function update(Request $request, $id)
    {
        $task = Task::findOrFail($id);

        $request->validate([
            'title' => 'required',
            'assigned_to' => 'required|exists:users,id',
            'status' => 'required|in:pending,in_progress,completed',
            'category_id' => 'required|exists:categories,id',
            'due_date' => 'nullable|date',
        ]);

        $oldStatus = $task->status;

        $task->update([
            'title' => $request->title,
            'description' => $request->description,
            'assigned_to' => $request->assigned_to,
            'category_id' => $request->category_id,
            'status' => $request->status,
            'due_date' => $request->due_date,
        ]);

        // SEND STATUS NOTIFICATION
        if ($oldStatus != $request->status) {

            $user = User::find($task->assigned_to);

            if ($user) {

                $user->notify(
                    new TaskStatusNotification($task)
                );
            }
        }

        return redirect()
            ->route('admin.tasks.index')
            ->with('success', 'Task updated successfully.');
    }

    public function destroy($id)
    {
        Task::destroy($id);

        return redirect()
            ->back()
            ->with('success', 'Task deleted successfully.');
    }
}