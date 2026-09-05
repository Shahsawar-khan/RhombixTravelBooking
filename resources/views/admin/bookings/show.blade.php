@extends('layouts.admin')

@section('title', 'Booking Details | TravelEase')

@push('styles')
    @vite(['resources/css/admin.css'])
@endpush

@section('content')

<div class="admin-page">

    <div class="admin-container">

        {{-- Header --}}
        <div class="admin-header">

            <div>
                <span class="admin-eyebrow">TRAVELEASE ADMIN</span>

                <h1>Booking Details</h1>

                <p>
                    Review complete information about this booking.
                </p>
            </div>

            <a
                href="{{ route('admin.bookings.index') }}"
                class="admin-view-site"
            >
                ← All Bookings
            </a>

        </div>

        {{-- Success Message --}}
        @if(session('success'))
            <div class="admin-success-message">
                {{ session('success') }}
            </div>
        @endif


        {{-- Booking Overview --}}
        <section class="admin-section">

            <div class="admin-section-header">

                <span>BOOKING INFORMATION</span>

                <h2>
                    Booking #{{ $booking->id }}
                </h2>

            </div>


            <div class="admin-detail-grid">

                {{-- Customer --}}
                <div class="admin-detail-card">

                    <span class="admin-detail-label">
                        CUSTOMER
                    </span>

                    <h3>
                        {{ $booking->user->name ?? 'N/A' }}
                    </h3>

                    <p>
                        {{ $booking->user->email ?? 'N/A' }}
                    </p>

                </div>


                {{-- Package --}}
                <div class="admin-detail-card">

                    <span class="admin-detail-label">
                        PACKAGE / TYPE
                    </span>

                    <h3>
                        {{ $booking->package->title ?? 'Direct Flight Booking' }}
                    </h3>

                    <p>
                        {{ $booking->package->destination->name ?? 'N/A' }}
                    </p>

                </div>


                {{-- Travel Date --}}
                <div class="admin-detail-card">

                    <span class="admin-detail-label">
                        TRAVEL DATE
                    </span>

                    <h3>
                        {{ \Carbon\Carbon::parse($booking->travel_date)->format('d M Y') }}
                    </h3>

                    <p>
                        {{ $booking->travelers }} Traveler(s)
                    </p>

                </div>


                {{-- Total Price --}}
                <div class="admin-detail-card">

                    <span class="admin-detail-label">
                        TOTAL PRICE
                    </span>

                    <h3 class="admin-price">
                        ${{ number_format($booking->total_price, 2) }}
                    </h3>

                    <p>
                        Booking total
                    </p>

                </div>

            </div>

        </section>


        {{-- Booking Status --}}
        <section class="admin-section">

            <div class="admin-section-header">

                <span>BOOKING STATUS</span>

                <h2>Current Status</h2>

            </div>


            <div class="admin-booking-status-box">

                @if($booking->status === 'confirmed')

                    <span class="admin-status active">
                        <span></span>
                        Confirmed
                    </span>

                    <p>
                        This booking has been confirmed.
                    </p>

                @elseif($booking->status === 'rejected')

                    <span class="admin-status inactive">
                        <span></span>
                        Rejected
                    </span>

                    <p>
                        This booking has been rejected.
                    </p>

                @else

                    <span class="admin-status pending">
                        <span></span>
                        Pending
                    </span>

                    <p>
                        This booking is waiting for admin review.
                    </p>

                @endif

            </div>


            {{-- Admin Actions --}}
            @if($booking->status === 'pending')

                <div class="admin-actions admin-booking-detail-actions">

                    <form
                        action="{{ route('admin.bookings.confirm', $booking) }}"
                        method="POST"
                    >

                        @csrf
                        @method('PATCH')

                        <button
                            type="submit"
                            class="admin-submit-btn"
                        >
                            Confirm Booking
                        </button>

                    </form>


                    <form
                        action="{{ route('admin.bookings.reject', $booking) }}"
                        method="POST"
                    >

                        @csrf
                        @method('PATCH')

                        <button
                            type="submit"
                            class="admin-delete-btn"
                        >
                            Reject Booking
                        </button>

                    </form>

                </div>

            @endif

        </section>


        {{-- Traveler Information --}}
        <section class="admin-section">

            <div class="admin-section-header">

                <span>TRAVELER INFORMATION</span>

                <h2>Traveler Details</h2>

            </div>


            @if($booking->bookingTravelers && $booking->bookingTravelers->count())

                <div class="admin-table-wrapper">

                    <table class="admin-table">

                        <thead>

                            <tr>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Phone</th>
                                <th>Passport Number</th>
                            </tr>

                        </thead>


                        <tbody>

                            @foreach($booking->bookingTravelers as $traveler)

                                <tr>

                                    <td>
                                        <strong>
                                            {{ $traveler->first_name }}
                                            {{ $traveler->last_name }}
                                        </strong>
                                    </td>

                                    <td>
                                        {{ $traveler->email }}
                                    </td>

                                    <td>
                                        {{ $traveler->phone }}
                                    </td>

                                    <td>
                                        {{ $traveler->passport_number ?? 'N/A' }}
                                    </td>

                                </tr>

                            @endforeach

                        </tbody>

                    </table>

                </div>

            @else

                <div class="admin-empty-state">

                    <div class="admin-empty-icon">
                        👤
                    </div>

                    <h3>No Traveler Information</h3>

                    <p>
                        No traveler details are available for this booking.
                    </p>

                </div>

            @endif

        </section>


        {{-- Package Information --}}
        <section class="admin-section">

            <div class="admin-section-header">

                <span>PACKAGE / ITEM INFORMATION</span>

                <h2>Selected Details</h2>

            </div>


            <div class="admin-detail-card admin-package-detail">

                @if($booking->package)
                    <h3>
                        {{ $booking->package->title }}
                    </h3>

                    <p>
                        Destination:
                        <strong>
                            {{ $booking->package->destination->name ?? 'N/A' }}
                        </strong>
                    </p>

                    <p>
                        Price per traveler:
                        <strong>
                            ${{ number_format($booking->package->price, 2) }}
                        </strong>
                    </p>
                @else
                    <h3>
                        Direct Flight Reservation
                    </h3>

                    <p>
                        Type:
                        <strong>
                            Custom API Flight Search
                        </strong>
                    </p>

                    <p>
                        Total Amount Paid:
                        <strong>
                            ${{ number_format($booking->total_price, 2) }}
                        </strong>
                    </p>
                @endif

            </div>

        </section>

    </div>

</div>

@endsection