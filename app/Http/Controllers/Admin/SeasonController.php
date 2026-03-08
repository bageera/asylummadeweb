<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Season;
use Illuminate\Http\Request;

class SeasonController extends Controller
{
    /**
     * Display a listing of seasons.
     */
    public function index()
    {
        $seasons = Season::orderBy('year', 'desc')->paginate(20);
        
        return view('admin.seasons.index', compact('seasons'));
    }

    /**
     * Show the form for creating a new season.
     */
    public function create()
    {
        return view('admin.seasons.create');
    }

    /**
     * Store a newly created season.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'slug' => 'required|string|max:255|unique:seasons',
            'year' => 'required|integer',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after:start_date',
            'points_system' => 'required|string',
            'is_current' => 'boolean',
        ]);

        // If this is set as current, unset others
        if ($validated['is_current'] ?? false) {
            Season::where('is_current', true)->update(['is_current' => false]);
        }

        $season = Season::create($validated);

        return redirect()->route('admin.seasons.index')
            ->with('success', "Season \"{$season->name}\" created successfully.");
    }

    /**
     * Show the form for editing the season.
     */
    public function edit(Season $season)
    {
        return view('admin.seasons.edit', compact('season'));
    }

    /**
     * Update the specified season.
     */
    public function update(Request $request, Season $season)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'slug' => 'required|string|max:255|unique:seasons,slug,' . $season->id,
            'year' => 'required|integer',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after:start_date',
            'points_system' => 'required|string',
            'is_current' => 'boolean',
            'status' => 'required|string',
        ]);

        // If this is set as current, unset others
        if ($validated['is_current'] ?? false) {
            Season::where('is_current', true)
                ->where('id', '!=', $season->id)
                ->update(['is_current' => false]);
        }

        $season->update($validated);

        return redirect()->route('admin.seasons.index')
            ->with('success', "Season \"{$season->name}\" updated successfully.");
    }
}