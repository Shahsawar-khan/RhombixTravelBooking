@extends('layouts.admin')

@section('title', 'Manage Packages | TravelEase')

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

                <h1>Manage Packages</h1>

                <p>
                    Create, update and manage your travel packages.
                </p>
            </div>

            <a
                href="{{ route('admin.packages.create') }}"
                class="admin-primary-btn"
            >
                + Add Package
            </a>

        </div>


        {{-- Success Message --}}
        @if(session('success'))

            <div class="admin-success-message">
                {{ session('success') }}
            </div>

        @endif


        {{-- Packages Section --}}
        <section class="admin-section">

            <div class="admin-section-header">

                <div>
                    <span>TRAVEL PACKAGES</span>

                    <h2>All Packages</h2>
                </div>

                <span class="admin-count-badge">
                    {{ $packages->count() }}
                    {{ $packages->count() == 1 ? 'Package' : 'Packages' }}
                </span>

            </div>


            @if($packages->count())

                <div class="admin-table-wrapper">

                    <table class="admin-table">

                        <thead>

                            <tr>

                                <th>Package</th>

                                <th>Destination</th>

                                <th>Duration</th>

                                <th>Price</th>

                                <th>Status</th>

                                <th>Actions</th>

                            </tr>

                        </thead>


                        <tbody>

                            @foreach($packages as $package)

                                <tr>

                                    {{-- Package --}}
                                    <td>

                                        <div class="admin-package-info">

                                            <div class="admin-package-image">

                                                @if($package->image)

                                                    <img
                                                        src="{{ asset('assets/images/packages/' . $package->image) }}"
                                                        alt="{{ $package->title }}"
                                                    >

                                                @else

                                                    <div class="admin-no-image">
                                                        ✈
                                                    </div>

                                                @endif

                                            </div>


                                            <div>

                                                <strong>
                                                    {{ $package->title }}
                                                </strong>

                                                <small>
                                                    ID #{{ $package->id }}
                                                </small>

                                            </div>

                                        </div>

                                    </td>


                                    {{-- Destination --}}
                                    <td>

                                        @if($package->destination)

                                            <span class="admin-destination-name">
                                                {{ $package->destination->name }}
                                            </span>

                                            <small class="admin-country">
                                                {{ $package->destination->country }}
                                            </small>

                                        @else

                                            <span class="admin-muted">
                                                No destination
                                            </span>

                                        @endif

                                    </td>


                                    {{-- Duration --}}
                                    <td>
                                        {{ $package->duration }}
                                    </td>


                                    {{-- Price --}}
                                    <td>

                                        <strong class="admin-price">
                                            ${{ number_format($package->price, 2) }}
                                        </strong>

                                    </td>


                                    {{-- Status --}}
                                    <td>

                                        @if($package->status)

                                            <span class="admin-status active">
                                                <span></span>
                                                Active
                                            </span>

                                        @else

                                            <span class="admin-status inactive">
                                                <span></span>
                                                Inactive
                                            </span>

                                        @endif

                                    </td>


                                    {{-- Actions --}}
                                    <td>

                                        <div class="admin-actions">

                                            <a
                                                href="{{ route('admin.packages.edit', $package) }}"
                                                class="admin-edit-btn"
                                            >
                                                Edit
                                            </a>


                                            <form
                                                method="POST"
                                                action="{{ route('admin.packages.destroy', $package) }}"
                                                onsubmit="return confirm('Are you sure you want to delete this package?');"
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

                                    </td>

                                </tr>

                            @endforeach

                        </tbody>

                    </table>

                </div>

            @else

                {{-- Empty State --}}
                <div class="admin-empty-state">

                    <div class="admin-empty-icon">
                        ✈
                    </div>

                    <h3>No Packages Found</h3>

                    <p>
                        You haven't added any travel packages yet.
                    </p>

                    <a
                        href="{{ route('admin.packages.create') }}"
                        class="admin-primary-btn"
                    >
                        + Add Your First Package
                    </a>

                </div>

            @endif

        </section>

    </div>

</div>

@endsection