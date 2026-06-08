@extends('layout.app')

@section('title', 'Task Management System')

@section('content')

{{-- HERO SECTION --}}

<section class="hero-section">

    <div class="hero-content">

        <div class="hero-text">

            <span class="hero-badge">
                Smart Team Collaboration
            </span>

            <h1>
                Manage Teams, Tasks & Productivity
                In One Powerful System
            </h1>

            <p>
                Organize projects, assign tasks, monitor progress,
                collaborate with your team, and boost productivity
                using a modern task management platform.
            </p>

            <div class="hero-buttons">

                @guest

                    <a href="{{ route('home') }}?form=register"
                       class="btn btn-primary">

                        <i class="fa-solid fa-user-plus"></i>
                        Get Started

                    </a>

                    <a href="{{ route('home') }}?form=login"
                       class="btn btn-secondary">

                        <i class="fa-solid fa-right-to-bracket"></i>
                        Login

                    </a>

                @else

                    <a href="{{ route(auth()->user()->role.'.dashboard') }}"
                       class="btn btn-primary">

                        <i class="fa-solid fa-chart-line"></i>
                        Go To Dashboard

                    </a>

                @endguest

            </div>

        </div>

        <div class="hero-image">

            <div class="dashboard-preview">

                <div class="preview-card">

                    <i class="fa-solid fa-list-check"></i>

                    <h3>Task Tracking</h3>

                    <p>Track all assigned tasks easily.</p>

                </div>

                <div class="preview-card">

                    <i class="fa-solid fa-users"></i>

                    <h3>Team Collaboration</h3>

                    <p>Work efficiently with your teams.</p>

                </div>

                <div class="preview-card">

                    <i class="fa-solid fa-chart-pie"></i>

                    <h3>Analytics</h3>

                    <p>Monitor productivity and reports.</p>

                </div>

            </div>

        </div>

    </div>

</section>

{{-- LOGIN MODAL --}}

@if(request('form') == 'login')

