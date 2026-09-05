<nav class="travel-navbar">
    <div class="navbar-container">

        {{-- Logo --}}
        <a href="{{ route('home') }}" class="travel-logo" aria-label="TravelEase Home">
            <span class="logo-icon">✈</span>
            <span>Travel<span class="logo-highlight">Ease</span></span>
        </a>

        {{-- Mobile Menu Button --}}
        <button
            type="button"
            class="mobile-menu-button"
            id="mobileMenuButton"
            aria-label="Toggle navigation menu"
            aria-expanded="false"
            aria-controls="navbarLinks"
        >
            <span></span>
            <span></span>
            <span></span>
        </button>

        {{-- Navigation --}}
        <div class="navbar-links" id="navbarLinks">

            <a
                href="{{ route('home') }}"
                class="nav-link {{ request()->routeIs('home') ? 'active' : '' }}"
            >
                Home
            </a>

            <a
                href="{{ route('destinations.index') }}"
                class="nav-link {{ request()->routeIs('destinations.*') ? 'active' : '' }}"
            >
                Destinations
            </a>

            <a
                href="{{ route('packages.index') }}"
                class="nav-link {{ request()->routeIs('packages.*') ? 'active' : '' }}"
            >
                Packages
            </a>

            <a href="{{ route('flights.search') }}" class="nav-link {{ request()->routeIs('flights.search') ? 'active' : '' }}">
    Flights
</a>

            @auth

                <a
                    href="{{ route('dashboard') }}"
                    class="nav-link {{ request()->routeIs('dashboard') ? 'active' : '' }}"
                >
                    Dashboard
                </a>

                <form
                    method="POST"
                    action="{{ route('logout') }}"
                    class="logout-form"
                >
                    @csrf

                    <button type="submit" class="nav-button">
                        Logout
                    </button>
                </form>

            @else

                <a
                    href="{{ route('login') }}"
                    class="nav-link {{ request()->routeIs('login') ? 'active' : '' }}"
                >
                    Login
                </a>

                <a
                    href="{{ route('register') }}"
                    class="register-button"
                >
                    Get Started
                </a>

            @endauth

        </div>
    </div>
</nav>

@push('scripts')
<script>
function initMobileMenu() {
    const menuButton = document.getElementById('mobileMenuButton');
    const navbarLinks = document.getElementById('navbarLinks');

    if (!menuButton || !navbarLinks) return;

    // Toggle Menu
    menuButton.addEventListener('click', function (e) {
        e.stopPropagation();
        const isOpen = navbarLinks.classList.toggle('show');
        menuButton.classList.toggle('active', isOpen);
        menuButton.setAttribute('aria-expanded', isOpen ? 'true' : 'false');
    });

    // Close on click outside or links
    navbarLinks.querySelectorAll('a').forEach(function (link) {
        link.addEventListener('click', function () {
            navbarLinks.classList.remove('show');
            menuButton.classList.remove('active');
            menuButton.setAttribute('aria-expanded', 'false');
        });
    });
}

// Ensure script runs regardless of DOM load timing
if (document.readyState === 'loading') {
    document.addEventListener('DOMContentLoaded', initMobileMenu);
} else {
    initMobileMenu();
}
</script>
@endpush
