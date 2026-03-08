<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use App\Models\Season;
use App\Models\Event;
use Illuminate\Http\Request;

class ScheduleController extends Controller
{
    /**
     * Display the schedule page.
     */
    public function index()
    {
        $seasons = Season::orderBy('year', 'desc')->get();
        $currentSeason = Season::where('is_current', true)->first();
        $events = collect();
        
        if ($currentSeason) {
            $events = Event::where('season_id', $currentSeason->id)
                ->orderBy('event_date')
                ->get();
        }
        
        return view('pages.schedule', compact('seasons', 'currentSeason', 'events'));
    }

    /**
     * Display events for a specific season.
     */
    public function season($seasonSlug)
    {
        $season = Season::where('slug', $seasonSlug)->firstOrFail();
        $events = Event::where('season_id', $season->id)
            ->orderBy('event_date')
            ->get();
        
        return view('pages.schedule', compact('season', 'events'));
    }
}