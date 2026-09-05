@extends('layouts.admin')

@section('title', 'Manage Destinations | TravelEase')

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

                <h1>Destinations</h1>

                <p>
                    Manage all travel destinations available on your website.
                </p>
            </div>

            <a
                href="{{ route('admin.destinations.create') }}"
                class="admin-view-site"
            >
                + Add Destination
            </a>

        </div>


        {{-- Success Message --}}
        @if(session('success'))

            <div class="admin-success-message">
                {{ session('success') }}
            </div>

        @endif


        {{-- Destinations --}}
        <section class="admin-section">

            <div class="admin-section-header">

                <span>DESTINATION MANAGEMENT</span>

                <h2>All Destinations</h2>

            </div>


            @if($destinations->count())

                <div class="admin-destination-list">

                    @foreach($destinations as $destination)

                        <article class="admin-destination-card">

                            {{-- Image --}}
                            <div class="admin-destination-image">

                                @if($destination->image)

                                    <img
                                        src="{{ asset('assets/images/destinations/' . $destination->image) }}"
                                        alt="{{ $destination->name }}"
                                    >

                                @else

                                    <div class="admin-no-image">
                                        No Image
                                    </div>

                                @endif

                            </div>


                            {{-- Information --}}
                            <div class="admin-destination-info">

                                <span class="admin-destination-country">
                                    {{ $destination->country }}
                                </span>

                                <h3>
                                    {{ $destination->name }}
                                </h3>

                                <p>
                                    {{ $destination->description
                                        ? \Illuminate\Support\Str::limit($destination->description, 120)
                                        : 'No description available.'
                                    }}
                                </p>

                            </div>


                            {{-- Status --}}
                            <div class="admin-destination-status">

                                @if($destination->status)

                                    <span class="admin-active-status">
                                        Active
                                    </span>

                                @else

                                    <span class="admin-inactive-status">
                                        Inactive
                                    </span>

                                @endif

                            </div>


                            {{-- Actions --}}
                            <div class="admin-destination-actions">

                                <a
                                    href="{{ route('admin.destinations.edit', $destination) }}"
                                    class="admin-edit-btn"
                                >
                                    Edit
                                </a>


                                <form
                                    method="POST"
                                    action="{{ route('admin.destinations.destroy', $destination) }}"
                                    onsubmit="return confirm('Are you sure you want to delete this destination?');"
                                >

                                    @csrf

                                    @method('DELETE')

                                    <button
                                        type="submit"
                                        class="admin-delete-btn"
                                    >
                                        Delete
                                    </button>

                                </form>

                            </div>

                        </article>

                    @endforeach

                </div>

            @else

                <div class="admin-empty-state">

                    <div class="admin-empty-icon">
                        📍
                    </div>

                    <h3>No destinations found</h3>

                    <p>
                        Start by adding your first travel destination.
                    </p>

                    <a
                        href="{{ route('admin.destinations.create') }}"
                        class="admin-view-site"
                    >
                        + Add Destination
                    </a>

                </div>

            @endif

        </section>

    </div>

</div>

@endsection