<?php

namespace App\Http\Controllers\Team;

use App\Http\Controllers\Controller;
use App\Models\Driver;
use App\Models\Team;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TeamController extends Controller
{
    /**
     * Display the team manager dashboard.
     */
    public function index()
    {
        $user = Auth::user();
        $team = $user->team;
        
        if (!$team) {
            return redirect()->route('home')
                ->with('error', 'You are not assigned to a team.');
        }

        $team->load(['drivers' => function ($query) {
            $query->orderBy('name');
        }]);

        return view('team.dashboard', compact('team'));
    }

    /**
     * Show the form for editing team profile.
     */
    public function edit()
    {
        $user = Auth::user();
        $team = $user->team;
        
        if (!$team) {
            return redirect()->route('home')
                ->with('error', 'You are not assigned to a team.');
        }

        return view('team.edit', compact('team'));
    }

    /**
     * Update the team profile.
     */
    public function update(Request $request)
    {
        $user = Auth::user();
        $team = $user->team;
        
        if (!$team) {
            return redirect()->route('home')
                ->with('error', 'You are not assigned to a team.');
        }

        $validated = $request->validate([
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

        $team->update($validated);

        return redirect()->route('team.dashboard')
            ->with('success', 'Team profile updated successfully.');
    }

    /**
     * Display team's athletes.
     */
    public function athletes()
    {
        $user = Auth::user();
        $team = $user->team;
        
        if (!$team) {
            return redirect()->route('home')
                ->with('error', 'You are not assigned to a team.');
        }

        $athletes = User::where('team_id', $team->id)
            ->where('role', 'driver')
            ->orderBy('name')
            ->get();

        return view('team.athletes.index', compact('team', 'athletes'));
    }

    /**
     * Show form to add an athlete.
     */
    public function createAthlete()
    {
        $user = Auth::user();
        $team = $user->team;
        
        if (!$team) {
            return redirect()->route('home')
                ->with('error', 'You are not assigned to a team.');
        }

        return view('team.athletes.create', compact('team'));
    }

    /**
     * Store a new athlete.
     */
    public function storeAthlete(Request $request)
    {
        $user = Auth::user();
        $team = $user->team;
        
        if (!$team) {
            return redirect()->route('home')
                ->with('error', 'You are not assigned to a team.');
        }

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'date_of_birth' => 'nullable|date',
            'phone' => 'nullable|string|max:255',
            'emergency_contact' => 'nullable|string|max:255',
            'emergency_phone' => 'nullable|string|max:255',
        ]);

        $password = substr(str_shuffle('abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789'), 0, 12);

        $athlete = User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => bcrypt($password),
            'role' => 'driver',
            'team_id' => $team->id,
            'email_verified_at' => now(),
        ]);

        // Create driver profile
        Driver::create([
            'user_id' => $athlete->id,
            'team_id' => $team->id,
            'name' => $validated['name'],
        ]);

        return redirect()->route('team.athletes')
            ->with('success', "Athlete \"{$athlete->name}\" added successfully. Temporary password sent to their email.");
    }

    /**
     * Remove an athlete from the team.
     */
    public function removeAthlete(User $athlete)
    {
        $user = Auth::user();
        $team = $user->team;
        
        if (!$team || $athlete->team_id !== $team->id) {
            return redirect()->route('team.athletes')
                ->with('error', 'You cannot remove this athlete.');
        }

        $name = $athlete->name;
        $athlete->update(['team_id' => null]);

        return redirect()->route('team.athletes')
            ->with('success', "Athlete \"{$name}\" removed from team.");
    }
}