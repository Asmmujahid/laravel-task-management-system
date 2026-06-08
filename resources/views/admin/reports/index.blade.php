{{-- resources/views/admin/reports/index.blade.php --}}

@extends('layout.app')

@section('content')

<div class="content-container">



<h2 class="report-title">Admin Reports Dashboard</h2>

{{-- Top Cards --}}
<div class="row">

    {{-- Row 1 --}}
    <div class="col-lg-4 col-md-4 col-sm-12 mb-4">
        <div class="stat-card">
            <div class="stat-label">Total Users</div>
            <h3 class="stat-value">{{ $totalUsers }}</h3>
        </div>
    </div>

    <div class="col-lg-4 col-md-4 col-sm-12 mb-4">
        <div class="stat-card">
            <div class="stat-label">Total Teams</div>
            <h3 class="stat-value">{{ $totalTeams }}</h3>
        </div>
    </div>

    <div class="col-lg-4 col-md-4 col-sm-12 mb-4">
        <div class="stat-card">
            <div class="stat-label">Total Tasks</div>
            <h3 class="stat-value">{{ $totalTasks }}</h3>
        </div>
    </div>

    {{-- Row 2 --}}
    <div class="col-lg-4 col-md-4 col-sm-12 mb-4">
        <div class="stat-card">
            <div class="stat-label">Completed</div>
            <h3 class="stat-value text-success">{{ $completedTasks }}</h3>
        </div>
    </div>

    <div class="col-lg-4 col-md-4 col-sm-12 mb-4">
        <div class="stat-card">
            <div class="stat-label">Pending</div>
            <h3 class="stat-value text-danger">{{ $pendingTasks }}</h3>
        </div>
    </div>

    <div class="col-lg-4 col-md-4 col-sm-12 mb-4">
        <div class="stat-card">
            <div class="stat-label">In Progress</div>
            <h3 class="stat-value text-warning">{{ $progressTasks }}</h3>
        </div>
    </div>

</div>
{{-- Task Status Summary --}}
<div class="card-section">

    <h4 class="section-title">Tasks By Status</h4>

    <div class="table-responsive">

       <table class="table table-bordered table-striped align-middle">

            <thead class="table-dark">
                <tr>
                    <th>Status</th>
                    <th>Total</th>
                    <th width="40%">Progress</th>
                </tr>
            </thead>

            <tbody>

                @foreach($tasksByStatus as $item)

                    @php
                        $percent = $totalTasks > 0 ? ($item->total / $totalTasks) * 100 : 0;

                        $class = 'completed';
                        $bar = '#22c55e';

                        if($item->status == 'pending'){
                            $class = 'pending';
                            $bar = '#ef4444';
                        }

                        if($item->status == 'in_progress'){
                            $class = 'progress';
                            $bar = '#f59e0b';
                        }
                    @endphp

                    <tr>

                        <td>
                            <span class="status-pill {{ $class }}">
                                {{ ucfirst(str_replace('_',' ', $item->status)) }}
                            </span>
                        </td>

                        <td>{{ $item->total }}</td>

                        <td>

                           <div class="mini-bar">
    <div class="mini-fill"
         style="width:{{ $percent }}%; background:{{ $bar }}">
    </div>
</div>

                        </td>

                    </tr>

                @endforeach

            </tbody>

        </table>

    </div>

</div>


{{-- Recent Tasks --}}
<div class="card-section">

    <h4 class="section-title">Recent Tasks</h4>

    <div class="table-responsive">

         <table class="table table-bordered table-striped align-middle">

            <thead class="table-dark">
                <tr>
                    <th>#</th>
                    <th>Task Name</th>
                    <th>Assigned To</th>
                    <th>Created By</th>
                    <th>Status</th>
                </tr>
            </thead>

            <tbody>

            @forelse($recentTasks as $task)

                <tr>
                    <td>{{ $loop->iteration }}</td>

                    <td>
                        <strong>{{ $task->title }}</strong>
                    </td>

                    <td>{{ $task->assignedUser->name ?? '-' }}</td>

                    <td>{{ $task->creator->name ?? '-' }}</td>

                    <td>

                        @if($task->status == 'pending')
                            <span class="status-pill pending">Pending</span>

                        @elseif($task->status == 'in_progress')
                            <span class="status-pill progress">In Progress</span>

                        @else
                            <span class="status-pill completed">Completed</span>
                        @endif

                    </td>
                </tr>

            @empty

                <tr>
                    <td colspan="5" class="text-center text-muted">
                        No Recent Tasks Found
                    </td>
                </tr>

            @endforelse

            </tbody>

        </table>

    </div>

</div>

</div>

@endsection