<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Models\Team;

class EnsureTeamOwnership
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $user = auth()->user();

        // Admin can access any team
        if ($user->isAdmin()) {
            return $next($request);
        }

        // Get team from route parameter
        $team = $request->route('team');

        // If team is a string (slug), resolve it
        if (is_string($team)) {
            $team = Team::where('slug', $team)->first();
        }

        // If team is numeric (ID), find it
        if (is_numeric($team)) {
            $team = Team::find($team);
        }

        // Check ownership
        if ($team && $team->owner_id === $user->id) {
            return $next($request);
        }

        abort(403, 'You do not have access to this team.');
    }
}