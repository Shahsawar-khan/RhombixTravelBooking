<?php

namespace App\Http\Controllers;

use App\Models\Package;
use Illuminate\Http\Request;

class PackageController extends Controller
{
    public function show(Package $package)
    {
        $package->load('destination');

        return view('packages.show', compact('package'));
    }
    public function index()
{
    $packages = \App\Models\Package::with('destination')
        ->where('status', 1)
        ->latest()
        ->get();

    return view('packages.index', compact('packages'));
}

public function search(Request $request)
{
    $request->validate([
        'destination_id' => ['required', 'exists:destinations,id'],
        'travel_date' => ['required', 'date', 'after:today'],
        'travelers' => ['required', 'integer', 'min:1', 'max:20'],
    ]);

    $packages = Package::with('destination')
        ->where('destination_id', $request->destination_id)
        ->where('status', 1)
        ->latest()
        ->get();

    $destination = \App\Models\Destination::findOrFail(
        $request->destination_id
    );

    return view('packages.search', [
    'packages' => $packages,
    'destination' => $destination,
    'travelDate' => $request->travel_date,
    'travelers' => $request->travelers,
]);
}
}