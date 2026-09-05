@extends('layouts.travel')

@section('content')
    <div class="section-container" style="padding-top: 40px; padding-bottom: 80px; max-width: 1200px; margin: 0 auto;">
        
        {{-- Search Header --}}
        <div class="section-heading">
            <span>LIVE FLIGHT SEARCH</span>
            <h2>Find & Track Flights</h2>
            <p>Enter IATA Airport Codes (e.g., DXB for Dubai, LHR for London, ISB for Islamabad) to search real-time flights.</p>
        </div>

        {{-- Flight Search Form --}}
        <div style="background: #ffffff; border: 1px solid #e8ecef; padding: 25px; border-radius: 14px; box-shadow: 0 10px 30px rgba(0,0,0,0.05); margin-bottom: 40px;">
            <form action="{{ route('flights.search') }}" method="GET" style="display: flex; gap: 15px; flex-wrap: wrap; align-items: flex-end;">
                
                <div style="flex: 1; min-width: 200px;">
                    <label style="display: block; font-size: 13px; font-weight: 600; margin-bottom: 6px; color: #172033;">Departure Airport (IATA)</label>
                    <input type="text" name="departure" value="{{ request('departure') }}" placeholder="e.g. DXB" style="width: 100%; padding: 12px; border: 1px solid #d1d5db; border-radius: 8px; font-size: 14px; text-transform: uppercase;" required>
                </div>

                <div style="flex: 1; min-width: 200px;">
                    <label style="display: block; font-size: 13px; font-weight: 600; margin-bottom: 6px; color: #172033;">Arrival Airport (IATA)</label>
                    <input type="text" name="arrival" value="{{ request('arrival') }}" placeholder="e.g. LHR" style="width: 100%; padding: 12px; border: 1px solid #d1d5db; border-radius: 8px; font-size: 14px; text-transform: uppercase;">
                </div>

                <div style="flex: 0 0 auto;">
                    <button type="submit" class="primary-btn" style="height: 45px; padding: 0 30px; background: #0f8b8d; color: #fff; border: none; border-radius: 8px; cursor: pointer;">
                        Search Flights
                    </button>
                </div>

            </form>
        </div>

        {{-- Error Alert --}}
        @if(session('error'))
            <div style="background: #fef2f2; border: 1px solid #fecaca; color: #dc2626; padding: 15px; border-radius: 8px; margin-bottom: 20px;">
                ⚠️ {{ session('error') }}
            </div>
        @endif

        {{-- Flight Results List --}}
        <div class="flight-results">
            @if(isset($flights) && count($flights) > 0)
                <h3 style="margin-bottom: 20px; font-size: 20px; color: #172033;">Real-time Search Results</h3>
                
                <div style="display: flex; flex-direction: column; gap: 18px;">
                    @foreach($flights as $flight)
                        <div style="background: #ffffff; border: 1px solid #e5e7eb; border-radius: 12px; padding: 22px; display: flex; justify-content: space-between; align-items: center; flex-wrap: wrap; gap: 15px; box-shadow: 0 4px 12px rgba(0,0,0,0.03);">
                            
                            <div>
                                <span style="display: inline-block; background: #eefafa; color: #0f8b8d; font-size: 12px; font-weight: 700; padding: 4px 10px; border-radius: 20px; margin-bottom: 8px;">
                                    {{ $flight['airline']['name'] ?? 'Airline' }} ({{ $flight['flight']['iata'] ?? 'N/A' }})
                                </span>

                                <h4 style="margin: 0 0 6px 0; font-size: 18px; color: #172033;">
                                    {{ $flight['departure']['airport'] ?? $flight['departure']['iata'] ?? 'N/A' }} ➔ {{ $flight['arrival']['airport'] ?? $flight['arrival']['iata'] ?? 'N/A' }}
                                </h4>

                                <p style="margin: 0; font-size: 13px; color: #6b7280;">
                                    <strong>Date:</strong> {{ $flight['flight_date'] ?? date('Y-m-d') }} | 
                                    <strong>Status:</strong> <span style="color: #0f8b8d; font-weight: 600; text-transform: capitalize;">{{ $flight['flight_status'] ?? 'Scheduled' }}</span>
                                </p>
                            </div>

                            <div>
                                <a href="{{ route('flights.show', ['flight' => $flight['flight']['iata'] ?? 'FLIGHT']) }}?dep={{ $flight['departure']['iata'] ?? '' }}&arr={{ $flight['arrival']['iata'] ?? '' }}&date={{ $flight['flight_date'] ?? date('Y-m-d') }}" class="primary-btn" style="padding: 10px 22px; font-size: 13px; text-decoration: none; background: #0f8b8d; color: #fff; border-radius: 8px; display: inline-block;">
                                    Select Flight
                                </a>
                            </div>

                        </div>
                    @endforeach
                </div>
            @elseif(request()->has('departure'))
                <div style="text-align: center; padding: 40px; background: #f9fafb; border-radius: 12px; color: #6b7280;">
                    <p style="margin: 0; font-size: 16px;">No live flights found for the given airport codes.</p>
                </div>
            @endif
        </div>

    </div>
@endsection