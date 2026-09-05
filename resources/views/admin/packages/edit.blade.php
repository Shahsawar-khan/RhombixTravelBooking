@extends('layouts.admin')

@section('title', 'Edit Package | TravelEase')

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

                <h1>Edit Package</h1>

                <p>
                    Update the information for {{ $package->title }}.
                </p>
            </div>

            <a
                href="{{ route('admin.packages.index') }}"
                class="admin-view-site"
            >
                ← All Packages
            </a>

        </div>


        {{-- Validation Errors --}}
        @if ($errors->any())

            <div class="admin-error-message">

                <strong>Please fix the following errors:</strong>

                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>

            </div>

        @endif


        {{-- Edit Form --}}
        <section class="admin-section">

            <div class="admin-section-header">

                <div>

                    <span>PACKAGE INFORMATION</span>

                    <h2>Update Travel Package</h2>

                </div>

            </div>


            <form
                method="POST"
                action="{{ route('admin.packages.update', $package) }}"
                class="admin-form"
            >

                @csrf

                @method('PUT')


                <div class="admin-form-grid">

                    {{-- Destination --}}
                    <div class="admin-form-group">

                        <label for="destination_id">
                            Destination
                        </label>

                        <select
                            id="destination_id"
                            name="destination_id"
                            required
                        >

                            <option value="">
                                Select destination
                            </option>

                            @foreach($destinations as $destination)

                                <option
                                    value="{{ $destination->id }}"
                                    {{ old('destination_id', $package->destination_id) == $destination->id ? 'selected' : '' }}
                                >
                                    {{ $destination->name }}
                                    — {{ $destination->country }}
                                </option>

                            @endforeach

                        </select>

                    </div>


                    {{-- Title --}}
                    <div class="admin-form-group">

                        <label for="title">
                            Package Title
                        </label>

                        <input
                            type="text"
                            id="title"
                            name="title"
                            value="{{ old('title', $package->title) }}"
                            placeholder="e.g. Dubai Luxury Escape"
                            required
                        >

                    </div>


                    {{-- Duration --}}
                    <div class="admin-form-group">

                        <label for="duration">
                            Duration
                        </label>

                        <input
                            type="text"
                            id="duration"
                            name="duration"
                            value="{{ old('duration', $package->duration) }}"
                            placeholder="e.g. 5 Days / 4 Nights"
                            required
                        >

                    </div>


                    {{-- Price --}}
                    <div class="admin-form-group">

                        <label for="price">
                            Price Per Person
                        </label>

                        <input
                            type="number"
                            id="price"
                            name="price"
                            value="{{ old('price', $package->price) }}"
                            placeholder="e.g. 899"
                            min="0"
                            step="0.01"
                            required
                        >

                    </div>


                    {{-- Image --}}
                    <div class="admin-form-group">

                        <label for="image">
                            Image File Name
                        </label>

                        <input
                            type="text"
                            id="image"
                            name="image"
                            value="{{ old('image', $package->image) }}"
                            placeholder="e.g. dubai-package.jpg"
                        >

                        <small>
                            Use an image filename from
                            <strong>public/assets/images/packages</strong>.
                        </small>

                    </div>


                    {{-- Status --}}
                    <div class="admin-form-group">

                        <label for="status">
                            Status
                        </label>

                        <select
                            id="status"
                            name="status"
                            required
                        >

                            <option
                                value="1"
                                {{ old('status', $package->status) == 1 ? 'selected' : '' }}
                            >
                                Active
                            </option>

                            <option
                                value="0"
                                {{ old('status', $package->status) == 0 ? 'selected' : '' }}
                            >
                                Inactive
                            </option>

                        </select>

                    </div>


                    {{-- Description --}}
                    <div class="admin-form-group admin-form-full">

                        <label for="description">
                            Description
                        </label>

                        <textarea
                            id="description"
                            name="description"
                            rows="7"
                            placeholder="Write a detailed description about this travel package..."
                            required
                        >{{ old('description', $package->description) }}</textarea>

                    </div>

                </div>


                {{-- Actions --}}
                <div class="admin-form-actions">

                    <a
                        href="{{ route('admin.packages.index') }}"
                        class="admin-cancel-btn"
                    >
                        Cancel
                    </a>

                    <button
                        type="submit"
                        class="admin-submit-btn"
                    >
                        Update Package →
                    </button>

                </div>

            </form>

        </section>

    </div>

</div>

@endsection