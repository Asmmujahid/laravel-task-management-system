<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>@yield('title', 'Task Management System')</title>

    {{-- Google Font --}}
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap"
        rel="stylesheet">

    {{-- Font Awesome --}}
    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

    {{-- Bootstrap --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
        rel="stylesheet">

    {{-- Custom CSS --}}
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <link rel="stylesheet" href="{{ asset('css/dashboard.css') }}">
    <link rel="stylesheet" href="{{ asset('css/responsive.css') }}">
      <link rel="stylesheet"  href="{{ asset('css/auth.css') }}">

</head>

<body class="{{ auth()->check() ? 'has-sidebar' : 'guest-page' }}">

    @include('layout.navbar')

    <div class="main-wrapper">

        @auth
            @include('layout.sidebar')
        @endauth

        <div class="content-wrapper">

            @auth
                <main class="main-content">
                    @yield('content')
                </main>
            @else
                <div class="public-content">
                    @yield('content')
                </div>
            @endauth

            @include('layout.footer')

        </div>

    </div>


    {{-- Bootstrap JS --}}
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    

    {{-- Custom JS --}}
    <script src="{{ asset('js/main.js') }}"></script>
    <script src="{{ asset('js/dashboard.js') }}"></script>
    <script src="{{ asset('js/chart.js') }}"></script>

    @stack('scripts')

</body>

</html>