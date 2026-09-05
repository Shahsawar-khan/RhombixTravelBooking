@extends('layouts.travel')

@section('content')
<div class="section-container" style="padding: 60px 20px; max-width: 600px; margin: 0 auto;">
    
    <div style="background: #ffffff; border: 1px solid #e5e7eb; border-radius: 16px; padding: 35px; box-shadow: 0 10px 30px rgba(0,0,0,0.05);">
        
        <h3 style="color: #172033; margin-bottom: 8px; font-size: 22px;">Confirm Flight Booking</h3>
        <p style="color: #6b7280; font-size: 14px; margin-bottom: 25px;">Review your flight information and proceed to complete your booking.</p>

        {{-- Selected Flight Summary --}}
        <div style="background: #f9fafb; border: 1px solid #f3f4f6; padding: 18px; border-radius: 10px; margin-bottom: 25px; font-size: 14px;">
            <p style="margin: 4px 0; color: #374151;"><strong>Flight Number:</strong> {{ $flightDetails['flight_number'] }}</p>
            <p style="margin: 4px 0; color: #374151;"><strong>Route:</strong> {{ $flightDetails['departure'] ?? 'N/A' }} ➔ {{ $flightDetails['arrival'] ?? 'N/A' }}</p>
            <p style="margin: 4px 0; color: #374151;"><strong>Travel Date:</strong> {{ $flightDetails['date'] ?? date('Y-m-d') }}</p>
            <p style="margin: 4px 0; color: #374151;"><strong>Price:</strong> $500.00</p>
        </div>

        {{-- Booking Form --}}
        <form action="{{ route('bookings.storeFlight') }}" method="POST">
            @csrf
            
            <input type="hidden" name="flight_date" value="{{ $flightDetails['date'] ?? date('Y-m-d') }}">
            <input type="hidden" name="price" value="500.00">

            <div style="margin-bottom: 20px;">
                <label style="display: block; font-size: 14px; font-weight: 600; margin-bottom: 8px; color: #172033;">Number of Passengers / Travelers</label>
                <input type="number" name="travelers" value="1" min="1" max="10" required style="width: 100%; padding: 12px; border: 1px solid #d1d5db; border-radius: 8px; font-size: 14px;">
            </div>

            <div style="display: flex; gap: 12px; margin-top: 30px;">
                <a href="{{ route('flights.show', ['flight' => $flightDetails['flight_number']]) }}?dep={{ $flightDetails['departure'] }}&arr={{ $flightDetails['arrival'] }}&date={{ $flightDetails['date'] }}" class="secondary-btn" style="text-decoration: none; padding: 12px 20px; border: 1px solid #d1d5db; border-radius: 8px; color: #374151; font-weight: 600; display: inline-block; text-align: center;">
                    Back
                </a>

                <button type="submit" class="primary-btn" style="flex: 1; padding: 12px; background: #0f8b8d; color: #fff; border: none; border-radius: 8px; font-size: 15px; font-weight: 600; cursor: pointer;">
                    Confirm & Save Booking
                </button>
            </div>
        </form>

    </div>

</div>
@endsection