<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class EventClass extends Model
{
    use HasFactory;

    protected $fillable = [
        'event_id',
        'vehicle_class_id',
        'laps',
        'purse',
        'entry_fee',
        'heat_race',
        'feature_laps',
        'sort_order',
    ];

    protected $casts = [
        'purse' => 'decimal:2',
        'entry_fee' => 'decimal:2',
        'heat_race' => 'boolean',
    ];

    // ============================================================
    // Relationships
    // ============================================================

    public function event(): BelongsTo
    {
        return $this->belongsTo(Event::class);
    }

    public function vehicleClass(): BelongsTo
    {
        return $this->belongsTo(VehicleClass::class);
    }

    // ============================================================
    // Helpers
    // ============================================================

    public function getRegistrationCountAttribute(): int
    {
        return $this->event->registrations()
            ->where('vehicle_class_id', $this->vehicle_class_id)
            ->count();
    }
}