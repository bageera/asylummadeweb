<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Team;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Display a listing of users.
     */
    public function index(Request $request)
    {
        $query = User::with('team');
        
        if ($request->role) {
            $query->where('role', $request->role);
        }
        
        if ($request->team_id) {
            $query->where('team_id', $request->team_id);
        }
        
        $users = $query->orderBy('name')->paginate(20);
        $teams = Team::orderBy('name')->get();
        
        return view('admin.users.index', compact('users', 'teams'));
    }

    /**
     * Show the form for creating a new user.
     */
    public function create()
    {
        $teams = Team::orderBy('name')->get();
        $roles = ['admin', 'official', 'team_manager', 'driver'];
        
        return view('admin.users.create', compact('teams', 'roles'));
    }

    /**
     * Store a newly created user.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:8|confirmed',
            'role' => 'required|in:admin,official,team_manager,driver',
            'team_id' => 'nullable|exists:teams,id',
        ]);

        $validated['password'] = Hash::make($validated['password']);
        $validated['email_verified_at'] = now();

        $user = User::create($validated);

        return redirect()->route('admin.users.index')
            ->with('success', "User \"{$user->name}\" created successfully.");
    }

    /**
     * Show the form for editing the user.
     */
    public function edit(User $user)
    {
        $teams = Team::orderBy('name')->get();
        $roles = ['admin', 'official', 'team_manager', 'driver'];
        
        return view('admin.users.edit', compact('user', 'teams', 'roles'));
    }

    /**
     * Update the specified user.
     */
    public function update(Request $request, User $user)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'role' => 'required|in:admin,official,team_manager,driver',
            'team_id' => 'nullable|exists:teams,id',
            'password' => 'nullable|string|min:8|confirmed',
        ]);

        if ($validated['password'] ?? null) {
            $validated['password'] = Hash::make($validated['password']);
        } else {
            unset($validated['password']);
        }

        $user->update($validated);

        return redirect()->route('admin.users.index')
            ->with('success', "User \"{$user->name}\" updated successfully.");
    }

    /**
     * Remove the specified user.
     */
    public function destroy(User $user)
    {
        if ($user->id === auth()->id()) {
            return redirect()->route('admin.users.index')
                ->with('error', 'You cannot delete your own account.');
        }

        $name = $user->name;
        $user->delete();

        return redirect()->route('admin.users.index')
            ->with('success', "User \"{$name}\" deleted successfully.");
    }
}