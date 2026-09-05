<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\DestinationController;
use App\Http\Controllers\PackageController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\DestinationController as AdminDestinationController;
use App\Http\Controllers\Admin\PackageController as AdminPackageController;
use App\Http\Controllers\Admin\BookingController as AdminBookingController;
use App\Http\Controllers\FlightController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    $destinations = \App\Models\Destination::where('status', 1)
        ->latest()
        ->get();

    $packages = \App\Models\Package::with('destination')
        ->where('status', 1)
        ->latest()
        ->get();

    return view('home', compact('destinations', 'packages'));
})->name('home');

Route::get('/search', [PackageController::class, 'search'])
    ->name('packages.search');

Route::get('/destinations', [DestinationController::class, 'index'])
    ->name('destinations.index');

Route::get('/destinations/{destination}/packages', [
    DestinationController::class,
    'packages'
])->name('destinations.packages');

Route::get('/packages', [PackageController::class, 'index'])
    ->name('packages.index');

Route::get('/packages/{package}', [PackageController::class, 'show'])
    ->name('packages.show');


Route::middleware('auth')->group(function () {

    Route::get('/packages/{package}/book', [BookingController::class, 'create'])
        ->name('bookings.create');

    Route::post('/packages/{package}/book', [BookingController::class, 'store'])
        ->name('bookings.store');
    Route::get('/booking/{booking}/confirmation', [BookingController::class, 'confirmation'])
        ->name('bookings.confirmation');

});

Route::get('/dashboard', function () {
    $bookings = auth()->user()
        ->bookings()
        ->with(['package.destination', 'bookingTravelers'])
        ->latest()
        ->get();

    return view('dashboard', compact('bookings'));
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware(['auth', 'admin'])->group(function () {

    // Admin Dashboard
    Route::get('/admin', [DashboardController::class, 'index'])
        ->name('admin.dashboard');


    // Admin Destinations
    Route::get('/admin/destinations', [
        AdminDestinationController::class,
        'index'
    ])->name('admin.destinations.index');

    Route::get('/admin/destinations/create', [
        AdminDestinationController::class,
        'create'
    ])->name('admin.destinations.create');

    Route::post('/admin/destinations', [
        AdminDestinationController::class,
        'store'
    ])->name('admin.destinations.store');

    Route::get('/admin/destinations/{destination}/edit', [
        AdminDestinationController::class,
        'edit'
    ])->name('admin.destinations.edit');

    Route::put('/admin/destinations/{destination}', [
        AdminDestinationController::class,
        'update'
    ])->name('admin.destinations.update');

    Route::delete('/admin/destinations/{destination}', [
        AdminDestinationController::class,
        'destroy'
    ])->name('admin.destinations.destroy');


    // Admin Packages
    Route::get('/admin/packages', [
        AdminPackageController::class,
        'index'
    ])->name('admin.packages.index');

    Route::get('/admin/packages/create', [
        AdminPackageController::class,
        'create'
    ])->name('admin.packages.create');

    Route::post('/admin/packages', [
        AdminPackageController::class,
        'store'
    ])->name('admin.packages.store');

    Route::get('/admin/packages/{package}/edit', [
        AdminPackageController::class,
        'edit'
    ])->name('admin.packages.edit');

    Route::put('/admin/packages/{package}', [
        AdminPackageController::class,
        'update'
    ])->name('admin.packages.update');

    Route::delete('/admin/packages/{package}', [
        AdminPackageController::class,
        'destroy'
    ])->name('admin.packages.destroy');

    // Admin Bookings
    Route::get('/admin/bookings', [
        AdminBookingController::class,
        'index'
    ])->name('admin.bookings.index');

    Route::get('/admin/bookings/{booking}', [
        AdminBookingController::class,
        'show'
    ])->name('admin.bookings.show');

    Route::patch('/admin/bookings/{booking}/confirm', [
        AdminBookingController::class,
        'confirm'
    ])->name('admin.bookings.confirm');

    Route::patch('/admin/bookings/{booking}/reject', [
        AdminBookingController::class,
        'reject'
    ])->name('admin.bookings.reject');

});

// --- Flight Routes ---
Route::get('/flights/search', [FlightController::class, 'search'])->name('flights.search');
Route::get('/flights/{flight}', [FlightController::class, 'show'])->name('flights.show');
Route::get('/flights/{flight}/checkout', [FlightController::class, 'checkout'])->name('flights.checkout');
Route::post('/bookings/store-flight', [FlightController::class, 'storeFlightBooking'])->name('bookings.storeFlight');
Route::get('/bookings/{id}/success', [FlightController::class, 'bookingSuccess'])->name('bookings.success');

require __DIR__.'/auth.php';