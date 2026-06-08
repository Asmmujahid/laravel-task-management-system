@extends('layout.app')

@section('content')
<div class="content-container profile-page">

    <h2>👤 My Profile</h2>

    @if(session('success'))
        <div class="alert-success">{{ session('success') }}</div>
    @endif

    <form action="{{ route('team_member.profile.update') }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="profile-card">

            <div class="avatar-section">
                <img src="{{ $user->avatar ? asset('uploads/avatars/'.$user->avatar) : asset('uploads/images/avatars/default.png') }}" class="profile-avatar">

                <input type="file" name="avatar">
            </div>

            <div class="form-section">

                <div class="form-group">
                    <label>Name</label>
                    <input type="text" name="name" value="{{ old('name',$user->name) }}">
                    @error('name') <small>{{ $message }}</small> @enderror
                </div>

                <div class="form-group">
                    <label>Email</label>
                    <input type="email" name="email" value="{{ old('email',$user->email) }}">
                    @error('email') <small>{{ $message }}</small> @enderror
                </div>

                <div class="form-group">
                    <label>Password</label>
                    <input type="password" name="password">
                </div>

                <div class="form-group">
                    <label>Confirm Password</label>
                    <input type="password" name="password_confirmation">
                </div>

                <button class="btn-update">Update Profile</button>

            </div>
        </div>
    </form>
</div>
@endsection