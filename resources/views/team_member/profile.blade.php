@extends('layout.app')

@section('content')
<div class="content-container">
    <h2>My Profile</h2>

    <form action="{{ route('team_member.profile.update') }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="form-group">
            <label>Name</label>
            <input type="text" name="name" class="form-control" value="{{ old('name', $user->name) }}">
            @error('name') <span class="text-danger">{{ $message }}</span> @enderror
        </div>

        <div class="form-group">
            <label>Email</label>
            <input type="email" name="email" class="form-control" value="{{ old('email', $user->email) }}">
            @error('email') <span class="text-danger">{{ $message }}</span> @enderror
        </div>

        <div class="form-group">
            <label>Password <small>(Leave blank to keep current)</small></label>
            <input type="password" name="password" class="form-control">
            @error('password') <span class="text-danger">{{ $message }}</span> @enderror
        </div>

        <div class="form-group">
            <label>Profile Picture</label>
            <input type="file" name="avatar" class="form-control">
            @if($user->avatar)
                <img src="{{ asset('uploads/avatars/' . $user->avatar) }}" alt="Avatar" width="80" class="mt-2">
            @endif
        </div>

        <button class="btn btn-success">Update Profile</button>
    </form>
</div>
@endsection
