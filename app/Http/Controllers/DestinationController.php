<?php

namespace App\Http\Controllers;

use App\Models\Destination;
use Illuminate\Http\Request;

class DestinationController extends Controller
{
    public function index(Request $request)
    {
        $query = Destination::where('status', 1);

        if ($request->filled('search')) {
            $search = $request->search;

            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('country', 'like', "%{$search}%");
            });
        }

        $destinations = $query->latest()->get();

        return view('destinations.index', compact('destinations'));
    }

    public function packages(Destination $destination)
{
    $packages = $destination->packages()
        ->where('status', 1)
        ->get();

    return view('packages.destination', compact('destination', 'packages'));
}
}