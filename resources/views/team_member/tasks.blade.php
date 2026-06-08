@extends('layout.app')

@section('content')

<div class="content-container">

    <h2>Assigned Tasks</h2>

    {{-- SUCCESS MESSAGE --}}
    @if(session('success'))

        <div class="alert alert-success">
            {{ session('success') }}
        </div>

    @endif

     <table class="table table-bordered table-striped align-middle">

            <thead class="table-dark">
            <tr>
                <th>#</th>
                <th>Title</th>
                <th>Description</th>
                <th>Category</th>
                <th>Team Lead</th>
                <th>Team</th>
                <th>Status</th>
                <th>Due Date</th>
                <th>Update Status</th>
            </tr>
        </thead>

        <tbody>

        @forelse($tasks as $task)

            <tr>

                <td>{{ $loop->iteration }}</td>

                <td>{{ $task->title }}</td>

                <td>{{ $task->description }}</td>

                <td>
                    {{ $task->category->name ?? '-' }}
                </td>

                {{-- TEAM LEAD --}}
                <td>
                    {{ $task->team->lead->name ?? '-' }}
                </td>

                {{-- TEAM --}}
                <td>
                    {{ $task->team->name ?? '-' }}
                </td>

                {{-- CURRENT STATUS --}}
                <td>

                    <span class="badge
                        {{ $task->status == 'pending' ? 'bg-warning text-dark' : '' }}
                        {{ $task->status == 'in_progress' ? 'bg-info text-dark' : '' }}
                        {{ $task->status == 'completed' ? 'bg-success' : '' }}
                    ">

                        {{ ucfirst(str_replace('_', ' ', $task->status)) }}

                    </span>

                </td>

                {{-- DUE DATE --}}
                <td>

                    {{ $task->due_date
                        ? \Carbon\Carbon::parse($task->due_date)->format('d M Y')
                        : '-' }}

                </td>

                {{-- UPDATE STATUS --}}
                <td>

                    <form method="POST"
      action="{{ route('team_member.tasks.status', $task->id) }}">

    @csrf

    <select name="status"
            class="form-control"
            onchange="this.form.submit()">

        <option value="pending" {{ $task->status == 'pending' ? 'selected' : '' }}>
            Pending
        </option>

        <option value="in_progress" {{ $task->status == 'in_progress' ? 'selected' : '' }}>
            In Progress
        </option>

        <option value="completed" {{ $task->status == 'completed' ? 'selected' : '' }}>
            Completed
        </option>

    </select>

</form>

                </td>

            </tr>

        @empty

            <tr>

                <td colspan="9" class="text-center">
                    No Task Assigned
                </td>

            </tr>

        @endforelse

        </tbody>

    </table>

</div>

@endsection