<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Sponsor;
use App\Models\Event;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class SponsorController extends Controller
{
    /**
     * Display a listing of sponsors.
     */
    public function index()
    {
        $sponsors = Sponsor::with('events')
            ->orderBy('tier', 'desc')
            ->orderBy('sort_order')
            ->paginate(20);

        return view('admin.sponsors.index', compact('sponsors'));
    }

    /**
     * Show the form for creating a new sponsor.
     */
    public function create()
    {
        $events = Event::orderBy('event_date')->get();
        $tiers = Sponsor::TIERS;

        return view('admin.sponsors.create', compact('events', 'tiers'));
    }

    /**
     * Store a newly created sponsor.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'website' => 'nullable|url|max:255',
            'logo' => 'nullable|image|max:5120', // 5MB max
            'tier' => 'required|integer|min:1|max:4',
            'is_active' => 'boolean',
            'sort_order' => 'integer',
            'events' => 'array',
            'events.*' => 'exists:events,id',
            'sponsorship_types' => 'array',
        ]);

        // Handle logo upload
        $logoPath = null;
        if ($request->hasFile('logo')) {
            $logoPath = $request->file('logo')->store('sponsors', 'public');
        }

        $sponsor = Sponsor::create([
            'name' => $validated['name'],
            'slug' => Str::slug($validated['name']),
            'description' => $validated['description'] ?? null,
            'website' => $validated['website'] ?? null,
            'logo_path' => $logoPath,
            'tier' => $validated['tier'],
            'is_active' => $request->boolean('is_active', true),
            'sort_order' => $validated['sort_order'] ?? 0,
        ]);

        // Attach events with sponsorship types
        if (!empty($validated['events'])) {
            $eventData = [];
            foreach ($validated['events'] as $index => $eventId) {
                $eventData[$eventId] = ['sponsorship_type' => $validated['sponsorship_types'][$index] ?? 'general'];
            }
            $sponsor->events()->attach($eventData);
        }

        return redirect()->route('admin.sponsors.index')
            ->with('success', 'Sponsor created successfully.');
    }

    /**
     * Show the form for editing the sponsor.
     */
    public function edit(Sponsor $sponsor)
    {
        $events = Event::orderBy('event_date')->get();
        $tiers = Sponsor::TIERS;

        return view('admin.sponsors.edit', compact('sponsor', 'events', 'tiers'));
    }

    /**
     * Update the sponsor.
     */
    public function update(Request $request, Sponsor $sponsor)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'website' => 'nullable|url|max:255',
            'logo' => 'nullable|image|max:5120',
            'tier' => 'required|integer|min:1|max:4',
            'is_active' => 'boolean',
            'sort_order' => 'integer',
            'events' => 'array',
            'events.*' => 'exists:events,id',
            'sponsorship_types' => 'array',
        ]);

        // Handle logo upload
        if ($request->hasFile('logo')) {
            $logoPath = $request->file('logo')->store('sponsors', 'public');
            $validated['logo_path'] = $logoPath;
        }

        $sponsor->update([
            'name' => $validated['name'],
            'slug' => Str::slug($validated['name']),
            'description' => $validated['description'] ?? null,
            'website' => $validated['website'] ?? null,
            'tier' => $validated['tier'],
            'is_active' => $request->boolean('is_active', true),
            'sort_order' => $validated['sort_order'] ?? 0,
        ]);

        // Sync events
        if (isset($validated['events'])) {
            $eventData = [];
            foreach ($validated['events'] as $index => $eventId) {
                $eventData[$eventId] = ['sponsorship_type' => $validated['sponsorship_types'][$index] ?? 'general'];
            }
            $sponsor->events()->sync($eventData);
        } else {
            $sponsor->events()->detach();
        }

        return redirect()->route('admin.sponsors.index')
            ->with('success', 'Sponsor updated successfully.');
    }

    /**
     * Remove the sponsor.
     */
    public function destroy(Sponsor $sponsor)
    {
        $sponsor->events()->detach();
        $sponsor->delete();

        return redirect()->route('admin.sponsors.index')
            ->with('success', 'Sponsor deleted successfully.');
    }
}