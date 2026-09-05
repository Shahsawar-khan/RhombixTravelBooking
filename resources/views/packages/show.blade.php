@extends('layouts.travel')

@section('title', $package->title . ' | TravelEase')

@section('content')

<section class="package-details-page">

    <!-- Hero Image -->
    <div class="package-details-hero">

        <img
            src="{{ asset('assets/images/packages/' . $package->image) }}"
            alt="{{ $package->title }}"
        >

        <div class="package-details-overlay"></div>

        <div class="package-details-hero-content">

            <span class="package-location">
                {{ $package->destination->name }},
                {{ $package->destination->country }}
            </span>

            <h1>{{ $package->title }}</h1>

            <p>{{ $package->duration }}</p>

        </div>

    </div>


    <!-- Main Content -->
    <div class="package-details-container">

        <div class="package-details-grid">

            <!-- Left -->
            <div class="package-details-main">

                <span class="details-label">
                    PACKAGE OVERVIEW
                </span>

                <h2>
                    {{ $package->title }}
                </h2>

                <p class="package-description">
                    {{ $package->description }}
                </p>


                <!-- Information -->
                <div class="package-info-grid">

                    <div class="package-info-item">
                        <span class="info-icon">📅</span>

                        <div>
                            <small>Duration</small>
                            <strong>{{ $package->duration }}</strong>
                        </div>
                    </div>


                    <div class="package-info-item">
                        <span class="info-icon">📍</span>

                        <div>
                            <small>Destination</small>
                            <strong>{{ $package->destination->name }}</strong>
                        </div>
                    </div>


                    <div class="package-info-item">
                        <span class="info-icon">✈</span>

                        <div>
                            <small>Travel Type</small>
                            <strong>Tour Package</strong>
                        </div>
                    </div>


                    <div class="package-info-item">
                        <span class="info-icon">✓</span>

                        <div>
                            <small>Availability</small>
                            <strong>Available</strong>
                        </div>
                    </div>

                </div>

            </div>


            <!-- Right Booking Card -->
            <aside class="booking-card">

                <span class="booking-card-label">
                    STARTING FROM
                </span>

                <div class="booking-price">
                    ${{ number_format($package->price, 2) }}
                </div>

                <p>
                    Per person
                </p>


                <div class="booking-divider"></div>


                <div class="booking-summary">

                    <div>
                        <span>Destination</span>
                        <strong>{{ $package->destination->name }}</strong>
                    </div>

                    <div>
                        <span>Duration</span>
                        <strong>{{ $package->duration }}</strong>
                    </div>

                </div>


                @auth

                    <a
                        href="{{ route('bookings.create', $package) }}"
                        class="book-now-button"
                    >
                            Book Now
                            <span>→</span>
                    </a>

                @else

                    <a href="{{ route('login') }}" class="book-now-button">
                            Login to Book
                            <span>→</span>
                    </a>

                    <small class="booking-login-note">
                        Please login or create an account to continue.
                    </small>

                @endauth


                <a
                    href="{{ route('destinations.packages', $package->destination) }}"
                    class="back-packages"
                >
                    ← Back to Packages
                </a>

            </aside>

        </div>

    </div>

</section>

@endsection