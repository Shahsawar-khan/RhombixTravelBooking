<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Package;
use App\Models\Destination;
use Illuminate\Http\Request;

class PackageController extends Controller
{
    /**
     * Display all packages.
     */
    public function index()
    {
        $packages = Package::with('destination')
            ->latest()
            ->get();

        return view('admin.packages.index', compact('packages'));
    }

    /**
     * Show create package form.
     */
    public function create()
    {
        $destinations = Destination::where('status', 1)
            ->orderBy('name')
            ->get();

        return view('admin.packages.create', compact('destinations'));
    }

    /**
     * Store a new package.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'destination_id' => ['required', 'exists:destinations,id'],
            'title' => ['required', 'string', 'max:255'],
            'description' => ['required', 'string'],
            'duration' => ['required', 'string', 'max:100'],
            'price' => ['required', 'numeric', 'min:0'],
            'image' => ['nullable', 'string', 'max:255'],
            'status' => ['required', 'boolean'],
        ]);

        Package::create($validated);

        return redirect()
            ->route('admin.packages.index')
            ->with('success', 'Package added successfully.');
    }

    /**
     * Show edit package form.
     */
    public function edit(Package $package)
    {
        $destinations = Destination::where('status', 1)
            ->orderBy('name')
            ->get();

        return view(
            'admin.packages.edit',
            compact('package', 'destinations')
        );
    }

    /**
     * Update an existing package.
     */
    public function update(Request $request, Package $package)
    {
        $validated = $request->validate([
            'destination_id' => ['required', 'exists:destinations,id'],
            'title' => ['required', 'string', 'max:255'],
            'description' => ['required', 'string'],
            'duration' => ['required', 'string', 'max:100'],
            'price' => ['required', 'numeric', 'min:0'],
            'image' => ['nullable', 'string', 'max:255'],
            'status' => ['required', 'boolean'],
        ]);

        $package->update($validated);

        return redirect()
            ->route('admin.packages.index')
            ->with('success', 'Package updated successfully.');
    }

    /**
     * Delete a package.
     */
    public function destroy(Package $package)
    {
        $package->delete();

        return redirect()
            ->route('admin.packages.index')
            ->with('success', 'Package deleted successfully.');
    }
}