<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use App\Models\Season;
use App\Models\Event;
use Illuminate\Http\Request;

class EventController extends Controller
{
    /**
     * Display a specific event.
     */
    public function show($eventId)
    {
        $event = Event::with(['season', 'vehicleClasses'])->findOrFail($eventId);
        
        return view('pages.event', compact('event'));
    }
}