<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Registration;
use App\Models\Event;
use App\Models\VehicleClass;
use App\Models\Driver;
use App\Models\Team;
use Illuminate\Http\Request;

class RegistrationController extends Controller
{
    /**
     * Display a listing of registrations.
     */
    public function index(Request $request)
    {
        $query = Registration::with(['event', 'vehicleClass', 'driver', 'team']);

        // Filter by event
        if ($request->filled('event_id')) {
            $query->where('event_id', $request->event_id);
        }

        // Filter by status
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        // Filter by search
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('first_name', 'like', "%{$search}%")
                  ->orWhere('last_name', 'like', "%{$search}%")
                  ->orWhere('email', 'like', "%{$search}%")
                  ->orWhereHas('driver', function ($dq) use ($search) {
                      $dq->where('first_name', 'like', "%{$search}%")
                         ->orWhere('last_name', 'like', "%{$search}%");
                  });
            });
        }

        $registrations = $query->orderBy('created_at', 'desc')->paginate(25);
        $events = Event::orderBy('event_date', 'desc')->get();

        return view('admin.registrations.index', compact('registrations', 'events'));
    }

    /**
     * Display registrations for a specific event.
     */
    public function event(Event $event)
    {
        $registrations = Registration::with(['driver', 'vehicleClass', 'team'])
            ->where('event_id', $event->id)
            ->orderBy('car_number')
            ->paginate(50);

        return view('admin.registrations.event', compact('event', 'registrations'));
    }

    /**
     * Show the form for editing a registration.
     */
    public function edit(Registration $registration)
    {
        $events = Event::whereIn('status', ['scheduled', 'registration_open', 'completed'])->get();
        $classes = VehicleClass::orderBy('sort_order')->get();
        $teams = Team::where('is_active', true)->orderBy('name')->get();
        $drivers = Driver::with('team')->active()->alphabetical()->get();

        return view('admin.registrations.edit', compact('registration', 'events', 'classes', 'teams', 'drivers'));
    }

    /**
     * Update the registration.
     */
    public function update(Request $request, Registration $registration)
    {
        $validated = $request->validate([
            'driver_id' => 'nullable|exists:drivers,id',
            'team_id' => 'nullable|exists:teams,id',
            'event_id' => 'required|exists:events,id',
            'vehicle_class_id' => 'required|exists:vehicle_classes,id',
            'car_number' => 'required|integer|min:1|max:999',
            'car_make' => 'nullable|string|max:50',
            'car_model' => 'nullable|string|max:50',
            'car_year' => 'nullable|integer|min:1900|max:' . (date('Y') + 1),
            'car_color' => 'nullable|string|max:30',
            'transponder_id' => 'nullable|string|max:50',
            'status' => 'required|in:pending,registered,checked_in,withdrawn,no_show',
            'paid' => 'boolean',
            'payment_method' => 'nullable|string|max:20',
            'payment_reference' => 'nullable|string|max:100',
            'notes' => 'nullable|string',
        ]);

        $registration->update($validated);

        return redirect()->route('admin.registrations.index')
            ->with('success', 'Registration updated successfully.');
    }

    /**
     * Approve a pending registration.
     */
    public function approve(Registration $registration)
    {
        if ($registration->status !== 'pending') {
            return back()->with('error', 'Only pending registrations can be approved.');
        }

        $registration->update(['status' => 'registered']);

        return back()->with('success', 'Registration approved.');
    }

    /**
     * Mark registration as checked in.
     */
    public function checkIn(Registration $registration)
    {
        if (!in_array($registration->status, ['registered'])) {
            return back()->with('error', 'Only registered participants can check in.');
        }

        $registration->update([
            'status' => 'checked_in',
            'checked_in' => true,
            'check_in_time' => now(),
        ]);

        return back()->with('success', 'Participant checked in.');
    }

    /**
     * Mark registration as withdrawn.
     */
    public function withdraw(Request $request, Registration $registration)
    {
        if (!in_array($registration->status, ['pending', 'registered'])) {
            return back()->with('error', 'Cannot withdraw this registration.');
        }

        $validated = $request->validate([
            'withdrawal_reason' => 'nullable|string|max:500',
        ]);

        $registration->update([
            'status' => 'withdrawn',
            'withdrawal_reason' => $validated['withdrawal_reason'] ?? null,
        ]);

        return back()->with('success', 'Registration withdrawn.');
    }

    /**
     * Mark registration as paid.
     */
    public function markPaid(Request $request, Registration $registration)
    {
        $validated = $request->validate([
            'payment_method' => 'required|string|max:20',
            'payment_reference' => 'nullable|string|max:100',
        ]);

        $registration->update([
            'paid' => true,
            'payment_method' => $validated['payment_method'],
            'payment_reference' => $validated['payment_reference'] ?? null,
        ]);

        return back()->with('success', 'Registration marked as paid.');
    }

    /**
     * Assign car number.
     */
    public function assignCarNumber(Request $request, Registration $registration)
    {
        $validated = $request->validate([
            'car_number' => 'required|integer|min:1|max:999',
        ]);

        // Check if number is already taken for this event
        $exists = Registration::where('event_id', $registration->event_id)
            ->where('id', '!=', $registration->id)
            ->where('car_number', $validated['car_number'])
            ->exists();

        if ($exists) {
            return back()->with('error', "Car #{$validated['car_number']} is already assigned for this event.");
        }

        $registration->update(['car_number' => $validated['car_number']]);

        return back()->with('success', "Car #{$validated['car_number']} assigned.");
    }

    /**
     * Remove the registration.
     */
    public function destroy(Registration $registration)
    {
        $registration->delete();

        return redirect()->route('admin.registrations.index')
            ->with('success', 'Registration deleted.');
    }

    /**
     * Export registrations for an event.
     */
    public function export(Event $event)
    {
        $registrations = Registration::with(['driver', 'vehicleClass', 'team'])
            ->where('event_id', $event->id)
            ->orderBy('car_number')
            ->get();

        $headers = [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => "attachment; filename=\"{$event->slug}-registrations.csv\"",
        ];

        $callback = function () use ($registrations) {
            $handle = fopen('php://output', 'w');

            // Header row
            fputcsv($handle, [
                'Car #',
                'Driver Name',
                'Team',
                'Class',
                'Car Make/Model',
                'Transponder',
                'Status',
                'Paid',
                'Checked In',
            ]);

            foreach ($registrations as $reg) {
                fputcsv($handle, [
                    $reg->car_number,
                    $reg->driver?->full_name ?? $reg->driver_name ?? 'N/A',
                    $reg->team?->name ?? 'Independent',
                    $reg->vehicleClass?->name,
                    $reg->car_make . ' ' . $reg->car_model,
                    $reg->transponder_id,
                    $reg->status,
                    $reg->paid ? 'Yes' : 'No',
                    $reg->checked_in ? 'Yes' : 'No',
                ]);
            }

            fclose($handle);
        };

        return response()->stream($callback, 200, $headers);
    }
}