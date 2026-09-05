@extends('layouts.travel')

@section('title', 'Search Results | TravelEase')

@section('content')

<section class="packages-page">

    <div class="packages-hero">

        <div class="packages-hero-content">

            <span class="packages-eyebrow">
                SEARCH RESULTS
            </span>

            <h1>
                Packages for
                <span>{{ $destination->name }}</span>
            </h1>

            <p>
                Explore available travel packages for your selected destination.
            </p>

            <div class="search-summary">

    <div class="search-summary-item">
        <span>TRAVEL DATE</span>

        <strong>
            {{ \Carbon\Carbon::parse($travelDate)->format('d M Y') }}
        </strong>
    </div>

    <div class="search-summary-divider"></div>

    <div class="search-summary-item">
        <span>TRAVELERS</span>

        <strong>
            {{ $travelers }}
            {{ $travelers == 1 ? 'Person' : 'People' }}
        </strong>
    </div>

</div>

        </div>

    </div>


    <div class="packages-container">

        <div class="packages-heading">

            <div>
                <span class="packages-label">
                    AVAILABLE PACKAGES
                </span>

                <h2>
                    {{ $packages->count() }} Packages Found
                </h2>
            </div>

            <a href="{{ route('destinations.index') }}"
               class="back-destinations">
                ← All Destinations
            </a>

        </div>

        <div class="search-summary">
    <div>
        <span>TRAVEL DATE</span>
        <strong>
            {{ \Carbon\Carbon::parse($travelDate)->format('d M Y') }}
        </strong>
    </div>

    <div>
        <span>TRAVELERS</span>
        <strong>
            {{ $travelers }}
            {{ $travelers == 1 ? 'Person' : 'People' }}
        </strong>
    </div>
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
                    There are currently no packages available
                    for {{ $destination->name }}.
                </p>

                <a href="{{ route('destinations.index') }}">
                    Explore Other Destinations
                </a>

            </div>

        @endif

    </div>

</section>

@endsection