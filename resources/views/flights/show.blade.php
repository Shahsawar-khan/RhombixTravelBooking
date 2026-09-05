@extends('layouts.travel')

@section('content')
<div class="section-container" style="padding: 60px 20px; max-width: 800px; margin: 0 auto;">
    
    <div style="background: #fff; border: 1px solid #e5e7eb; border-radius: 16px; padding: 35px; box-shadow: 0 10px 25px rgba(0,0,0,0.05);">
        <span style="background: #eefafa; color: #0f8b8d; font-weight: 700; padding: 6px 14px; border-radius: 20px; font-size: 13px;">
            SELECTED FLIGHT
        </span>

        <h2 style="margin-top: 15px; color: #172033;">
            Flight Details: {{ $flightDetails['flight_number'] }}
        </h2>

        <div style="display: flex; justify-content: space-between; align-items: center; margin: 30px 0; padding: 20px; background: #f9fafb; border-radius: 12px;">
            <div>
                <small style="color: #6b7280; display: block;">From</small>
                <strong style="font-size: 20px; color: #172033;">{{ $flightDetails['departure'] ?? 'N/A' }}</strong>
            </div>

            <div style="font-size: 24px;">✈️</div>

            <div>
                <small style="color: #6b7280; display: block;">To</small>
                <strong style="font-size: 20px; color: #172033;">{{ $flightDetails['arrival'] ?? 'N/A' }}</strong>
            </div>

            <div>
                <small style="color: #6b7280; display: block;">Date</small>
                <strong style="font-size: 16px; color: #172033;">{{ $flightDetails['date'] ?? date('Y-m-d') }}</strong>
            </div>
        </div>

        <div style="display: flex; gap: 15px; flex-wrap: wrap;">
            <a href="{{ route('flights.search') }}?departure={{ $flightDetails['departure'] }}&arrival={{ $flightDetails['arrival'] }}" class="secondary-btn" style="text-decoration: none; padding: 12px 24px; border: 1px solid #d1d5db; border-radius: 8px; color: #374151; display: inline-block;">
                ← Back to Search
            </a>

            <a href="{{ route('flights.checkout', ['flight' => $flightDetails['flight_number']]) }}?dep={{ $flightDetails['departure'] }}&arr={{ $flightDetails['arrival'] }}&date={{ $flightDetails['date'] }}" class="primary-btn" style="padding: 12px 30px; background: #0f8b8d; color: #fff; border-radius: 8px; text-decoration: none; display: inline-block; font-weight: 600;">
                Confirm & Book Flight
            </a>
        </div>
    </div>

</div>
@endsection