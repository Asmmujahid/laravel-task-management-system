@extends('layout.app')

@section('content')

<div class="content-container">

    <h2>Assigned Tasks (From Admin)</h2>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif
<div class="table-responsive">
  <table class="table table-bordered table-striped align-middle">

            <thead class="table-dark">
            <tr>
                <th>#</th>
                <th>Title</th>
                <th>Description</th>
                <th>Created By</th>
                <th>Assigned To</th>
                <th>Category</th>
                <th>Status</th>
                <th>Due Date</th>
                <th>Team</th>
                <th>Assign</th>
                <th>Action</th>
            </tr>
        </thead>

        <tbody>

        @forelse($tasks as $task)

            <tr>

                <td>{{ $loop->iteration }}</td>

                <td>{{ $task->title }}</td>

                <td>{{ $task->description }}</td>

                {{-- ADMIN NAME --}}
                <td>{{ $task->creator->name ?? '-' }}</td>

                {{-- TEAM LEAD / TEAM MEMBER --}}
                <td>{{ $task->assignedUser->name ?? '-' }}</td>

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
                    {{ $task->due_date
                        ? $task->due_date->format('d M Y')
                        : '-' }}
                </td>

                <td>
                    {{ $task->team->name ?? '-' }}
                </td>

                {{-- ASSIGN BUTTON --}}
                <td>

                    @if(!$task->team_id)

                        <a href="{{ route('team_lead.tasks.assign.form', $task->id) }}"
                           class="btn btn-primary btn-sm">

                            Assign

                        </a>

                    @else

                        <span class="badge bg-success">
                            Assigned
                        </span>

                    @endif

                </td>

                {{-- ACTION BUTTONS --}}
               <td>

    <div class="action-buttons">

        <a href="{{ route('team_lead.tasks.edit', $task->id) }}"
           class="btn btn-warning btn-sm action-btn">
            ✏️
        </a>

        <form action="{{ route('team_lead.tasks.destroy', $task->id) }}"
              method="POST"
              class="delete-form">

            @csrf
            @method('DELETE')

            <button type="submit"
                    class="btn btn-danger btn-sm action-btn"
                    onclick="return confirm('Are you sure you want to delete this task?')">

                🗑️

            </button>

        </form>

    </div>

</td>

            </tr>

        @empty

            <tr>
                <td colspan="11" class="text-center">
                    No tasks found
                </td>
            </tr>

        @endforelse

        </tbody>

    </table>
</div>
</div>

@endsection