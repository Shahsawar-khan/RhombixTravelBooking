@extends('layouts.travel')

@section('title', 'Destinations | TravelEase')

@section('content')

<section class="destinations-page">

    <!-- Page Header -->
    <div class="destinations-hero">

        <div class="destinations-hero-content">

            <span class="destinations-eyebrow">
                EXPLORE THE WORLD
            </span>

            <h1>
                Discover Your Next
                <span>Adventure</span>
            </h1>

            <p>
                Explore incredible destinations and find the perfect
                place for your next unforgettable journey.
            </p>

        </div>

    </div>


    <!-- Destinations Section -->
    <div class="destinations-container">

        <div class="destinations-toolbar">

            <div>
                <span class="results-label">
                    OUR DESTINATIONS
                </span>

                <h2>
                    Places Worth Exploring
                </h2>
            </div>


            <!-- Search -->
            <form
                method="GET"
                action="{{ route('destinations.index') }}"
                class="destination-search"
            >

                <div class="search-input-wrapper">

                    <span class="search-icon">
                        ⌕
                    </span>

                    <input
                        type="text"
                        name="search"
                        value="{{ request('search') }}"
                        placeholder="Search destination..."
                    >

                </div>

                <button type="submit">
                    Search
                </button>

            </form>

        </div>


        @if($destinations->count())

            <div class="destinations-grid">

                @foreach($destinations as $destination)

                    <article class="destination-card">

                        <!-- Image -->
                        <div class="destination-image">

                            <img
                                src="{{ asset('assets/images/destinations/' . $destination->image) }}"
                                alt="{{ $destination->name }}"
                            >

                            <div class="destination-overlay"></div>

                            <span class="country-badge">
                                {{ $destination->country }}
                            </span>

                        </div>


                        <!-- Content -->
                        <div class="destination-card-content">

                            <div class="destination-title-row">

                                <h3>
                                    {{ $destination->name }}
                                </h3>

                                <span class="location-icon">
                                    ◉
                                </span>

                            </div>

                            <p>
                                {{ $destination->description }}
                            </p>


                            <a href="{{ route('destinations.packages', $destination) }}" class="destination-button">
                                Explore Packages
                                <span>→</span>
                            </a>

                        </div>

                    </article>

                @endforeach

            </div>

        @else

            <!-- No Results -->
            <div class="destination-empty">

                <div class="empty-icon">
                    ✈
                </div>

                <h3>
                    No destinations found
                </h3>

                <p>
                    We couldn't find a destination matching
                    your search.
                </p>

                <a href="{{ route('destinations.index') }}">
                    View All Destinations
                </a>

            </div>

        @endif

    </div>

</section>

@endsection