<nav class="admin-navbar">

    <div class="admin-navbar-container">

        {{-- Brand --}}
        <a
            href="{{ route('admin.dashboard') }}"
            class="admin-navbar-brand"
        >
            <span class="admin-brand-icon">✈</span>
            <span>TravelEase <small>ADMIN</small></span>
        </a>


        {{-- Mobile Toggle --}}
        <button
            type="button"
            class="admin-menu-toggle"
            id="adminMenuToggle"
            aria-label="Toggle admin menu"
            aria-expanded="false"
        >
            <span></span>
            <span></span>
            <span></span>
        </button>


        {{-- Navigation --}}
        <div class="admin-navbar-menu" id="adminNavbarMenu">

            <a
                href="{{ route('admin.dashboard') }}"
                class="{{ request()->routeIs('admin.dashboard') ? 'active' : '' }}"
            >
                Dashboard
            </a>

            <a
                href="{{ route('admin.destinations.index') }}"
                class="{{ request()->routeIs('admin.destinations.*') ? 'active' : '' }}"
            >
                Destinations
            </a>

            <a
                href="{{ route('admin.packages.index') }}"
                class="{{ request()->routeIs('admin.packages.*') ? 'active' : '' }}"
            >
                Packages
            </a>

            <a
                href="{{ route('admin.bookings.index') }}"
                class="{{ request()->routeIs('admin.bookings.*') ? 'active' : '' }}"
            >
                Bookings
            </a>


            {{-- View Public Website --}}
            <a
                href="{{ url('/') }}"
                class="admin-navbar-website"
                target="_blank"
                rel="noopener noreferrer"
                >
                    View Website
            </a>


            {{-- Logout --}}
            <form
                method="POST"
                action="{{ route('logout') }}"
                class="admin-navbar-logout"
            >

                @csrf

                <button type="submit">
                    Logout
                </button>

            </form>

        </div>

    </div>

</nav>


@push('scripts')

<script>
    document.addEventListener('DOMContentLoaded', function () {

        const toggle = document.getElementById('adminMenuToggle');
        const menu = document.getElementById('adminNavbarMenu');

        if (!toggle || !menu) {
            return;
        }

        toggle.addEventListener('click', function () {

            const isOpen = menu.classList.toggle('show');

            toggle.classList.toggle('active', isOpen);

            toggle.setAttribute(
                'aria-expanded',
                isOpen ? 'true' : 'false'
            );

        });

    });
</script>

@endpush