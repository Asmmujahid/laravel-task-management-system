<nav class="top-navbar">

    <div class="navbar-left">

        @auth

            <button class="mobile-toggle" id="mobileToggle">
                <i class="fas fa-bars"></i>
            </button>

            @if(auth()->user()->role == 'admin')

                <a href="{{ route('admin.dashboard') }}"
                   class="logo">
                    TMS
                </a>

            @elseif(auth()->user()->role == 'team_lead')

                <a href="{{ route('team_lead.dashboard') }}"
                   class="logo">
                    TMS
                </a>

            @elseif(auth()->user()->role == 'team_member')

                <a href="{{ route('team_member.dashboard') }}"
                   class="logo">
                    TMS
                </a>

            @endif

        @else

        <div class="navbar-left">
            <a href="{{ route('home') }}"
               class="logo">
                TMS
            </a>

            <div class="nav-links">

                <a href="{{ route('home') }}"
                   class="{{ request()->routeIs('home') ? 'active' : '' }}">
                    Home
                </a>

                <a href="{{ route('about') }}"
                   class="{{ request()->routeIs('about') ? 'active' : '' }}">
                    About
                </a>

                <a href="{{ route('contact') }}"
                   class="{{ request()->routeIs('contact') ? 'active' : '' }}">
                    Contact
                </a>

            </div>
            </div>

        @endauth

    </div>

    <div class="navbar-right">

        @auth

            <a href="{{ route('notifications.index') }}"
               class="notification-btn">

                <i class="fas fa-bell"></i>

                @if(auth()->user()->unreadNotifications->count() > 0)

                    <span class="notification-badge">
                        {{ auth()->user()->unreadNotifications->count() }}
                    </span>

                @endif

            </a>

            <div class="dropdown">

                <button class="profile-btn"
                        type="button"
                        data-bs-toggle="dropdown">

                    <img src="{{ asset('uploads/images/avatars/default.png') }}"
                         alt="Avatar"
                         class="avatar">

                    <span>
                        {{ auth()->user()->name }}
                    </span>

                    <i class="fas fa-chevron-down"></i>

                </button>

                <ul class="dropdown-menu dropdown-menu-end">

                    @if(auth()->user()->role == 'admin')

                        <li>

                            <a class="dropdown-item"
                               href="{{ route('admin.dashboard') }}">

                                <i class="fas fa-user-shield me-2"></i>

                                Dashboard

                            </a>

                        </li>

                    @elseif(auth()->user()->role == 'team_lead')

                        <li>

                            <a class="dropdown-item"
                               href="{{ route('team_lead.dashboard') }}">

                                <i class="fas fa-user-tie me-2"></i>

                                Dashboard

                            </a>

                        </li>

                    @elseif(auth()->user()->role == 'team_member')

                        <li>

                            <a class="dropdown-item"
                               href="{{ route('team_member.profile.edit') }}">

                                <i class="fas fa-user me-2"></i>

                                Profile

                            </a>

                        </li>

                    @endif

                    <li>
                        <hr class="dropdown-divider">
                    </li>

                    <li>

                        <form action="{{ route('logout') }}"
                              method="POST">

                            @csrf

                            <button type="submit"
                                    class="dropdown-item text-danger">

                                <i class="fas fa-sign-out-alt me-2"></i>

                                Logout

                            </button>

                        </form>

                    </li>

                </ul>

            </div>

        @else

 @guest

    <button
        class="nav-btn-outline"
        onclick="window.location='{{ route('home') }}?form=login'">

        Login

    </button>

    <button
        class="nav-btn"
        onclick="window.location='{{ route('home') }}?form=register'">

        Register

    </button>

@endguest

        @endauth

    </div>

</nav>