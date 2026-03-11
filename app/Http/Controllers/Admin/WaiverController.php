<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\WaiverTemplate;
use App\Models\Waiver;
use App\Models\Event;
use Illuminate\Http\Request;

class WaiverController extends Controller
{
    /**
     * Display waiver templates.
     */
    public function index()
    {
        $templates = WaiverTemplate::withCount('waivers')
            ->orderBy('name')
            ->paginate(20);

        return view('admin.waivers.index', compact('templates'));
    }

    /**
     * Show the form for creating a waiver template.
     */
    public function create()
    {
        return view('admin.waivers.create');
    }

    /**
     * Store a new waiver template.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'content' => 'required|string',
            'version' => 'string|max:20',
            'requires_signature' => 'boolean',
            'requires_parent_signature' => 'boolean',
            'valid_for_days' => 'integer|min:0',
            'is_active' => 'boolean',
        ]);

        $template = WaiverTemplate::create([
            'name' => $validated['name'],
            'slug' => \Str::slug($validated['name']),
            'content' => $validated['content'],
            'version' => $validated['version'] ?? '1.0',
            'requires_signature' => $request->boolean('requires_signature', true),
            'requires_parent_signature' => $request->boolean('requires_parent_signature', false),
            'valid_for_days' => $validated['valid_for_days'] ?? 365,
            'is_active' => $request->boolean('is_active', true),
        ]);

        return redirect()->route('admin.waivers.index')
            ->with('success', 'Waiver template created successfully.');
    }

    /**
     * Show the form for editing a waiver template.
     */
    public function edit(WaiverTemplate $waiver)
    {
        return view('admin.waivers.edit', compact('waiver'));
    }

    /**
     * Update the waiver template.
     */
    public function update(Request $request, WaiverTemplate $waiver)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'content' => 'required|string',
            'version' => 'string|max:20',
            'requires_signature' => 'boolean',
            'requires_parent_signature' => 'boolean',
            'valid_for_days' => 'integer|min:0',
            'is_active' => 'boolean',
        ]);

        $waiver->update([
            'name' => $validated['name'],
            'slug' => \Str::slug($validated['name']),
            'content' => $validated['content'],
            'version' => $validated['version'] ?? '1.0',
            'requires_signature' => $request->boolean('requires_signature', true),
            'requires_parent_signature' => $request->boolean('requires_parent_signature', false),
            'valid_for_days' => $validated['valid_for_days'] ?? 365,
            'is_active' => $request->boolean('is_active', true),
        ]);

        return redirect()->route('admin.waivers.index')
            ->with('success', 'Waiver template updated successfully.');
    }

    /**
     * Remove the waiver template.
     */
    public function destroy(WaiverTemplate $waiver)
    {
        $waiver->waivers()->delete();
        $waiver->delete();

        return redirect()->route('admin.waivers.index')
            ->with('success', 'Waiver template deleted successfully.');
    }

    /**
     * View signed waivers for a template.
     */
    public function signedWaivers(WaiverTemplate $waiver)
    {
        $waivers = Waiver::with(['user', 'event'])
            ->where('waiver_template_id', $waiver->id)
            ->orderBy('signed_at', 'desc')
            ->paginate(50);

        return view('admin.waivers.signed', compact('waiver', 'waivers'));
    }

    /**
     * Export signed waivers as CSV.
     */
    public function export(WaiverTemplate $waiver)
    {
        $waivers = Waiver::with(['user', 'event'])
            ->where('waiver_template_id', $waiver->id)
            ->where('is_valid', true)
            ->orderBy('signed_at', 'desc')
            ->get();

        $headers = [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => 'attachment; filename="' . $waiver->slug . '-waivers.csv"',
        ];

        $callback = function () use ($waivers) {
            $file = fopen('php://output', 'w');
            fputcsv($file, ['Name', 'Email', 'Event', 'Signed At', 'IP Address', 'Expires At']);

            foreach ($waivers as $w) {
                fputcsv($file, [
                    $w->user->name,
                    $w->user->email,
                    $w->event?->name ?? 'N/A',
                    $w->signed_at->format('Y-m-d H:i:s'),
                    $w->ip_address,
                    $w->expires_at?->format('Y-m-d') ?? 'Never',
                ]);
            }

            fclose($file);
        };

        return response()->stream($callback, 200, $headers);
    }
}