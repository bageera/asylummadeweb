<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class PointsStanding extends Model
{
    use HasFactory;

    protected $fillable = [
        'season_id',
        'vehicle_class_id',
        'driver_id',
        'events_participated',
        'events_counted',
        'wins',
        'top5',
        'top10',
        'poles',
        'laps_led',
        'total_points',
        'adjusted_points',
        'position',
        'previous_position',
    ];

    protected $casts = [
        'events_participated' => 'integer',
        'events_counted' => 'integer',
        'wins' => 'integer',
        'top5' => 'integer',
        'top10' => 'integer',
        'poles' => 'integer',
        'laps_led' => 'integer',
        'total_points' => 'integer',
        'adjusted_points' => 'integer',
        'position' => 'integer',
        'previous_position' => 'integer',
    ];

    // ============================================================
    // Relationships
    // ============================================================

    public function season(): BelongsTo
    {
        return $this->belongsTo(Season::class);
    }

    public function vehicleClass(): BelongsTo
    {
        return $this->belongsTo(VehicleClass::class);
    }

    public function driver(): BelongsTo
    {
        return $this->belongsTo(Driver::class);
    }

    // ============================================================
    // Scopes
    // ============================================================

    public function scopeBySeason($query, int $seasonId)
    {
        return $query->where('season_id', $seasonId);
    }

    public function scopeByClass($query, int $classId)
    {
        return $query->where('vehicle_class_id', $classId);
    }

    public function scopeOrdered($query)
    {
        return $query->orderBy('position');
    }

    public function scopeTop($query, int $limit = 10)
    {
        return $query->ordered()->limit($limit);
    }

    // ============================================================
    // Helpers
    // ============================================================

    public function getPositionChangeAttribute(): int
    {
        if ($this->previous_position === null) {
            return 0;
        }
        return $this->previous_position - $this->position;
    }

    public function getMovementTextAttribute(): string
    {
        $change = $this->position_change;
        if ($change > 0) {
            return "↑{$change}";
        } elseif ($change < 0) {
            return "↓" . abs($change);
        }
        return '—';
    }

    public function addResult(Result $result): void
    {
        $this->events_participated++;
        $this->total_points += $result->total_points;

        if ($result->finish_position === 1) {
            $this->wins++;
        }
        if ($result->finish_position <= 5) {
            $this->top5++;
        }
        if ($result->finish_position <= 10) {
            $this->top10++;
        }
        if ($result->starting_position === 1) {
            $this->poles++;
        }
        if ($result->laps_led) {
            $this->laps_led += $result->laps_led;
        }

        $this->save();
    }
}