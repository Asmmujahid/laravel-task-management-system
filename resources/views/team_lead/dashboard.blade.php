@extends('layout.app')

@section('content')

<div class="dashboard-wrapper">

    <div class="dashboard-header">
        <h1 class="page-title">
            Team Lead Dashboard
        </h1>

        <p class="page-subtitle">
            Welcome back, {{ auth()->user()->name }}
        </p>
    </div>

    <div class="dashboard-grid">

        <div class="dashboard-card">
            <div class="card-icon blue">
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
                <h3>Completed Tasks</h3>
                <h2>{{ $completedTasks }}</h2>
            </div>
        </div>

        <div class="dashboard-card">
            <div class="card-icon orange">
                <i class="fas fa-clock"></i>
            </div>

            <div class="card-info">
                <h3>Pending Tasks</h3>
                <h2>{{ $pendingTasks }}</h2>
            </div>
        </div>

        <div class="dashboard-card">
            <div class="card-icon purple">
                <i class="fas fa-spinner"></i>
            </div>

            <div class="card-info">
                <h3>In Progress</h3>
                <h2>{{ $inProgressTasks }}</h2>
            </div>
        </div>

        <div class="dashboard-card">
            <div class="card-icon red">
                <i class="fas fa-users"></i>
            </div>

            <div class="card-info">
                <h3>Team Members</h3>
                <h2>{{ $teamMembers }}</h2>
            </div>
        </div>

        <div class="dashboard-card">
            <div class="card-icon blue">
                <i class="fas fa-layer-group"></i>
            </div>

            <div class="card-info">
                <h3>Teams</h3>
                <h2>{{ $totalTeams }}</h2>
            </div>
        </div>

        <div class="dashboard-card">
            <div class="card-icon purple">
                <i class="fas fa-folder"></i>
            </div>

            <div class="card-info">
                <h3>Categories</h3>
                <h2>{{ $totalCategories }}</h2>
            </div>
        </div>

        <div class="dashboard-card">
            <div class="card-icon green">
                <i class="fas fa-file-circle-check"></i>
            </div>

            <div class="card-info">
                <h3>Submissions</h3>
                <h2>{{ $totalSubmissions }}</h2>
            </div>
        </div>

    </div>

</div>

@endsection