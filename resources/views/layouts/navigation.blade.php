<nav class="main-nav">
    <div class="container nav-container">
        <a href="{{ route('home') }}" class="nav-logo">
            Dreamscape
        </a>

        <div class="nav-links">
            <a href="{{ route('destinations.index') }}" class="nav-link {{ request()->routeIs('destinations.*') ? 'active' : '' }}">
                Destinations
            </a>
            <a href="{{ route('about') }}" class="nav-link {{ request()->routeIs('about') ? 'active' : '' }}">
                About
            </a>
            <a href="{{ route('contact') }}" class="nav-link {{ request()->routeIs('contact') ? 'active' : '' }}">
                Contact
            </a>
        </div>

        <div class="nav-auth">
            @auth
                <div class="dropdown">
                    <button class="dropdown-toggle">
                        {{ Auth::user()->name }}
                    </button>
                    <div class="dropdown-menu">
                        <a href="{{ route('profile') }}" class="dropdown-item">Profile</a>
                        <a href="{{ route('bookings.index') }}" class="dropdown-item">My Bookings</a>
                        <a href="{{ route('wishlist.index') }}" class="dropdown-item">Wishlist</a>
                        @if(Auth::user()->is_admin)
                            <a href="{{ route('admin.dashboard') }}" class="dropdown-item">Admin Dashboard</a>
                        @endif
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit" class="dropdown-item">Logout</button>
                        </form>
                    </div>
                </div>
            @else
                <a href="{{ route('login') }}" class="btn btn-primary">Login</a>
                <a href="{{ route('register') }}" class="btn btn-secondary">Register</a>
            @endauth
        </div>
    </div>
</nav>