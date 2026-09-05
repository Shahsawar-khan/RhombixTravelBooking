@extends('layouts.admin')

@section('title', 'Admin Dashboard | TravelEase')

@push('styles')
    @vite(['resources/css/admin.css'])
@endpush

@section('content')

<div class="admin-page">

    <div class="admin-container">

        <div class="admin-header">

            <div>
                <span class="admin-eyebrow">TRAVELEASE ADMIN</span>

                <h1>Admin Dashboard</h1>

                <p>
                    Manage your travel platform from one place.
                </p>
            </div>

            

        </div>


        {{-- Statistics --}}

        <div class="admin-stats-grid">

            <div class="admin-stat-card">
                <div class="admin-stat-icon">👥</div>

                <div>
                    <span>Total Users</span>
                    <strong>{{ $stats['users'] }}</strong>
                </div>
            </div>


            <div class="admin-stat-card">
                <div class="admin-stat-icon">📍</div>

                <div>
                    <span>Destinations</span>
                    <strong>{{ $stats['destinations'] }}</strong>
                </div>
            </div>


            <div class="admin-stat-card">
                <div class="admin-stat-icon">📦</div>

                <div>
                    <span>Packages</span>
                    <strong>{{ $stats['packages'] }}</strong>
                </div>
            </div>


            <div class="admin-stat-card">
                <div class="admin-stat-icon">✈️</div>

                <div>
                    <span>Total Bookings</span>
                    <strong>{{ $stats['bookings'] }}</strong>
                </div>
            </div>

        </div>


        {{-- Management --}}

       {{-- Management --}}

<section class="admin-section">

    <div class="admin-section-header">

        <span>MANAGEMENT</span>

        <h2>Manage Travel Platform</h2>

    </div>


    <div class="admin-management-grid">

        <a href="{{ route('admin.destinations.index') }}" class="admin-management-card">

            <div class="admin-management-icon">
                📍
            </div>

            <h3>Destinations</h3>

            <p>
                Add, edit and remove travel destinations.
            </p>

        </a>


        <a href="{{ route('admin.packages.index') }}" class="admin-management-card">

            <div class="admin-management-icon">
                📦
            </div>

            <h3>Packages</h3>

            <p>
                Manage travel packages, prices and details.
            </p>

        </a>


        <a href="{{ route('admin.bookings.index') }}" class="admin-management-card">

            <div class="admin-management-icon">
                ✈️
            </div>

            <h3>Bookings</h3>

            <p>
                Review and manage customer booking requests.
            </p>

        </a>

    </div>

</section>


        {{-- Booking Status --}}

        <section class="admin-section">

            <div class="admin-section-header">

                <span>BOOKING OVERVIEW</span>

                <h2>Booking Status</h2>

            </div>


            <div class="admin-booking-status">

                <div class="admin-status-card">
                    <span>Pending Bookings</span>
                    <strong>{{ $stats['pending'] }}</strong>
                </div>


                <div class="admin-status-card">
                    <span>Confirmed Bookings</span>
                    <strong>{{ $stats['confirmed'] }}</strong>
                </div>


                <div class="admin-status-card">
                    <span>Rejected Bookings</span>
                    <strong>{{ $stats['rejected'] }}</strong>
                </div>

            </div>

        </section>

    </div>

</div>

@endsection