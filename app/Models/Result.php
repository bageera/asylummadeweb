<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Result extends Model
{
    use HasFactory;

    protected $fillable = [
        'event_id',
        'vehicle_class_id',
        'driver_id',
        'registration_id',
        'finish_position',
        'starting_position',
        'laps_completed',
        'laps_led',
        'finishing_time',
        'interval_ahead',
        'interval_leader',
        'best_lap_time',
        'best_lap_number',
        'average_speed',
        'points_awarded',
        'bonus_points',
        'penalty_points',
        'total_points',
        'finish_status',
        'dnq',
        'disqualification_reason',
        'notes',
    ];

    protected $casts = [
        'finish_position' => 'integer',
        'starting_position' => 'integer',
        'laps_completed' => 'integer',
        'laps_led' => 'integer',
        'best_lap_number' => 'integer',
        'average_speed' => 'decimal:2',
        'points_awarded' => 'integer',
        'bonus_points' => 'integer',
        'penalty_points' => 'integer',
        'total_points' => 'integer',
        'dnq' => 'boolean',
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

    public function driver(): BelongsTo
    {
        return $this->belongsTo(Driver::class);
    }

    public function registration(): BelongsTo
    {
        return $this->belongsTo(Registration::class);
    }

    // ============================================================
    // Scopes
    // ============================================================

    public function scopeByEvent($query, int $eventId)
    {
        return $query->where('event_id', $eventId);
    }

    public function scopeByClass($query, int $classId)
    {
        return $query->where('vehicle_class_id', $classId);
    }

    public function scopeByPosition($query)
    {
        return $query->orderBy('finish_position');
    }

    public function scopeFinished($query)
    {
        return $query->where('finish_status', 'finished');
    }

    public function scopeDnf($query)
    {
        return $query->where('finish_status', 'dnf');
    }

    // ============================================================
    // Helpers
    // ============================================================

    public function isFinish(): bool
    {
        return $this->finish_status === 'finished';
    }

    public function isDnf(): bool
    {
        return $this->finish_status === 'dnf';
    }

    public function isDns(): bool
    {
        return $this->finish_status === 'dns';
    }

    public function isDq(): bool
    {
        return $this->finish_status === 'dq';
    }

    public function calculatePoints(array $pointsSystem = null): int
    {
        $pointsSystem = $pointsSystem ?? config('racing.points.standard');

        $base = $pointsSystem[$this->finish_position] ?? 0;
        $bonus = $this->bonus_points ?? 0;
        $penalty = $this->penalty_points ?? 0;

        return max(0, $base + $bonus - $penalty);
    }
}