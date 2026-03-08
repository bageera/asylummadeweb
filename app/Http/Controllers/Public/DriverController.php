<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use App\Models\Driver;
use Illuminate\Http\Request;

class DriverController extends Controller
{
    /**
     * Display a listing of drivers.
     */
    public function index()
    {
        $drivers = Driver::with('team')->orderBy('name')->get();
        
        return view('pages.drivers', compact('drivers'));
    }

    /**
     * Display a specific driver.
     */
    public function show($driverId)
    {
        $driver = Driver::with(['team', 'results', 'standings'])->findOrFail($driverId);
        
        return view('pages.driver', compact('driver'));
    }
}