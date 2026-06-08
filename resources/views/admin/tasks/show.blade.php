@extends('layout.app')

@section('content')

<div class="content-container">

    <h2>Task Details</h2>

    <div class="card p-4">

        <h3>{{ $task->title }}</h3>

        <p>
            <strong>Description:</strong>
            {{ $task->description }}
        </p>

        <p>
            <strong>Assigned To:</strong>
            {{ $task->assignedUser->name ?? '-' }}
        </p>

        <p>
            <strong>Created By:</strong>
            {{ $task->creator->name ?? '-' }}
        </p>

        <p>
            <strong>Category:</strong>
            {{ $task->category->name ?? '-' }}
        </p>

        <p>
            <strong>Status:</strong>

            <span class="badge
                {{ $task->status == 'pending' ? 'bg-warning' : '' }}
                {{ $task->status == 'in_progress' ? 'bg-info' : '' }}
                {{ $task->status == 'completed' ? 'bg-success' : '' }}
            ">
                {{ ucfirst($task->status) }}
            </span>
        </p>

        <p>
            <strong>Due Date:</strong>

            {{ $task->due_date
                ? $task->due_date->format('d M Y')
                : '-' }}
        </p>

        <a href="{{ route('admin.tasks.index') }}"
           class="btn btn-secondary">

            Back

        </a>

    </div>

</div>

@endsection