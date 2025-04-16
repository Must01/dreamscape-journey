<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Dreamscape Journey') }}</title>

    <!-- Critical CSS -->
    <style>
        body {
            visibility: hidden;
        }

        .main-nav,
        .nav-container,
        .nav-link,
        .main-content {
            visibility: visible;
            opacity: 1 !important;
        }

        .nav-link {
            transition: none !important;
        }

        @media (max-width: 768px) {

            .nav-middle,
            .nav-right {
                display: none !important;
            }
        }
    </style>

    <!-- Preload CSS -->
    <link rel="preload" href="{{ asset('css/app.css') }}" as="style">
    <link rel="preload" href="{{ asset('css/components.css') }}" as="style">

    <!-- Main Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/components.css') }}" rel="stylesheet">
    <link href="{{ asset('css/pages.css') }}" rel="stylesheet">
    <link href="{{ asset('css/shared-components.css') }}" rel="stylesheet">
    <link href="{{ asset('css/home.css') }}" rel="stylesheet">
    <link href="{{ asset('css/destinations-page.css') }}" rel="stylesheet">
    <link href="{{ asset('css/bookings.css') }}" rel="stylesheet">
    <link href="{{ asset('css/profile.css') }}" rel="stylesheet">
    <link href="{{ asset('css/auth.css') }}" rel="stylesheet">

    <script>
        // Remove initial hide once CSS is loaded
        window.onload = function() {
            document.body.style.visibility = 'visible';
        };
    </script>

    @stack('styles')
</head>

<body>
    <nav class="main-nav">
        <div class="container nav-container">
            <div class="nav-left">
                <a href="{{ route('home') }}" class="nav-logo">
                    DreamScape
                </a>
                <button class="mobile-menu-button" onclick="toggleMobileMenu()">
                    <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                    </svg>
                </button>
            </div>

            <div class="nav-middle">
                <a href="{{ route('home') }}" class="nav-link {{ request()->routeIs('home') ? 'active' : '' }}">Home</a>
                <a href="{{ route('destinations.index') }}" class="nav-link {{ request()->routeIs('destinations.*') ? 'active' : '' }}">Destinations</a>
                <a href="{{ route('about') }}" class="nav-link {{ request()->routeIs('about') ? 'active' : '' }}">About</a>
                <a href="{{ route('contact') }}" class="nav-link {{ request()->routeIs('contact') ? 'active' : '' }}">Contact</a>
            </div>

            <div class="nav-right">
                @auth
                <a href="{{ route('profile') }}" class="nav-link">Profile</a>
                <form method="POST" action="{{ route('logout') }}" class="logout-form">
                    @csrf
                    <button type="submit" class="nav-link">Logout</button>
                </form>
                @else
                <a href="{{ route('login') }}" class="nav-link">Login</a>
                <a href="{{ route('register') }}" class="nav-link">Register</a>
                @endauth
            </div>
        </div>

        <div class="mobile-menu" id="mobileMenu">
            <a href="{{ route('home') }}" class="mobile-link {{ request()->routeIs('home') ? 'active' : '' }}">Home</a>
            <a href="{{ route('destinations.index') }}" class="mobile-link {{ request()->routeIs('destinations.*') ? 'active' : '' }}">Destinations</a>
            <a href="{{ route('about') }}" class="mobile-link {{ request()->routeIs('about') ? 'active' : '' }}">About</a>
            <a href="{{ route('contact') }}" class="mobile-link {{ request()->routeIs('contact') ? 'active' : '' }}">Contact</a>
            @auth
            <a href="{{ route('profile') }}" class="mobile-link">Profile</a>
            <form method="POST" action="{{ route('logout') }}" class="mobile-logout">
                @csrf
                <button type="submit" class="mobile-link">Logout</button>
            </form>
            @else
            <a href="{{ route('login') }}" class="mobile-link">Login</a>
            <a href="{{ route('register') }}" class="mobile-link">Register</a>
            @endauth
        </div>
    </nav>

    <main class="main-content">
        @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
        @endif

        @if(session('error'))
        <div class="alert alert-error">
            {{ session('error') }}
        </div>
        @endif

        @yield('content')
    </main>

    @include('layouts.footer')

    <script>
        function toggleMobileMenu() {
            const menu = document.getElementById('mobileMenu');
            menu.classList.toggle('active');
        }
    </script>

    @stack('scripts')
</body>

</html>