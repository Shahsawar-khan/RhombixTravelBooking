@extends('layouts.travel')

@section('title', 'All Travel Packages | TravelEase')

@section('content')

<section class="packages-page">

    <div class="packages-hero">

        <div class="packages-hero-content">

            <span class="packages-eyebrow">
                EXPLORE OUR PACKAGES
            </span>

            <h1>
                Find Your Perfect
                <span>Travel Package</span>
            </h1>

            <p>
                Explore our carefully selected travel packages
                and choose your next unforgettable journey.
            </p>

        </div>

    </div>


    <div class="packages-container">

        <div class="packages-heading">

            <div>
                <span class="packages-label">
                    ALL PACKAGES
                </span>

                <h2>
                    Choose Your Perfect Trip
                </h2>
            </div>

            <a href="{{ route('destinations.index') }}" class="back-destinations">
                ← All Destinations
            </a>

        </div>


        @if($packages->count())

            <div class="packages-grid">

                @foreach($packages as $package)

                    <article class="package-card">

                        <div class="package-image">

                            <img
                                src="{{ asset('assets/images/packages/' . $package->image) }}"
                                alt="{{ $package->title }}"
                            >

                            <span class="package-duration">
                                {{ $package->duration }}
                            </span>

                        </div>


                        <div class="package-content">

                            <span class="package-destination">
                                {{ $package->destination->name }}
                            </span>

                            <h3>
                                {{ $package->title }}
                            </h3>

                            <p>
                                {{ $package->description }}
                            </p>


                            <div class="package-bottom">

                                <div class="package-price">

                                    <small>
                                        Starting from
                                    </small>

                                    <strong>
                                        ${{ number_format($package->price, 2) }}
                                    </strong>

                                </div>


                                <a
                                    href="{{ route('packages.show', $package) }}"
                                    class="package-button"
                                >
                                    View Details →
                                </a>

                            </div>

                        </div>

                    </article>

                @endforeach

            </div>

        @else

            <div class="packages-empty">

                <div class="empty-package-icon">
                    ✈
                </div>

                <h3>
                    No packages available
                </h3>

                <p>
                    There are currently no travel packages available.
                </p>

                <a href="{{ route('destinations.index') }}">
                    Explore Destinations
                </a>

            </div>

        @endif

    </div>

</section>

@endsection