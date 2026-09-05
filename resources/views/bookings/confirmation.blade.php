@extends('layouts.travel')

@section('title', 'Booking Confirmed | TravelEase')

@section('content')

<section class="confirmation-page">

    <div class="confirmation-container">

        <div class="confirmation-success">

            <div class="success-icon">
                ✓
            </div>

            <span class="success-label">
                BOOKING REQUEST RECEIVED
            </span>

            <h1>Thank You for Booking!</h1>

            <p>
                Your travel booking request has been successfully submitted.
                We will review your request and contact you with the confirmation.
            </p>

        </div>


        <div class="confirmation-card">

            <div class="confirmation-card-header">

                <div>
                    <span>BOOKING REFERENCE</span>
                    <h2>#{{ str_pad($booking->id, 5, '0', STR_PAD_LEFT) }}</h2>
                </div>

                <div class="booking-status">
                    {{ ucfirst($booking->status) }}
                </div>

            </div>


            <div class="confirmation-package">

                <img
                    src="{{ asset('assets/images/packages/' . $booking->package->image) }}"
                    alt="{{ $booking->package->title }}"
                >

                <div>
                    <span>PACKAGE</span>

                    <h3>
                        {{ $booking->package->title }}
                    </h3>

                    <p>
                        📍 {{ $booking->package->destination->name }},
                        {{ $booking->package->destination->country }}
                    </p>
                </div>

            </div>


            <div class="confirmation-details">

                <div class="confirmation-detail">
                    <span>Travel Date</span>
                    <strong>
                        {{ \Carbon\Carbon::parse($booking->travel_date)->format('d M Y') }}
                    </strong>
                </div>

                <div class="confirmation-detail">
                    <span>Travelers</span>
                    <strong>
                        {{ $booking->travelers }}
                    </strong>
                </div>

                <div class="confirmation-detail">
                    <span>Duration</span>
                    <strong>
                        {{ $booking->package->duration }}
                    </strong>
                </div>

                <div class="confirmation-detail">
                    <span>Total Price</span>
                    <strong class="confirmation-price">
                        ${{ number_format($booking->total_price, 2) }}
                    </strong>
                </div>

            </div>


            <div class="traveler-section">

                <span>PRIMARY TRAVELER</span>

                @foreach($booking->bookingTravelers as $traveler)

                    <div class="traveler-info">

                        <div>
                            <small>Full Name</small>
                            <strong>
                                {{ $traveler->first_name }}
                                {{ $traveler->last_name }}
                            </strong>
                        </div>

                        <div>
                            <small>Email</small>
                            <strong>
                                {{ $traveler->email }}
                            </strong>
                        </div>

                        <div>
                            <small>Phone</small>
                            <strong>
                                {{ $traveler->phone }}
                            </strong>
                        </div>

                    </div>

                @endforeach

            </div>


            <div class="confirmation-actions">

                <a href="{{ route('home') }}" class="confirmation-home">
                    Back to Home
                </a>

                <a href="{{ route('dashboard') }}" class="confirmation-dashboard">
                    View My Bookings →
                </a>

            </div>

        </div>


        <p class="confirmation-note">
            Keep your booking reference <strong>#{{ str_pad($booking->id, 5, '0', STR_PAD_LEFT) }}</strong>
            for future communication.
        </p>

    </div>

</section>

@endsection