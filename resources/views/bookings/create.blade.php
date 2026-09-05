@extends('layouts.travel')

@section('title', 'Book ' . $package->title . ' | TravelEase')

@section('content')

<section class="booking-page">

    <div class="booking-page-header">
        <div class="booking-header-content">
            <span>SECURE YOUR JOURNEY</span>
            <h1>Book Your Trip</h1>
            <p>Complete the form below to submit your booking request.</p>
        </div>
    </div>


    <div class="booking-container">

        @if ($errors->any())
            <div class="booking-errors">
                <strong>Please check the following:</strong>

                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif


        <div class="booking-layout">

            <!-- Booking Form -->

            <div class="booking-form-card">

                <div class="form-card-heading">
                    <span class="details-label">TRAVEL INFORMATION</span>

                    <h2>Tell Us About Your Trip</h2>

                    <p>
                        Provide your travel details and primary traveler information.
                    </p>
                </div>


                <form
                    method="POST"
                    action="{{ route('bookings.store', $package) }}"
                >

                    @csrf


                    <!-- Travel Details -->

                    <div class="form-section">

                        <h3>Trip Details</h3>

                        <div class="form-grid">

                            <div class="form-group">

                                <label for="travel_date">
                                    Travel Date
                                </label>

                                <input
                                    type="date"
                                    id="travel_date"
                                    name="travel_date"
                                    value="{{ old('travel_date') }}"
                                    min="{{ date('Y-m-d', strtotime('+1 day')) }}"
                                    required
                                >

                                @error('travel_date')
                                    <small class="field-error">{{ $message }}</small>
                                @enderror

                            </div>


                            <div class="form-group">

                                <label for="travelers">
                                    Number of Travelers
                                </label>

                                <input
                                    type="number"
                                    id="travelers"
                                    name="travelers"
                                    value="{{ old('travelers', 1) }}"
                                    min="1"
                                    max="20"
                                    required
                                >

                                @error('travelers')
                                    <small class="field-error">{{ $message }}</small>
                                @enderror

                            </div>

                        </div>

                    </div>


                    <!-- Traveler Details -->

                    <div class="form-section">

                        <h3>Primary Traveler</h3>

                        <div class="form-grid">

                            <div class="form-group">

                                <label for="first_name">
                                    First Name
                                </label>

                                <input
                                    type="text"
                                    id="first_name"
                                    name="first_name"
                                    value="{{ old('first_name') }}"
                                    placeholder="Enter first name"
                                    required
                                >

                            </div>


                            <div class="form-group">

                                <label for="last_name">
                                    Last Name
                                </label>

                                <input
                                    type="text"
                                    id="last_name"
                                    name="last_name"
                                    value="{{ old('last_name') }}"
                                    placeholder="Enter last name"
                                    required
                                >

                            </div>


                            <div class="form-group">

                                <label for="email">
                                    Email Address
                                </label>

                                <input
                                    type="email"
                                    id="email"
                                    name="email"
                                    value="{{ old('email', auth()->user()->email) }}"
                                    placeholder="Enter email address"
                                    required
                                >

                            </div>


                            <div class="form-group">

                                <label for="phone">
                                    Phone Number
                                </label>

                                <input
                                    type="text"
                                    id="phone"
                                    name="phone"
                                    value="{{ old('phone') }}"
                                    placeholder="03XX XXXXXXX"
                                    required
                                >

                            </div>


                            <div class="form-group form-full">

                                <label for="passport_number">
                                    Passport Number
                                </label>

                                <input
                                    type="text"
                                    id="passport_number"
                                    name="passport_number"
                                    value="{{ old('passport_number') }}"
                                    placeholder="Enter passport number"
                                    required
                                >

                            </div>

                        </div>

                    </div>


                    <button type="submit" class="confirm-booking-button">
                        Confirm Booking
                        <span>→</span>
                    </button>

                </form>

            </div>


            <!-- Package Summary -->

            <aside class="booking-summary-card">

                <div class="summary-image">

                    <img
                        src="{{ asset('assets/images/packages/' . $package->image) }}"
                        alt="{{ $package->title }}"
                    >

                </div>


                <div class="summary-content">

                    <span class="summary-label">
                        YOUR SELECTED PACKAGE
                    </span>

                    <h2>
                        {{ $package->title }}
                    </h2>

                    <p class="summary-location">
                        📍 {{ $package->destination->name }},
                        {{ $package->destination->country }}
                    </p>


                    <div class="summary-details">

                        <div>
                            <span>Duration</span>
                            <strong>{{ $package->duration }}</strong>
                        </div>

                        <div>
                            <span>Price / Person</span>
                            <strong>
                                ${{ number_format($package->price, 2) }}
                            </strong>
                        </div>

                    </div>


                    <div class="summary-total">

                        <span>Estimated Total</span>

                        <strong id="booking-total">
                            ${{ number_format($package->price, 2) }}
                        </strong>

                    </div>

                    <small class="summary-note">
                        Final confirmation will be provided after your booking request is reviewed.
                    </small>

                </div>

            </aside>

        </div>

    </div>

</section>

<script>
    document.addEventListener('DOMContentLoaded', function () {

        const travelersInput = document.getElementById('travelers');
        const totalElement = document.getElementById('booking-total');

        const pricePerPerson = {{ $package->price }};

        function updateTotal() {
            let travelers = parseInt(travelersInput.value) || 1;

            if (travelers < 1) {
                travelers = 1;
            }

            const total = pricePerPerson * travelers;

            totalElement.textContent =
                '$' + total.toLocaleString('en-US', {
                    minimumFractionDigits: 2,
                    maximumFractionDigits: 2
                });
        }

        travelersInput.addEventListener('input', updateTotal);

        updateTotal();
    });
</script>

@endsection