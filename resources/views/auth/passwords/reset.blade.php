@extends('layout.auth')

@section('title', 'Reset Password')

@section('content')

<div class="auth-page">

    <div class="auth-card">

        <div class="auth-logo">

            <h1>TMS</h1>

            <p>Reset Your Password</p>

        </div>

        <div class="auth-header">

            <h2>Create New Password</h2>

        </div>

        <form method="POST"
              action="{{ route('password.update') }}"
              class="auth-form">

            @csrf

            <input type="hidden"
                   name="token"
                   value="{{ $token }}">

            <div class="form-group">

                <label>Email Address</label>

                <div class="input-group-custom">

                    <i class="fa-solid fa-envelope"></i>

                    <input type="email"
                           name="email"
                           value="{{ $email ?? old('email') }}"
                           required>

                </div>

            </div>

            <div class="form-group">

                <label>New Password</label>

                <div class="input-group-custom">

                    <i class="fa-solid fa-lock"></i>

                    <input type="password"
                           name="password"
                           placeholder="Enter new password"
                           required>

                </div>

            </div>

            <div class="form-group">

                <label>Confirm Password</label>

                <div class="input-group-custom">

                    <i class="fa-solid fa-lock"></i>

                    <input type="password"
                           name="password_confirmation"
                           placeholder="Confirm password"
                           required>

                </div>

            </div>

            <button type="submit"
                    class="btn btn-primary auth-btn">

                <i class="fa-solid fa-rotate"></i>

                Reset Password

            </button>

        </form>

    </div>

</div>

@endsection