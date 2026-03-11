<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Event;
use App\Models\Team;
use App\Models\Season;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    /**
     * Display the user's dashboard after login.
     */
    public function index()
    {
        $user = Auth::user();
        
        // Get current season
        $currentSeason = Season::where('is_current', true)->first();
        
        // Get upcoming events
        $upcomingEvents = Event::whereIn('status', ['scheduled', 'registration_open'])
            ->where('event_date', '>=', now())
            ->orderBy('event_date')
            ->take(5)
            ->get();
        
        // Get user's team (if team owner)
        $myTeam = null;
        if ($user->isTeamOwner()) {
            $myTeam = Team::where('owner_id', $user->id)->first();
        }
        
        // Get user's driver profile (if exists)
        $myDriver = $user->driver;
        
        // Get registrations through driver profile (if exists)
        $registrations = collect();
        if ($myDriver) {
            $registrations = $myDriver->registrations()
                ->with('event')
                ->orderBy('created_at', 'desc')
                ->take(5)
                ->get();
        }

        return view('dashboard.index', compact(
            'user',
            'currentSeason',
            'upcomingEvents',
            'myTeam',
            'myDriver',
            'registrations'
        ));
    }
}