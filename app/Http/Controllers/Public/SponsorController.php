<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use App\Models\Sponsor;
use App\Models\Event;
use Illuminate\Http\Request;

class SponsorController extends Controller
{
    /**
     * Display all active sponsors.
     */
    public function index()
    {
        $sponsors = Sponsor::with('events')
            ->active()
            ->orderBy('tier', 'desc')
            ->orderBy('sort_order')
            ->get()
            ->groupBy('tier');

        return view('public.sponsors.index', compact('sponsors'));
    }

    /**
     * Display sponsors for a specific event.
     */
    public function event(Event $event)
    {
        $sponsors = $event->sponsors()
            ->orderBy('tier', 'desc')
            ->orderBy('sort_order')
            ->get()
            ->groupBy('pivot.sponsorship_type');

        return view('public.sponsors.event', compact('event', 'sponsors'));
    }
}