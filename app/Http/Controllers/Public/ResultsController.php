<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use App\Models\Season;
use App\Models\Event;
use App\Models\Result;
use App\Models\VehicleClass;
use Illuminate\Http\Request;

class ResultsController extends Controller
{
    /**
     * Display the results page.
     */
    public function index()
    {
        $seasons = Season::orderBy('year', 'desc')->get();
        $currentSeason = Season::where('is_current', true)->first();
        $results = collect();
        
        if ($currentSeason) {
            $results = Result::whereHas('event', function ($q) use ($currentSeason) {
                    $q->where('season_id', $currentSeason->id);
                })
                ->orderBy('created_at', 'desc')
                ->get();
        }
        
        return view('pages.results', compact('seasons', 'currentSeason', 'results'));
    }

    /**
     * Display results for a specific season.
     */
    public function season($seasonSlug)
    {
        $season = Season::where('slug', $seasonSlug)->firstOrFail();
        $results = Result::whereHas('event', function ($q) use ($season) {
                $q->where('season_id', $season->id);
            })
            ->orderBy('created_at', 'desc')
            ->get();
        
        return view('pages.results', compact('season', 'results'));
    }

    /**
     * Display results for a specific event.
     */
    public function event($seasonSlug, $eventSlug)
    {
        $season = Season::where('slug', $seasonSlug)->firstOrFail();
        $event = Event::where('slug', $eventSlug)
            ->where('season_id', $season->id)
            ->firstOrFail();
        
        $results = Result::where('event_id', $event->id)
            ->orderBy('finish_position')
            ->get();
        
        return view('pages.results', compact('season', 'event', 'results'));
    }

    /**
     * Display results for a specific event and class.
     */
    public function eventClass($seasonSlug, $eventSlug, $classSlug)
    {
        $season = Season::where('slug', $seasonSlug)->firstOrFail();
        $event = Event::where('slug', $eventSlug)
            ->where('season_id', $season->id)
            ->firstOrFail();
        $vehicleClass = VehicleClass::where('slug', $classSlug)->firstOrFail();
        
        $results = Result::where('event_id', $event->id)
            ->where('vehicle_class_id', $vehicleClass->id)
            ->orderBy('finish_position')
            ->get();
        
        return view('pages.results', compact('season', 'event', 'vehicleClass', 'results'));
    }
}