@extends('layout.app')
@section('title', 'Edit User')

@section('content')

<div class="page-header">
    <h2>Edit User</h2>
    <p class="subtitle">Update user details and permissions.</p>
</div>

<div class="card">
    <form action="{{ route('admin.users.update', $user->id) }}" method="POST" class="form">
        @csrf
        @method('PUT')

        <div class="form-group">
            <label>Full Name</label>
            <input type="text" class="input" name="name" value="{{ old('name', $user->name) }}">
        </div>

        <div class="form-group">
            <label>Email Address</label>
            <input type="email" class="input" name="email" value="{{ old('email', $user->email) }}">
        </div>

        <div class="form-group">
            <label>User Role</label>
            <select name="role" class="input">
                <option value="admin" {{ $user->role=='admin'?'selected':'' }}>Admin</option>
                <option value="team_lead" {{ $user->role=='team_lead'?'selected':'' }}>Team Lead</option>
                <option value="team_member" {{ $user->role=='team_member'?'selected':'' }}>Team Member</option>
            </select>
        </div>

        <div class="form-group">
            <label>Select Team</label>
            <select name="team_id" class="input">
                <option value="">Choose team</option>
                @foreach($teams as $team)
                    <option value="{{ $team->id }}" {{ $user->team_id==$team->id?'selected':'' }}>
                        {{ $team->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="form-actions">
            <button class="btn btn-primary">Update User</button>
            <a href="{{ route('admin.users.index') }}" class="btn btn-secondary">Back</a>
        </div>

    </form>
</div>

@endsection
