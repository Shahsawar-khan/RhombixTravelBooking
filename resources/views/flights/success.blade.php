@extends('layouts.travel')

@section('content')
<div class="section-container" style="padding: 70px 20px; max-width: 600px; margin: 0 auto; text-align: center;">
    
    <div style="background: #ffffff; border: 1px solid #e5e7eb; border-radius: 16px; padding: 40px; box-shadow: 0 10px 30px rgba(0,0,0,0.05);">
        
        <div style="font-size: 50px; margin-bottom: 15px;">🎉</div>
        
        <h2 style="color: #0f8b8d; margin-bottom: 10px; font-size: 26px;">Flight Booking Confirmed!</h2>
        <p style="color: #6b7280; font-size: 15px; margin-bottom: 25px;">Your flight reservation has been saved to the database successfully.</p>

        {{-- Saved Database Booking Details --}}
        <div style="background: #f9fafb; border: 1px solid #f3f4f6; border-radius: 12px; padding: 20px; text-align: left; margin-bottom: 30px;">
            <p style="margin: 8px 0; font-size: 14px; color: #374151;"><strong>Booking ID:</strong> #{{ $booking->id }}</p>
            <p style="margin: 8px 0; font-size: 14px; color: #374151;"><strong>Travel Date:</strong> {{ $booking->travel_date }}</p>
            <p style="margin: 8px 0; font-size: 14px; color: #374151;"><strong>Travelers:</strong> {{ $booking->travelers }}</p>
            <p style="margin: 8px 0; font-size: 14px; color: #374151;"><strong>Total Price:</strong> ${{ number_format($booking->total_price, 2) }}</p>
            <p style="margin: 8px 0; font-size: 14px; color: #374151;"><strong>Status:</strong> <span style="color: #0f8b8d; font-weight: 700; text-transform: capitalize;">{{ $booking->status }}</span></p>
        </div>

        <div style="display: flex; gap: 15px; justify-content: center; flex-wrap: wrap;">
            <a href="{{ route('dashboard') }}" class="secondary-btn" style="text-decoration: none; padding: 12px 24px; border: 1px solid #d1d5db; border-radius: 8px; color: #374151; font-weight: 600; display: inline-block;">
                Go to Dashboard
            </a>

            <a href="{{ route('flights.search') }}" class="primary-btn" style="text-decoration: none; padding: 12px 24px; background: #0f8b8d; color: #fff; border-radius: 8px; font-weight: 600; display: inline-block;">
                Search More Flights
            </a>
        </div>

    </div>

</div>
@endsection