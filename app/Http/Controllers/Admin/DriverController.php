<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Driver;
use App\Models\Team;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class DriverController extends Controller
{
    /**
     * Display a listing of drivers.
     */
    public function index()
    {
        $drivers = Driver::with(['team', 'user'])
            ->alphabetical()
            ->paginate(20);

        return view('admin.drivers.index', compact('drivers'));
    }

    /**
     * Show the form for creating a new driver.
     */
    public function create()
    {
        $teams = Team::active()->orderBy('name')->get();
        $users = User::where('role', 'driver')->orderBy('name')->get();

        return view('admin.drivers.create', compact('teams', 'users'));
    }

    /**
     * Store a newly created driver.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'user_id' => 'nullable|exists:users,id',
            'team_id' => 'required|exists:teams,id',
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'nickname' => 'nullable|string|max:255',
            'hometown' => 'nullable|string|max:255',
            'license_number' => 'nullable|string|max:255',
            'license_expires' => 'nullable|date',
            'medical_expires' => 'nullable|date',
            'bio' => 'nullable|string',
            'profile_photo' => 'nullable|image|max:2048',
            'is_active' => 'boolean',
        ]);

        if ($request->hasFile('profile_photo')) {
            $validated['profile_photo_path'] = $request->file('profile_photo')->store('drivers', 'public');
        }

        $driver = Driver::create($validated);

        return redirect()->route('admin.drivers.index')
            ->with('success', "Driver \"{$driver->full_name}\" created successfully.");
    }

    /**
     * Display the specified driver.
     */
    public function show(Driver $driver)
    {
        $driver->load(['team', 'user', 'registrations.event', 'results.event']);

        return view('admin.drivers.show', compact('driver'));
    }

    /**
     * Show the form for editing the driver.
     */
    public function edit(Driver $driver)
    {
        $teams = Team::active()->orderBy('name')->get();
        $users = User::where('role', 'driver')->orderBy('name')->get();

        return view('admin.drivers.edit', compact('driver', 'teams', 'users'));
    }

    /**
     * Update the specified driver.
     */
    public function update(Request $request, Driver $driver)
    {
        $validated = $request->validate([
            'user_id' => 'nullable|exists:users,id',
            'team_id' => 'required|exists:teams,id',
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'nickname' => 'nullable|string|max:255',
            'hometown' => 'nullable|string|max:255',
            'license_number' => 'nullable|string|max:255',
            'license_expires' => 'nullable|date',
            'medical_expires' => 'nullable|date',
            'bio' => 'nullable|string',
            'profile_photo' => 'nullable|image|max:2048',
            'is_active' => 'boolean',
        ]);

        if ($request->hasFile('profile_photo')) {
            $validated['profile_photo_path'] = $request->file('profile_photo')->store('drivers', 'public');
        }

        $driver->update($validated);

        return redirect()->route('admin.drivers.index')
            ->with('success', "Driver \"{$driver->full_name}\" updated successfully.");
    }

    /**
     * Remove the specified driver.
     */
    public function destroy(Driver $driver)
    {
        $name = $driver->full_name;
        $driver->delete();

        return redirect()->route('admin.drivers.index')
            ->with('success', "Driver \"{$name}\" deleted successfully.");
    }
}