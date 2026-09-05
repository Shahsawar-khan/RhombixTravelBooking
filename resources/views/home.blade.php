@extends('layouts.travel')

@section('content')

    <!-- Hero Section -->
    <section class="hero-section">

        <div class="hero-overlay"></div>

        <div class="hero-container">

            <div class="hero-content">

                <span class="hero-badge">
                    ✈ Discover • Explore • Experience
                </span>

                <h1>
                    Your Journey
                    <span>Starts Here.</span>
                </h1>

                <p>
                    Explore breathtaking destinations, discover unforgettable
                    experiences, and plan your perfect journey with TravelEase.
                </p>

                <div class="hero-actions">

                    <a href="{{ route('destinations.index') }}" class="primary-btn">
                        Explore Destinations
                        <span>→</span>
                    </a>

                    <a href="{{ route('packages.index') }}" class="secondary-btn">
                        View Packages
                    </a>

                </div>

            </div>

        </div>

        <!-- Search Card Container with Tabs -->
        <div class="tabbed-search-box">
            
            {{-- Navigation Tabs --}}
            <div class="tabbed-nav">
                <button type="button" id="btn-pkg" onclick="toggleSearch('pkg')" class="tab-link active">🌴 Packages Search</button>
                <button type="button" id="btn-flight" onclick="toggleSearch('flight')" class="tab-link inactive">✈️ Live Flights (API)</button>
            </div>

            {{-- Packages Form --}}
            <form method="GET" action="{{ route('packages.search') }}" id="search-pkg-form" class="hero-search">

                <div class="search-item">
                    <span class="search-icon">
                        <svg viewBox="0 0 24 24" aria-hidden="true">
                            <path d="M12 21s7-6.2 7-12a7 7 0 1 0-14 0c0 5.8 7 12 7 12Z"/>
                            <circle cx="12" cy="9" r="2.5"/>
                        </svg>
                    </span>

                    <div>
                        <small>Where to?</small>

                        <select name="destination_id" required>
                            <option value="">Choose destination</option>

                            @foreach($destinations as $destination)
                                <option value="{{ $destination->id }}">
                                    {{ $destination->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="search-divider"></div>

                <div class="search-item">
                    <span class="search-icon">
                        <svg viewBox="0 0 24 24" aria-hidden="true">
                            <rect x="3" y="5" width="18" height="16" rx="2"/>
                            <path d="M16 3v4M8 3v4M3 10h18"/>
                        </svg>
                    </span>

                    <div>
                        <small>Travel Date</small>

                        <input
                            type="date"
                            name="travel_date"
                            min="{{ date('Y-m-d', strtotime('+1 day')) }}"
                            required
                        >
                    </div>
                </div>

                <div class="search-divider"></div>

                <div class="search-item">
                    <div>
                        <small>Travelers</small>

                        <input
                            type="number"
                            name="travelers"
                            value="2"
                            min="1"
                            max="20"
                            required
                        >
                    </div>
                </div>

                <button type="submit" class="search-button">
                    Search
                </button>

            </form>

            {{-- Flights Form (API Integration) --}}
            <form method="GET" action="{{ route('flights.search') }}" id="search-flight-form" class="hero-search" style="display: none;">

                <div class="search-item">
                    <span class="search-icon">
                        <svg viewBox="0 0 24 24" aria-hidden="true">
                            <path d="M12 21s7-6.2 7-12a7 7 0 1 0-14 0c0 5.8 7 12 7 12Z"/>
                            <circle cx="12" cy="9" r="2.5"/>
                        </svg>
                    </span>

                    <div>
                        <small>Departure (IATA Code)</small>
                        <input type="text" name="departure" placeholder="e.g. DXB" style="text-transform: uppercase;" required>
                    </div>
                </div>

                <div class="search-divider"></div>

                <div class="search-item">
                    <span class="search-icon">
                        <svg viewBox="0 0 24 24" aria-hidden="true">
                            <rect x="3" y="5" width="18" height="16" rx="2"/>
                            <path d="M16 3v4M8 3v4M3 10h18"/>
                        </svg>
                    </span>

                    <div>
                        <small>Arrival (IATA Code)</small>
                        <input type="text" name="arrival" placeholder="e.g. LHR" style="text-transform: uppercase;">
                    </div>
                </div>

                <button type="submit" class="search-button">
                    Search Flights
                </button>

            </form>

        </div>

    </section>

    <!-- JS Toggle Script -->
    <script>
        function toggleSearch(type) {
            const pkgForm = document.getElementById('search-pkg-form');
            const flightForm = document.getElementById('search-flight-form');
            const btnPkg = document.getElementById('btn-pkg');
            const btnFlight = document.getElementById('btn-flight');

            if (type === 'flight') {
                pkgForm.style.display = 'none';
                flightForm.style.display = 'flex';
                btnFlight.className = 'tab-link active';
                btnPkg.className = 'tab-link inactive';
            } else {
                flightForm.style.display = 'none';
                pkgForm.style.display = 'flex';
                btnPkg.className = 'tab-link active';
                btnFlight.className = 'tab-link inactive';
            }
        }
    </script>


    <!-- Features -->
    <section class="features-section">

        <div class="section-container">

            <div class="section-heading">
                <span>WHY TRAVEL WITH US</span>

                <h2>
                    Everything You Need for a Perfect Journey
                </h2>

                <p>
                    We make travel planning simple, comfortable and memorable.
                </p>
            </div>


            <div class="features-grid">

                <div class="feature-card">

                    <div class="feature-icon">
                        🌎
                    </div>

                    <h3>Amazing Destinations</h3>

                    <p>
                        Discover beautiful places and unforgettable travel
                        experiences around the world.
                    </p>

                </div>


                <div class="feature-card">

                    <div class="feature-icon">
                        ⚡
                    </div>

                    <h3>Easy Booking</h3>

                    <p>
                        Find your perfect package and book your journey with
                        a simple and convenient process.
                    </p>

                </div>


                <div class="feature-card">

                    <div class="feature-icon">
                        🛡️
                    </div>

                    <h3>Secure & Reliable</h3>

                    <p>
                        Your booking information is handled through a secure
                        and reliable travel platform.
                    </p>

                </div>

            </div>

        </div>

    </section>


    <!-- Popular Destinations Preview -->
    <section class="destinations-preview" id="destinations">

        <div class="section-container">

            <div class="section-heading destinations-heading">

                <div>
                    <span>EXPLORE THE WORLD</span>

                    <h2>
                        Popular Destinations
                    </h2>
                </div>

                <a href="{{ route('destinations.index') }}" class="view-all-link">
                    View all destinations →
                </a>

            </div>


            <div class="destination-preview-grid">

                @foreach($destinations->take(3) as $destination)

                    <div
                        class="destination-preview-card"
                        style="background-image: url('{{ asset('assets/images/destinations/' . $destination->image) }}');"
                    >

                        <div class="destination-card-overlay">

                            <span>
                                {{ $destination->country }}
                            </span>

                            <h3>
                                {{ $destination->name }}
                            </h3>

                            <a href="{{ route('destinations.packages', $destination) }}">
                                Explore →
                            </a>

                        </div>

                    </div>

                @endforeach

            </div>

        </div>

    </section>

    <!-- Featured Packages -->
    <section class="featured-packages-section">

        <div class="section-container">

            <div class="section-heading packages-heading-home">

                <div>
                    <span>PLAN YOUR NEXT ADVENTURE</span>

                    <h2>
                        Featured Travel Packages
                    </h2>

                    <p>
                        Choose from our carefully selected travel experiences.
                    </p>
                </div>

                <a href="{{ route('packages.index') }}" class="view-all-link">
                    View all packages →
                </a>

            </div>


            <div class="featured-packages-grid">

                @foreach($packages->take(4) as $package)

                    <article class="featured-package-card">

                        <!-- Image -->
                        <div class="featured-package-image">

                            <img
                                src="{{ asset('assets/images/packages/' . $package->image) }}"
                                alt="{{ $package->title }}"
                            >

                            <span class="featured-package-duration">
                                {{ $package->duration }}
                            </span>

                        </div>


                        <!-- Content -->
                        <div class="featured-package-content">

                            <span class="featured-package-location">
                                📍 {{ $package->destination->name }}
                            </span>

                            <h3>
                                {{ $package->title }}
                            </h3>

                            <p>
                                {{ \Illuminate\Support\Str::limit($package->description, 95) }}
                            </p>


                            <div class="featured-package-bottom">

                                <div class="featured-package-price">

                                    <small>
                                        Starting from
                                    </small>

                                    <strong>
                                        ${{ number_format($package->price, 2) }}
                                    </strong>

                                </div>


                                <a
                                    href="{{ route('packages.show', $package) }}"
                                    class="featured-package-button"
                                >
                                    View Details →
                                </a>

                            </div>

                        </div>

                    </article>

                @endforeach

            </div>

        </div>

    </section>


    <!-- CTA -->
    <section class="cta-section">

        <div class="cta-container">

            <div>
                <span>READY FOR YOUR NEXT ADVENTURE?</span>

                <h2>
                    Let's Make Your Next Journey Unforgettable.
                </h2>

                <p>
                    Explore our destinations and find a travel package
                    that fits your journey.
                </p>
            </div>

            <a href="{{ route('destinations.index') }}" class="cta-button">
                Start Exploring →
            </a>

        </div>

    </section>

@endsection