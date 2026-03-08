<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Team;
use App\Models\Season;
use App\Models\Event;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    /**
     * Display the admin dashboard.
     */
    public function index()
    {
        $stats = [
            'teams' => Team::count(),
            'athletes' => User::where('role', 'driver')->count(),
            'events' => Event::where('status', 'scheduled')->orWhere('status', 'registration_open')->count(),
            'seasons' => Season::where('is_current', true)->count(),
        ];

        $recentTeams = Team::orderBy('created_at', 'desc')->take(5)->get();
        
        $upcomingEvents = Event::whereIn('status', ['scheduled', 'registration_open'])
            ->where('event_date', '>=', now())
            ->orderBy('event_date')
            ->take(5)
            ->get();

        return view('admin.dashboard', compact('stats', 'recentTeams', 'upcomingEvents'));
    }
}