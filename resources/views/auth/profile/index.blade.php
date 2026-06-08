@extends('layout.app')

@section('title', 'My Profile')

@section('content')

<div class="page-header">

    <div>

        <h2>

            My Profile

        </h2>

        <p class="subtitle">

            Manage your account information and personal details.

        </p>

    </div>

</div>

{{-- SUCCESS MESSAGE --}}
@if(session('success'))

    <x-alert
        type="success"
        :message="session('success')"
    />

@endif

<div class="profile-wrapper">

    {{-- PROFILE SIDEBAR --}}
    <div class="profile-sidebar">

        <div class="profile-card">

            <div class="profile-avatar-wrapper">

                @if(auth()->user()->image)

                    <img src="{{ asset('uploads/profile/' . auth()->user()->image) }}"
                         alt="Profile"
                         class="profile-avatar">

                @else

                    <div class="default-avatar">

                        {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}

                    </div>

                @endif

            </div>

            <h3>

                {{ auth()->user()->name }}

            </h3>

            <p class="profile-email">

                {{ auth()->user()->email }}

            </p>

            <span class="custom-badge badge-primary">

                {{ ucfirst(str_replace('_', ' ', auth()->user()->role)) }}

            </span>

        </div>

    </div>

    {{-- PROFILE CONTENT --}}
    <div class="profile-content">

        <div class="content-card">

            <div class="card-header-custom">

                <h3>

                    Update Profile Information

                </h3>

            </div>

            <form action="{{ route('profile.update') }}"
                  method="POST"
                  enctype="multipart/form-data">

                @csrf
                @method('PUT')

                <div class="row">

                    {{-- NAME --}}
                    <div class="col-md-6">

                        <div class="form-group">

                            <label>

                                Full Name

                            </label>

                            <div class="input-group-custom">

                                <i class="fa-solid fa-user"></i>

                                <input type="text"
                                       name="name"
                                       value="{{ old('name', auth()->user()->name) }}"
                                       class="form-control">

                            </div>

                            @error('name')

                                <small class="text-danger">

                                    {{ $message }}

                                </small>

                            @enderror

                        </div>

                    </div>

                    {{-- EMAIL --}}
                    <div class="col-md-6">

                        <div class="form-group">

                            <label>

                                Email Address

                            </label>

                            <div class="input-group-custom">

                                <i class="fa-solid fa-envelope"></i>

                                <input type="email"
                                       name="email"
                                       value="{{ old('email', auth()->user()->email) }}"
                                       class="form-control">

                            </div>

                            @error('email')

                                <small class="text-danger">

                                    {{ $message }}

                                </small>

                            @enderror

                        </div>

                    </div>

                </div>

                {{-- PROFILE IMAGE --}}
                <div class="form-group mt-3">

                    <label>

                        Profile Image

                    </label>

                    <input type="file"
                           name="image"
                           class="form-control">

                    @error('image')

                        <small class="text-danger">

                            {{ $message }}

                        </small>

                    @enderror

                </div>

                <hr class="profile-divider">

                <div class="card-header-custom mt-4">

                    <h3>

                        Change Password

                    </h3>

                </div>

                <div class="row">

                    {{-- NEW PASSWORD --}}
                    <div class="col-md-6">

                        <div class="form-group">

                            <label>

                                New Password

                            </label>

                            <div class="input-group-custom">

                                <i class="fa-solid fa-lock"></i>

                                <input type="password"
                                       name="password"
                                       class="form-control"
                                       placeholder="Enter new password">

                            </div>

                            @error('password')

                                <small class="text-danger">

                                    {{ $message }}

                                </small>

                            @enderror

                        </div>

                    </div>

                    {{-- CONFIRM PASSWORD --}}
                    <div class="col-md-6">

                        <div class="form-group">

                            <label>

                                Confirm Password

                            </label>

                            <div class="input-group-custom">

                                <i class="fa-solid fa-lock"></i>

                                <input type="password"
                                       name="password_confirmation"
                                       class="form-control"
                                       placeholder="Confirm password">

                            </div>

                        </div>

                    </div>

                </div>

                {{-- SUBMIT --}}
                <div class="profile-actions">

                    <button type="submit"
                            class="btn btn-primary">

                        <i class="fa-solid fa-floppy-disk"></i>

                        Update Profile

                    </button>

                </div>

            </form>

        </div>

    </div>

</div>

@endsection