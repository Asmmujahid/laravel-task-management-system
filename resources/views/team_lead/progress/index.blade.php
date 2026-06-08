@extends('layout.app')

@section('content')

<div class="content-container">

    <h2 class="mb-4">Team Members Progress</h2>

    {{-- Success Message --}}
    @if(session('success'))
        <div class="alert alert-success mb-3">
            {{ session('success') }}
        </div>
    @endif

    <div class="table-responsive">

        <table class="table table-bordered table-striped align-middle">

            <thead class="table-dark">
                <tr>
                    <th>#</th>
                    <th>Task Title</th>
                    <th>Member</th>
                    <th>Team</th>
                    <th>Category</th>
                    <th>Status</th>
                    <th>Progress</th>
                    <th>Due Date</th>
                    
                </tr>
            </thead>

            <tbody>

            @forelse($tasks as $task)

                <tr>

                    {{-- Row Number --}}
                    <td>{{ $loop->iteration }}</td>

                    {{-- Task Title --}}
                    <td>{{ $task->title }}</td>

                    {{-- Member --}}
                    <td>{{ $task->assignedUser->name ?? '-' }}</td>

                    {{-- Team --}}
                    <td>{{ $task->team->name ?? '-' }}</td>

                    {{-- Category --}}
                    <td>{{ $task->category->name ?? '-' }}</td>

                    {{-- Status --}}
                    <td>
                        @if($task->status == 'pending')

                            <span class="badge bg-danger">
                                Pending
                            </span>

                        @elseif($task->status == 'in_progress')

                            <span class="badge bg-warning text-dark">
                                In Progress
                            </span>

                        @else

                            <span class="badge bg-success">
                                Completed
                            </span>

                        @endif
                    </td>

                    {{-- Progress --}}
                    <td>

                        @php
                            $percent = 25;
                            $color   = 'bg-danger';

                            if($task->status == 'in_progress'){
                                $percent = 60;
                                $color   = 'bg-warning';
                            }

                            if($task->status == 'completed'){
                                $percent = 100;
                                $color   = 'bg-success';
                            }
                        @endphp

                        <div class="progress" style="height:22px;">

                            <div class="progress-bar {{ $color }}"
                                 style="width: {{ $percent }}%;">

                                {{ $percent }}%

                            </div>

                        </div>

                    </td>

                    {{-- Due Date --}}
                    <td>
                        {{ $task->due_date ? $task->due_date->format('d M Y') : '-' }}
                    </td>


                </tr>

            @empty

                <tr>
                    <td colspan="10" class="text-center text-danger">
                        No Progress Found
                    </td>
                </tr>

            @endforelse

            </tbody>

        </table>

    </div>

</div>

@endsection