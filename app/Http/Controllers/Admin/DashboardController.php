<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Destination;
use App\Models\Package;
use App\Models\Booking;

class DashboardController extends Controller
{
    public function index()
    {
        $stats = [
            'users' => User::where('is_admin', false)->count(),
            'destinations' => Destination::count(),
            'packages' => Package::count(),
            'bookings' => Booking::count(),
            'pending' => Booking::where('status', 'pending')->count(),
            'confirmed' => Booking::where('status', 'confirmed')->count(),
            'rejected' => Booking::where('status', 'rejected')->count(),
        ];

        return view('admin.dashboard', compact('stats'));
    }
}