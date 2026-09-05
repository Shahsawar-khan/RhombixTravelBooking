<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Booking;

class BookingController extends Controller
{
    /**
     * Display all bookings.
     */
    public function index()
    {
        $bookings = Booking::with([
            'user',
            'package.destination',
            'bookingTravelers',
        ])
            ->latest()
            ->get();

        return view('admin.bookings.index', compact('bookings'));
    }

    /**
     * Display booking details.
     */
    public function show(Booking $booking)
    {
        $booking->load([
            'user',
            'package.destination',
            'bookingTravelers',
        ]);

        return view('admin.bookings.show', compact('booking'));
    }

    /**
     * Confirm a pending booking.
     */
    public function confirm(Booking $booking)
    {
        $booking->update([
            'status' => 'confirmed',
        ]);

        return redirect()
            ->route('admin.bookings.index')
            ->with('success', 'Booking confirmed successfully.');
    }

    /**
     * Reject a pending booking.
     */
    public function reject(Booking $booking)
    {
        $booking->update([
            'status' => 'rejected',
        ]);

        return redirect()
            ->route('admin.bookings.index')
            ->with('success', 'Booking rejected successfully.');
    }
}