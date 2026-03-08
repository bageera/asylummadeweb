<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Season;
use App\Models\Event;
use App\Models\VehicleClass;
use Illuminate\Http\Request;

class EventController extends Controller
{
    /**
     * Display a listing of events.
     */
    public function index()
    {
        $events = Event::with('season', 'vehicleClasses')
            ->orderBy('event_date')
            ->paginate(20);
        
        return view('admin.events.index', compact('events'));
    }

    /**
     * Show the form for creating a new event.
     */
    public function create()
    {
        $seasons = Season::orderBy('year', 'desc')->get();
        $vehicleClasses = VehicleClass::orderBy('sort_order')->get();
        
        return view('admin.events.create', compact('seasons', 'vehicleClasses'));
    }

    /**
     * Store a newly created event.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'slug' => 'required|string|max:255|unique:events',
            'season_id' => 'required|exists:seasons,id',
            'event_date' => 'required|date',
            'gates_open_time' => 'nullable|string',
            'practice_start_time' => 'nullable|string',
            'racing_start_time' => 'nullable|string',
            'admission_general' => 'nullable|numeric|min:0',
            'admission_pit' => 'nullable|numeric|min:0',
            'admission_kids' => 'nullable|numeric|min:0',
            'track_condition' => 'nullable|string',
            'weather_notes' => 'nullable|string',
            'special_notes' => 'nullable|string',
            'status' => 'required|string',
            'vehicle_classes' => 'array',
            'vehicle_classes.*' => 'exists:vehicle_classes,id',
        ]);

        $event = Event::create($validated);
        
        if ($request->has('vehicle_classes')) {
            $event->vehicleClasses()->sync($request->vehicle_classes);
        }

        return redirect()->route('admin.events.index')
            ->with('success', "Event \"{$event->name}\" created successfully.");
    }

    /**
     * Show the form for editing the event.
     */
    public function edit(Event $event)
    {
        $seasons = Season::orderBy('year', 'desc')->get();
        $vehicleClasses = VehicleClass::orderBy('sort_order')->get();
        $event->load('vehicleClasses');
        
        return view('admin.events.edit', compact('event', 'seasons', 'vehicleClasses'));
    }

    /**
     * Update the specified event.
     */
    public function update(Request $request, Event $event)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'slug' => 'required|string|max:255|unique:events,slug,' . $event->id,
            'season_id' => 'required|exists:seasons,id',
            'event_date' => 'required|date',
            'gates_open_time' => 'nullable|string',
            'practice_start_time' => 'nullable|string',
            'racing_start_time' => 'nullable|string',
            'admission_general' => 'nullable|numeric|min:0',
            'admission_pit' => 'nullable|numeric|min:0',
            'admission_kids' => 'nullable|numeric|min:0',
            'track_condition' => 'nullable|string',
            'weather_notes' => 'nullable|string',
            'special_notes' => 'nullable|string',
            'status' => 'required|string',
            'vehicle_classes' => 'array',
            'vehicle_classes.*' => 'exists:vehicle_classes,id',
        ]);

        $event->update($validated);
        
        if ($request->has('vehicle_classes')) {
            $event->vehicleClasses()->sync($request->vehicle_classes);
        } else {
            $event->vehicleClasses()->detach();
        }

        return redirect()->route('admin.events.index')
            ->with('success', "Event \"{$event->name}\" updated successfully.");
    }

    /**
     * Remove the specified event.
     */
    public function destroy(Event $event)
    {
        $name = $event->name;
        $event->vehicleClasses()->detach();
        $event->delete();

        return redirect()->route('admin.events.index')
            ->with('success', "Event \"{$name}\" deleted successfully.");
    }
}