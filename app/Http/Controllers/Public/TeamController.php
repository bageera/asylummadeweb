<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use App\Models\Team;
use Illuminate\Http\Request;

class TeamController extends Controller
{
    /**
     * Display a listing of teams.
     */
    public function index()
    {
        $teams = Team::orderBy('name')->get();
        
        return view('pages.teams', compact('teams'));
    }

    /**
     * Display a specific team.
     */
    public function show($teamId)
    {
        $team = Team::with('drivers')->findOrFail($teamId);
        
        return view('pages.team', compact('team'));
    }
}