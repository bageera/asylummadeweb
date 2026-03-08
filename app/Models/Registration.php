<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Registration extends Model
{
    use HasFactory;

    protected $fillable = [
        'event_id',
        'vehicle_class_id',
        'team_id',
        'first_name',
        'last_name',
        'email',
        'phone',
        'date_of_birth',
        'emergency_contact_name',
        'emergency_contact_phone',
        'status',
        'notes',
        'agreed_rules_at',
        'agreed_waiver_at',
        'agreed_safety_at',
    ];

    protected $casts = [
        'date_of_birth' => 'date',
        'agreed_rules_at' => 'datetime',
        'agreed_waiver_at' => 'datetime',
        'agreed_safety_at' => 'datetime',
    ];

    /**
     * Get the event this registration is for.
     */
    public function event()
    {
        return $this->belongsTo(Event::class);
    }

    /**
     * Get the vehicle class.
     */
    public function vehicleClass()
    {
        return $this->belongsTo(VehicleClass::class);
    }

    /**
     * Get the team (if any).
     */
    public function team()
    {
        return $this->belongsTo(Team::class);
    }

    /**
     * Get the participant's full name.
     */
    public function getFullNameAttribute(): string
    {
        return "{$this->first_name} {$this->last_name}";
    }
}