@extends('layout.app')
@section('title', 'Add User')

@section('content')
<div class="page-header">
    <h2>Add New User</h2>
    <p class="subtitle">Create a user and assign a role & team.</p>
</div>

<div class="card">
    <form action="{{ route('admin.users.store') }}" method="POST" class="form">
        @csrf

        <div class="form-group">
            <label>Full Name</label>
            <input type="text" name="name" class="input" placeholder="Enter full name" value="{{ old('name') }}">
            @error('name') <small class="error">{{ $message }}</small> @enderror
        </div>

        <div class="form-group">
            <label>Email Address</label>
            <input type="email" name="email" class="input" placeholder="Enter email" value="{{ old('email') }}">
            @error('email') <small class="error">{{ $message }}</small> @enderror
        </div>

        <div class="form-group">
            <label>Password</label>
            <input type="password" name="password" class="input" placeholder="Enter password">
            @error('password') <small class="error">{{ $message }}</small> @enderror
        </div>

        <div class="form-group">
            <label>User Role</label>
            <select name="role" class="input">
                <option value="admin">Admin</option>
                <option value="team_lead">Team Lead</option>
                <option value="team_member" selected>Team Member</option>
            </select>
        </div>

        <div class="form-group">
            <label>Select Team</label>
            <select name="team_id" class="input">
                <option value="">Choose team</option>
                @foreach($teams as $team)
                    <option value="{{ $team->id }}">{{ $team->name }}</option>
                @endforeach
            </select>
        </div>

        <div class="form-actions">
            <button type="submit" class="btn btn-primary">Save User</button>
            <a href="{{ route('admin.users.index') }}" class="btn btn-secondary">Back</a>
        </div>
    </form>
</div>
@endsection
