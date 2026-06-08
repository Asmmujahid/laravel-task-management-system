@extends('layout.app')

@section('content')

<div class="dashboard-wrapper">

    <div class="dashboard-header">

        <div>
            <h1 class="page-title">
                Admin Dashboard
            </h1>

            <p class="page-subtitle">
                Welcome back, {{ auth()->user()->name }}
            </p>
        </div>

    </div>

    {{-- STATS --}}
    <div class="dashboard-grid">

        <div class="dashboard-card">

            <div class="card-icon blue">
                <i class="fas fa-users"></i>
            </div>

            <div class="card-info">
                <h3>Total Users</h3>
                <h2>{{ $totalUsers }}</h2>
            </div>

        </div>

        <div class="dashboard-card">

            <div class="card-icon purple">
                <i class="fas fa-layer-group"></i>
            </div>

            <div class="card-info">
                <h3>Total Teams</h3>
                <h2>{{ $totalTeams }}</h2>
            </div>

        </div>

        <div class="dashboard-card">

            <div class="card-icon orange">
                <i class="fas fa-tasks"></i>
            </div>

            <div class="card-info">
                <h3>Total Tasks</h3>
                <h2>{{ $totalTasks }}</h2>
            </div>

        </div>

        <div class="dashboard-card">

            <div class="card-icon green">
                <i class="fas fa-check-circle"></i>
            </div>

            <div class="card-info">
                <h3>Completed</h3>
                <h2>{{ $completedTasks }}</h2>
            </div>

        </div>
        <div class="dashboard-card">

    <div class="card-icon red">
    
         <i class="fas fa-file-circle-check"></i>
    </div>

    <div class="card-info">
        <h3>Submissions</h3>
        <h2>{{ $submissionsCount }}</h2>
    </div>

</div>

<div class="dashboard-card">

    <div class="card-icon blue">
        <i class="fas fa-gear"></i>
    </div>

    <div class="card-info">
        <h3>Settings</h3>
        <h2>{{ $settingsCount }}</h2>
    </div>

</div>

    </div>

    {{-- TASK STATUS --}}
    <div class="status-grid">

        <div class="status-card pending">
            <h3>Pending Tasks</h3>
            <h1>{{ $pendingTasks }}</h1>
        </div>

        <div class="status-card progress">
            <h3>In Progress</h3>
            <h1>{{ $progressTasks }}</h1>
        </div>

        <div class="status-card complete">
            <h3>Completed Tasks</h3>
            <h1>{{ $completedTasks }}</h1>
        </div>

    </div>

   
</div>

@endsection