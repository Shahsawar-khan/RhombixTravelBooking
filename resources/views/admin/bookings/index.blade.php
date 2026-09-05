@extends('layouts.admin')

@section('title', 'Manage Bookings | TravelEase')

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

                <h1>Manage Bookings</h1>

                <p>
                    Review and manage customer booking requests.
                </p>
            </div>

            <a href="{{ route('admin.dashboard') }}" class="admin-view-site">
                ← Dashboard
            </a>

        </div>


        {{-- Success Message --}}
        @if(session('success'))
            <div class="admin-success-message">
                {{ session('success') }}
            </div>
        @endif


        {{-- Bookings --}}
        <section class="admin-section">

            <div class="admin-section-header">

                <span>BOOKING MANAGEMENT</span>

                <h2>All Bookings</h2>

            </div>


            @if($bookings->count())

                <div class="admin-table-wrapper">

                    <table class="admin-table">

                        <thead>
                            <tr>
                                <th>Booking</th>
                                <th>Customer</th>
                                <th>Package</th>
                                <th>Travel Date</th>
                                <th>Travelers</th>
                                <th>Total</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>

                        <tbody>

                            @foreach($bookings as $booking)

                                <tr>

                                    {{-- Booking --}}
                                    <td>
                                        <strong>
                                            #{{ $booking->id }}
                                        </strong>
                                    </td>


                                    {{-- Customer --}}
                                    <td>

                                        <strong>
                                            {{ $booking->user->name ?? 'N/A' }}
                                        </strong>

                                        <small class="admin-muted">
                                            {{ $booking->user->email ?? '' }}
                                        </small>

                                    </td>


                                    {{-- Package --}}
                                    <td>

                                        <span class="admin-destination-name">
                                            {{ $booking->package->title ?? 'N/A' }}
                                        </span>

                                        <span class="admin-country">
                                            {{ $booking->package->destination->name ?? 'N/A' }}
                                        </span>

                                    </td>


                                    {{-- Travel Date --}}
                                    <td>
                                        {{ \Carbon\Carbon::parse($booking->travel_date)->format('d M Y') }}
                                    </td>


                                    {{-- Travelers --}}
                                    <td>
                                        {{ $booking->travelers }}
                                    </td>


                                    {{-- Total --}}
                                    <td>
                                        <strong class="admin-price">
                                            ${{ number_format($booking->total_price, 2) }}
                                        </strong>
                                    </td>


                                    {{-- Status --}}
                                    <td>

                                        @if($booking->status === 'confirmed')

                                            <span class="admin-status active">
                                                <span></span>
                                                Confirmed
                                            </span>

                                        @elseif($booking->status === 'rejected')

                                            <span class="admin-status inactive">
                                                <span></span>
                                                Rejected
                                            </span>

                                        @else

                                            <span class="admin-status pending">
                                                <span></span>
                                                Pending
                                            </span>

                                        @endif

                                    </td>


                                    {{-- Actions --}}
                                    <td>

                                        <div class="admin-actions">

                                            <a
                                                href="{{ route('admin.bookings.show', $booking) }}"
                                                class="admin-edit-btn"
                                            >
                                                View
                                            </a>


                                            @if($booking->status === 'pending')

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
                                                        Confirm
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
                                                        Reject
                                                    </button>

                                                </form>

                                            @endif

                                        </div>

                                    </td>

                                </tr>

                            @endforeach

                        </tbody>

                    </table>

                </div>

            @else

                <div class="admin-empty-state">

                    <div class="admin-empty-icon">
                        ✈️
                    </div>

                    <h3>No Bookings Yet</h3>

                    <p>
                        Customer booking requests will appear here.
                    </p>

                </div>

            @endif

        </section>

    </div>

</div>

@endsection