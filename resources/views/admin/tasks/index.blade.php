@extends('layout.app')

@section('content')

<div class="content-container">

    <h2>Tasks</h2>

    <a href="{{ route('admin.tasks.create') }}" class="btn btn-primary mb-3">
        + Create Task
    </a>

    <div class="table-responsive">

        <table class="table table-bordered table-striped align-middle">

            <thead class="table-dark">
                <tr>
                    <th>#</th>
                    <th>Title</th>
                    <th>Description</th>
                    <th>Assigned To</th>
                    <th>Created By</th>
                    <th>Category</th>
                    <th>Status</th>
                    <th>Due Date</th>
                    <th width="180">Actions</th>
                </tr>
            </thead>

            <tbody>

                @forelse($tasks as $task)

                <tr>
                    <td>{{ $loop->iteration }}</td>

                    <td>{{ $task->title }}</td>

                    <td>{{ $task->description }}</td>

                    <td>{{ $task->assignedUser->name ?? '-' }}</td>

                    <td>{{ $task->creator->name ?? '-' }}</td>

                    <td>{{ $task->category->name ?? '-' }}</td>

                    <td>
                        <span class="badge
                            {{ $task->status == 'pending' ? 'bg-warning' : '' }}
                            {{ $task->status == 'in_progress' ? 'bg-info' : '' }}
                            {{ $task->status == 'completed' ? 'bg-success' : '' }}">
                            {{ ucfirst($task->status) }}
                        </span>
                    </td>

                    <td>
                        {{ $task->due_date ? $task->due_date->format('d M Y') : '-' }}
                    </td>

                    <td>

                        <div class="actions">

                            <a href="{{ route('admin.tasks.edit', $task->id) }}"
                               class="btn btn-warning btn-sm">
                                Edit
                            </a>

                            <form action="{{ route('admin.tasks.destroy', $task->id) }}"
                                  method="POST"
                                  class="inline-form">

                                @csrf
                                @method('DELETE')

                                <button class="btn btn-danger btn-sm"
                                        onclick="return confirm('Are you sure?')">
                                    Delete
                                </button>

                            </form>

                        </div>

                    </td>

                </tr>

                @empty

                <tr>
                    <td colspan="9" class="empty">
                        No tasks found.
                    </td>
                </tr>

                @endforelse

            </tbody>

        </table>

    </div>

</div>

@endsection