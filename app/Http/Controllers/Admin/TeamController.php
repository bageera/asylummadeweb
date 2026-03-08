<?php

namespace App\Http\Controllers\Admin;

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
        $teams = Team::with('drivers')->orderBy('name')->paginate(20);
        
        return view('admin.teams.index', compact('teams'));
    }

    /**
     * Show the form for creating a new team.
     */
    public function create()
    {
        return view('admin.teams.create');
    }

    /**
     * Store a newly created team.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'slug' => 'required|string|max:255|unique:teams',
            'city' => 'nullable|string|max:255',
            'state' => 'nullable|string|max:255',
            'contact_name' => 'nullable|string|max:255',
            'contact_email' => 'nullable|email|max:255',
            'contact_phone' => 'nullable|string|max:255',
            'logo' => 'nullable|image|max:2048',
        ]);

        if ($request->hasFile('logo')) {
            $validated['logo'] = $request->file('logo')->store('teams', 'public');
        }

        $team = Team::create($validated);

        return redirect()->route('admin.teams.index')
            ->with('success', "Team \"{$team->name}\" created successfully.");
    }

    /**
     * Display the specified team.
     */
    public function show(Team $team)
    {
        $team->load('drivers');
        
        return view('admin.teams.show', compact('team'));
    }

    /**
     * Show the form for editing the team.
     */
    public function edit(Team $team)
    {
        return view('admin.teams.edit', compact('team'));
    }

    /**
     * Update the specified team.
     */
    public function update(Request $request, Team $team)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'slug' => 'required|string|max:255|unique:teams,slug,' . $team->id,
            'city' => 'nullable|string|max:255',
            'state' => 'nullable|string|max:255',
            'contact_name' => 'nullable|string|max:255',
            'contact_email' => 'nullable|email|max:255',
            'contact_phone' => 'nullable|string|max:255',
            'logo' => 'nullable|image|max:2048',
            'is_active' => 'boolean',
        ]);

        if ($request->hasFile('logo')) {
            $validated['logo'] = $request->file('logo')->store('teams', 'public');
        }

        $team->update($validated);

        return redirect()->route('admin.teams.index')
            ->with('success', "Team \"{$team->name}\" updated successfully.");
    }

    /**
     * Remove the specified team.
     */
    public function destroy(Team $team)
    {
        $name = $team->name;
        $team->delete();

        return redirect()->route('admin.teams.index')
            ->with('success', "Team \"{$name}\" deleted successfully.");
    }
}