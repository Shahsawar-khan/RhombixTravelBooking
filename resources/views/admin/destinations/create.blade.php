@extends('layouts.admin')
@section('title', 'Add Destination | TravelEase')

@push('styles')
    @vite(['resources/css/admin.css'])
@endpush

@section('content')

<div class="admin-page">

    <div class="admin-container">

        <div class="admin-header">

            <div>
                <span class="admin-eyebrow">TRAVELEASE ADMIN</span>

                <h1>Add Destination</h1>

                <p>
                    Add a new destination to your travel platform.
                </p>
            </div>

            <a
                href="{{ route('admin.destinations.index') }}"
                class="admin-view-site"
            >
                ← All Destinations
            </a>

        </div>


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


        <section class="admin-section">

            <div class="admin-section-header">

                <span>DESTINATION INFORMATION</span>

                <h2>Create New Destination</h2>

            </div>


            <form
                method="POST"
                action="{{ route('admin.destinations.store') }}"
                class="admin-form"
            >

                @csrf


                <div class="admin-form-grid">

                    {{-- Name --}}
                    <div class="admin-form-group">

                        <label for="name">
                            Destination Name
                        </label>

                        <input
                            type="text"
                            id="name"
                            name="name"
                            value="{{ old('name') }}"
                            placeholder="e.g. Dubai"
                            required
                        >

                    </div>


                    {{-- Country --}}
                    <div class="admin-form-group">

                        <label for="country">
                            Country
                        </label>

                        <input
                            type="text"
                            id="country"
                            name="country"
                            value="{{ old('country') }}"
                            placeholder="e.g. United Arab Emirates"
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
                            value="{{ old('image') }}"
                            placeholder="e.g. dubai.jpg"
                        >

                        <small>
                            Enter the image filename from
                            <strong>public/assets/images/destinations</strong>.
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

                            <option value="1"
                                {{ old('status', '1') == '1' ? 'selected' : '' }}>
                                Active
                            </option>

                            <option value="0"
                                {{ old('status') === '0' ? 'selected' : '' }}>
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
                            rows="6"
                            placeholder="Write a short description about this destination..."
                        >{{ old('description') }}</textarea>

                    </div>

                </div>


                <div class="admin-form-actions">

                    <a
                        href="{{ route('admin.destinations.index') }}"
                        class="admin-cancel-btn"
                    >
                        Cancel
                    </a>

                    <button
                        type="submit"
                        class="admin-submit-btn"
                    >
                        Add Destination →
                    </button>

                </div>

            </form>

        </section>

    </div>

</div>

@endsection