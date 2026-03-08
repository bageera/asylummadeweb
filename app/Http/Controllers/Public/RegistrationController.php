<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use App\Models\Event;
use App\Models\Team;
use App\Models\VehicleClass;
use App\Models\Registration;
use Illuminate\Http\Request;

class RegistrationController extends Controller
{
    /**
     * Display the registration form.
     */
    public function create()
    {
        $events = Event::whereIn('status', ['scheduled', 'registration_open'])
            ->where('event_date', '>=', now())
            ->orderBy('event_date')
            ->get();

        $teams = Team::where('is_active', true)->orderBy('name')->get();
        $classes = VehicleClass::orderBy('sort_order')->get();

        return view('pages.registration', compact('events', 'teams', 'classes'));
    }

    /**
     * Store a new registration.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'required|string|max:255',
            'date_of_birth' => 'required|date',
            'team_id' => 'nullable|exists:teams,id',
            'emergency_contact_name' => 'required|string|max:255',
            'emergency_contact_phone' => 'required|string|max:255',
            'event_id' => 'required|exists:events,id',
            'vehicle_class_id' => 'required|exists:vehicle_classes,id',
            'agree_rules' => 'required|accepted',
            'agree_waiver' => 'required|accepted',
            'agree_safety' => 'required|accepted',
        ]);

        // Check if event is open for registration
        $event = Event::findOrFail($validated['event_id']);
        if (!in_array($event->status, ['scheduled', 'registration_open'])) {
            return back()->withErrors(['event_id' => 'This event is not open for registration.']);
        }

        // Create registration
        $registration = Registration::create([
            'event_id' => $validated['event_id'],
            'vehicle_class_id' => $validated['vehicle_class_id'],
            'team_id' => $validated['team_id'] ?? null,
            'first_name' => $validated['first_name'],
            'last_name' => $validated['last_name'],
            'email' => $validated['email'],
            'phone' => $validated['phone'],
            'date_of_birth' => $validated['date_of_birth'],
            'emergency_contact_name' => $validated['emergency_contact_name'],
            'emergency_contact_phone' => $validated['emergency_contact_phone'],
            'status' => 'pending',
            'agreed_rules_at' => now(),
            'agreed_waiver_at' => now(),
            'agreed_safety_at' => now(),
        ]);

        return redirect()->route('registration.confirmation', $registration->id)
            ->with('success', 'Your registration has been submitted. You will receive a confirmation email shortly.');
    }

    /**
     * Display registration confirmation.
     */
    public function confirmation($id)
    {
        $registration = Registration::with(['event', 'vehicleClass', 'team'])->findOrFail($id);

        return view('pages.registration-confirmation', compact('registration'));
    }
}