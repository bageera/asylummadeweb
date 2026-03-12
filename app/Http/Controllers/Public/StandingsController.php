<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use App\Models\Season;
use App\Models\VehicleClass;
use App\Models\PointsStanding;
use Illuminate\Http\Request;

class StandingsController extends Controller
{
    /**
     * Display the standings page.
     */
    public function index()
    {
        $seasons = Season::orderBy('year', 'desc')->get();
        $currentSeason = Season::where('is_current', true)->first();
        $standings = collect();
        
        if ($currentSeason) {
            $standings = PointsStanding::where('season_id', $currentSeason->id)
                ->with(['driver', 'vehicleClass'])
                ->orderBy('adjusted_points', 'desc')
                ->get()
                ->groupBy('vehicle_class_id');
        }
        
        return view('pages.standings', compact('seasons', 'currentSeason', 'standings'));
    }

    /**
     * Display standings for a specific season.
     */
    public function season($seasonSlug)
    {
        $season = Season::where('slug', $seasonSlug)->firstOrFail();
        $standings = PointsStanding::where('season_id', $season->id)
            ->with(['driver', 'vehicleClass'])
            ->orderBy('adjusted_points', 'desc')
            ->get()
            ->groupBy('vehicle_class_id');
        
        return view('pages.standings', compact('season', 'standings'));
    }

    /**
     * Display standings for a specific season and class.
     */
    public function class($seasonSlug, $classSlug)
    {
        $season = Season::where('slug', $seasonSlug)->firstOrFail();
        $vehicleClass = VehicleClass::where('slug', $classSlug)->firstOrFail();
        
        $standings = PointsStanding::where('season_id', $season->id)
            ->where('vehicle_class_id', $vehicleClass->id)
            ->with('driver')
            ->orderBy('adjusted_points', 'desc')
            ->get();
        
        return view('pages.standings', compact('season', 'vehicleClass', 'standings'));
    }
}