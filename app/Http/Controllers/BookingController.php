<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Package;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class BookingController extends Controller
{
    public function create(Package $package)
    {
        return view('bookings.create', compact('package'));
    }

    public function store(Request $request, Package $package)
{
    $validated = $request->validate([
        'travel_date' => ['required', 'date', 'after:today'],
        'travelers' => ['required', 'integer', 'min:1', 'max:20'],

        'first_name' => ['required', 'string', 'max:100'],
        'last_name' => ['required', 'string', 'max:100'],
        'email' => ['required', 'email', 'max:255'],
        'phone' => ['required', 'string', 'max:30'],
        'passport_number' => ['required', 'string', 'max:50'],
    ]);

    $booking = DB::transaction(function () use ($validated, $package, $request) {

        $totalPrice = $package->price * $validated['travelers'];

        $booking = Booking::create([
            'user_id' => $request->user()->id,
            'package_id' => $package->id,
            'travel_date' => $validated['travel_date'],
            'travelers' => $validated['travelers'],
            'total_price' => $totalPrice,
            'status' => 'pending',
        ]);

        $booking->bookingTravelers()->create([
            'first_name' => $validated['first_name'],
            'last_name' => $validated['last_name'],
            'email' => $validated['email'],
            'phone' => $validated['phone'],
            'passport_number' => $validated['passport_number'],
        ]);

        return $booking;
    });

    return redirect()->route('bookings.confirmation', $booking->id);
}
public function confirmation(Booking $booking)
{
    abort_unless($booking->user_id === auth()->id(), 403);

    $booking->load([
    'package.destination',
    'bookingTravelers',
]);

    return view('bookings.confirmation', compact('booking'));
}
}