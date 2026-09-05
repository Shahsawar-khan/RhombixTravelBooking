<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\AviationstackService;
use App\Models\Booking;
use Illuminate\Support\Facades\Auth;

class FlightController extends Controller
{
    protected $aviationService;

    public function __construct(AviationstackService $aviationService)
    {
        $this->aviationService = $aviationService;
    }

    public function search(Request $request)
    {
        $depIata = trim($request->input('departure')); // e.g. DXB
        $arrIata = trim($request->input('arrival'));   // e.g. LHR

        // Agar user ne bina search inputs ke directly page khola hai
        if (!$depIata && !$arrIata) {
            return view('flights.search', ['flights' => []]);
        }

        $result = $this->aviationService->searchFlights($depIata, $arrIata);

        if (!$result['success']) {
            return back()->with('error', $result['message']);
        }

        // View name fixed to 'flights.search'
        return view('flights.search', [
            'flights' => $result['data'],
        ]);
    }

    public function show(Request $request, $flightIata)
    {
        $flightDetails = [
            'flight_number' => $flightIata,
            'departure'     => $request->query('dep'),
            'arrival'       => $request->query('arr'),
            'date'          => $request->query('date'),
        ];

        return view('flights.show', compact('flightDetails'));
    }

    // Checkout Form View
    public function checkout(Request $request, $flightIata)
    {
        $flightDetails = [
            'flight_number' => $flightIata,
            'departure'     => $request->query('dep'),
            'arrival'       => $request->query('arr'),
            'date'          => $request->query('date'),
        ];

        return view('flights.checkout', compact('flightDetails'));
    }

    // Existing 'bookings' Table Mein Live Flight Save Karna
    public function storeFlightBooking(Request $request)
    {
        $request->validate([
            'flight_date' => 'required|date',
            'travelers'   => 'required|numeric|min:1',
        ]);

        $booking = new Booking();
        $booking->user_id     = Auth::id() ?? 3; // Logged-in user ki ID
        $booking->package_id  = null;           // API flight booking ke liye null rahega
        $booking->travel_date = $request->input('flight_date');
        $booking->travelers   = $request->input('travelers', 1);
        $booking->total_price = $request->input('price', 500.00); 
        $booking->status      = 'pending';
        
        $booking->save();

        return redirect()->route('bookings.success', $booking->id);
    }

    // Booking Success Screen
    public function bookingSuccess($id)
    {
        $booking = Booking::findOrFail($id);
        return view('flights.success', compact('booking'));
    }
}