<div class="custom-auth-overlay">

    <div class="custom-auth-modal">

        <a href="{{ route('home') }}"
           class="modal-close">

            <i class="fas fa-times"></i>

        </a>

        <div class="auth-card">

            <div class="auth-logo">

                <h1>TMS</h1>

                <p>Task Management System</p>

            </div>

            <div class="auth-header">

                <h2>Welcome Back</h2>

                <p>Login to continue</p>

            </div>

            <form action="{{ route('login') }}"
                  method="POST"
                  class="auth-form">

                @csrf

                @if(session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                @endif

                @if(session('error'))
                    <div class="alert alert-danger">
                        {{ session('error') }}
                    </div>
                @endif

                <div class="form-group">

                    <label>Email Address</label>

                    <div class="input-group-custom">

                        <i class="fa-solid fa-envelope"></i>

                        <input type="email"
                               name="email"
                               value="{{ old('email') }}"
                               placeholder="Enter Email"
                               required>

                    </div>

                    @error('email')
                        <small class="text-danger">
                            {{ $message }}
                        </small>
                    @enderror

                </div>

                <div class="form-group">

                    <label>Password</label>

                    <div class="input-group-custom">

                        <i class="fa-solid fa-lock"></i>

                        <input type="password"
                               name="password"
                               placeholder="Enter Password"
                               required>

                    </div>

                    @error('password')
                        <small class="text-danger">
                            {{ $message }}
                        </small>
                    @enderror

                </div>

                <div class="d-flex justify-content-between align-items-center mb-3">

                    <label class="remember-label">

                        <input type="checkbox"
                               name="remember">

                        Remember Me

                    </label>

                    <a href="{{ route('password.request') }}">

                        Forgot Password?

                    </a>

                </div>

                <button type="submit"
                        class="auth-btn">

                    <i class="fa-solid fa-right-to-bracket"></i>

                    Login

                </button>

            </form>

            <div class="auth-footer">

                Don't have an account?

                <a href="{{ route('home') }}?form=register">

                    Register

                </a>

            </div>

        </div>

    </div>

</div>

@endif

{{-- REGISTER MODAL --}}

@if(request('form') == 'register')

<div class="custom-auth-overlay">

    <div class="custom-auth-modal register-modal">

        <a href="{{ route('home') }}"
           class="modal-close">

            <i class="fas fa-times"></i>

        </a>

        <div class="auth-card register-card">

            <div class="auth-logo">

                <h1>TMS</h1>

                <p>Task Management System</p>

            </div>

            <div class="auth-header">

                <h2>Create Account</h2>

            </div>

            <form action="{{ route('register') }}"
                  method="POST"
                  class="auth-form">

                @csrf

                <div class="form-group">

                    <label>Full Name</label>

                    <div class="input-group-custom">

                        <i class="fa-solid fa-user"></i>

                        <input type="text"
                               name="name"
                               value="{{ old('name') }}"
                               required>

                    </div>

                    @error('name')
                        <small class="text-danger">
                            {{ $message }}
                        </small>
                    @enderror

                </div>

                <div class="form-group">

                    <label>Email Address</label>

                    <div class="input-group-custom">

                        <i class="fa-solid fa-envelope"></i>

                        <input type="email"
                               name="email"
                               value="{{ old('email') }}"
                               required>

                    </div>

                    @error('email')
                        <small class="text-danger">
                            {{ $message }}
                        </small>
                    @enderror

                </div>

                <div class="form-group">

                    <label>Password</label>

                    <div class="input-group-custom">

                        <i class="fa-solid fa-lock"></i>

                        <input type="password"
                               name="password"
                               required>

                    </div>

                    @error('password')
                        <small class="text-danger">
                            {{ $message }}
                        </small>
                    @enderror

                </div>

                <div class="form-group">

                    <label>Confirm Password</label>

                    <div class="input-group-custom">

                        <i class="fa-solid fa-lock"></i>

                        <input type="password"
                               name="password_confirmation"
                               required>

                    </div>

                </div>

                <div class="form-group">

                    <label>Select Role</label>

                    <div class="input-group-custom">

                        <i class="fa-solid fa-users"></i>

                        <select name="role" required>

                            <option value="">Choose Role</option>

                            <option value="admin">Admin</option>
                            <option value="team_lead">Team Lead</option>
                            <option value="team_member">Team Member</option>

                        </select>

                    </div>

                    @error('role')
                        <small class="text-danger">
                            {{ $message }}
                        </small>
                    @enderror

                </div>

                <button type="submit"
                        class="auth-btn">

                    <i class="fa-solid fa-user-plus"></i>

                    Create Account

                </button>

            </form>

            <div class="auth-footer">

                Already have an account?

                <a href="{{ route('home') }}?form=login">

                    Login

                </a>

            </div>

        </div>

    </div>

</div>

@endif

{{-- FEATURES SECTION --}}

<section class="features-section">

    <div class="section-header">

        <h2>Powerful Features</h2>

        <p>
            Everything you need to manage projects professionally.
        </p>

    </div>

    <div class="features-grid">

        <div class="feature-card">

            <i class="fa-solid fa-list-check"></i>

            <h3>Task Management</h3>

            <p>Create, assign, and monitor tasks.</p>

        </div>

        <div class="feature-card">

            <i class="fa-solid fa-users"></i>

            <h3>Team Collaboration</h3>

            <p>Manage teams and improve communication.</p>

        </div>

        <div class="feature-card">

            <i class="fa-solid fa-bell"></i>

            <h3>Notifications</h3>

            <p>Get real-time updates and reminders.</p>

        </div>

        <div class="feature-card">

            <i class="fa-solid fa-chart-column"></i>

            <h3>Reports & Analytics</h3>

            <p>Analyze progress and improve productivity.</p>

        </div>

    </div>

</section>

@endsection