@extends('layout.auth')

@section('title', 'Forgot Password')

@section('content')

<div class="custom-auth-overlay">

    <div class="custom-auth-modal">

        <a href="{{ route('home') }}"
           class="modal-close">

            <i class="fas fa-times"></i>

        </a>

        <div class="auth-card">

            <div class="auth-logo">

                <h1>TMS</h1>

                <p>Password Recovery</p>

            </div>

            <div class="auth-header">

                <h2>Forgot Password?</h2>

                <p>
                    Enter your email address and we will send you a password reset link.
                </p>

            </div>

            @if(session('status'))

                <div class="alert alert-success">

                    {{ session('status') }}

                </div>

            @endif

            <form method="POST"
                  action="{{ route('password.email') }}"
                  class="auth-form">

                @csrf

                <div class="form-group">

                    <label>Email Address</label>

                    <div class="input-group-custom">

                        <i class="fa-solid fa-envelope"></i>

                        <input type="email"
                               name="email"
                               value="{{ old('email') }}"
                               placeholder="Enter your email"
                               required>

                    </div>

                    @error('email')

                        <small class="text-danger">

                            {{ $message }}

                        </small>

                    @enderror

                </div>

                <button type="submit"
                        class="auth-btn">

                    <i class="fa-solid fa-paper-plane"></i>

                    Send Reset Link

                </button>

            </form>

            <div class="auth-footer">

                Remember your password?

                <a href="{{ route('home') }}?form=login">

                    Login

                </a>

            </div>

        </div>

    </div>

</div>

@endsection