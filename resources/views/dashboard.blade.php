<x-app-layout>

    <div class="te-dashboard">

        {{-- Dashboard Hero --}}
        <section class="te-dashboard-hero">
            <div class="te-hero-inner">

                <div>
                    <span class="te-eyebrow">TRAVEL EASE</span>

                    <h1>
                        Welcome back,
                        <span>{{ Auth::user()->name }}</span>
                    </h1>

                    <p>
                        Manage your trips, explore new destinations,
                        and make your next journey unforgettable.
                    </p>
                </div>

                <a href="{{ route('home') }}" class="te-explore-btn">
                    <span>Explore Destinations</span>
                    <span class="te-arrow">→</span>
                </a>

            </div>
        </section>


        {{-- Dashboard Content --}}
        <main class="te-dashboard-content">

            {{-- Statistics --}}
            <section class="te-stats-grid">

                <div class="te-stat-card">
                    <div class="te-stat-icon">✈</div>

                    <div>
                        <span>Total Bookings</span>
                        <strong>{{ $bookings->count() }}</strong>
                    </div>
                </div>


                <div class="te-stat-card">
                    <div class="te-stat-icon">📅</div>

                    <div>
                        <span>Upcoming Trips</span>

                        <strong>
                            {{
                                $bookings->filter(function ($booking) {
                                    return \Carbon\Carbon::parse($booking->travel_date)->isFuture();
                                })->count()
                            }}
                        </strong>
                    </div>
                </div>


                <div class="te-stat-card">
                    <div class="te-stat-icon">👥</div>

                    <div>
                        <span>Total Travelers</span>

                        <strong>
                            {{ $bookings->sum('travelers') }}
                        </strong>
                    </div>
                </div>


                <div class="te-stat-card">
                    <div class="te-stat-icon">💳</div>

                    <div>
                        <span>Total Spent</span>

                        <strong>
                            ${{ number_format($bookings->sum('total_price'), 0) }}
                        </strong>
                    </div>
                </div>

            </section>


            {{-- Section Heading --}}
            <div class="te-section-heading">

                <div>
                    <span class="te-small-label">YOUR JOURNEYS</span>
                    <h2>My Bookings</h2>
                </div>

                @if($bookings->count())
                    <span class="te-booking-count">
                        {{ $bookings->count() }}
                        {{ $bookings->count() == 1 ? 'Booking' : 'Bookings' }}
                    </span>
                @endif

            </div>


            {{-- Bookings --}}
            @if($bookings->count())

                <section class="te-bookings-list">

                    @foreach($bookings as $booking)

                        <article class="te-booking-card">

                            {{-- Image --}}
                            <div class="te-booking-image">

                                @if($booking->package)
                                    <img
                                        src="{{ asset('assets/images/packages/' . $booking->package->image) }}"
                                        alt="{{ $booking->package->title }}"
                                    >
                                    <div class="te-image-overlay"></div>
                                    <span class="te-package-tag">
                                        {{ $booking->package->destination->name ?? 'Package' }}
                                    </span>
                                @else
                                    <img
                                        src="https://images.unsplash.com/photo-1436491865332-7a61a109cc05?q=80&w=800&auto=format&fit=crop"
                                        alt="Flight Booking"
                                    >
                                    <div class="te-image-overlay"></div>
                                    <span class="te-package-tag">
                                        Flight
                                    </span>
                                @endif

                            </div>


                            {{-- Content --}}
                            <div class="te-booking-info">

                                <div class="te-booking-top">

                                    <div>
                                        <span class="te-package-label">
                                            {{ $booking->package ? 'TRAVEL PACKAGE' : 'LIVE FLIGHT BOOKING' }}
                                        </span>

                                        <h3>
                                            {{ $booking->package->title ?? 'Direct Flight Reservation' }}
                                        </h3>

                                        <p class="te-location">
                                            <span>📍</span>
                                            @if($booking->package)
                                                {{ $booking->package->destination->name ?? 'Destination' }},
                                                {{ $booking->package->destination->country ?? 'Country' }}
                                            @else
                                                Live Air Route
                                            @endif
                                        </p>
                                    </div>


                                    <span class="te-status te-status-{{ $booking->status }}">
                                        <span class="te-status-dot"></span>
                                        {{ ucfirst($booking->status) }}
                                    </span>

                                </div>


                                {{-- Details --}}
                                <div class="te-booking-details">

                                    <div class="te-detail">

                                        <span class="te-detail-label">
                                            TRAVEL DATE
                                        </span>

                                        <strong>
                                            {{ \Carbon\Carbon::parse($booking->travel_date)->format('d M Y') }}
                                        </strong>

                                    </div>


                                    <div class="te-detail">

                                        <span class="te-detail-label">
                                            TRAVELERS
                                        </span>

                                        <strong>
                                            {{ $booking->travelers }}
                                            {{ $booking->travelers == 1 ? 'Person' : 'People' }}
                                        </strong>

                                    </div>


                                    <div class="te-detail">

                                        <span class="te-detail-label">
                                            DURATION
                                        </span>

                                        <strong>
                                            {{ $booking->package->duration ?? '1 Day Flight' }}
                                        </strong>

                                    </div>


                                    <div class="te-detail te-price-detail">

                                        <span class="te-detail-label">
                                            TOTAL PRICE
                                        </span>

                                        <strong>
                                            ${{ number_format($booking->total_price, 2) }}
                                        </strong>

                                    </div>

                                </div>


                                {{-- Footer --}}
                                <div class="te-booking-bottom">

                                    <span class="te-booking-number">
                                        Booking #{{ str_pad($booking->id, 5, '0', STR_PAD_LEFT) }}
                                    </span>


                                    <a
                                        href="{{ route('bookings.confirmation', $booking->id) }}"
                                        class="te-details-btn"
                                    >
                                        View Booking
                                        <span>→</span>
                                    </a>

                                </div>

                            </div>

                        </article>

                    @endforeach

                </section>


            @else

                {{-- Empty State --}}
                <section class="te-empty-state">

                    <div class="te-empty-icon">
                        ✈
                    </div>

                    <span class="te-small-label">
                        START YOUR JOURNEY
                    </span>

                    <h3>No bookings yet</h3>

                    <p>
                        Your next adventure is waiting.
                        Explore our destinations and find the perfect trip for you.
                    </p>

                    <a href="{{ route('home') }}" class="te-explore-btn">
                        Explore Destinations
                        <span class="te-arrow">→</span>
                    </a>

                </section>

            @endif

        </main>

    </div>

</x-app-layout>