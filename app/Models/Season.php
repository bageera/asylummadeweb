<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Season extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'slug',
        'year',
        'start_date',
        'end_date',
        'is_current',
        'points_system',
        'status',
    ];

    protected $casts = [
        'start_date' => 'date',
        'end_date' => 'date',
        'is_current' => 'boolean',
    ];

    // ============================================================
    // Relationships
    // ============================================================

    public function events(): HasMany
    {
        return $this->hasMany(Event::class);
    }

    public function pointsStandings(): HasMany
    {
        return $this->hasMany(PointsStanding::class);
    }

    // ============================================================
    // Scopes
    // ============================================================

    public function scopeCurrent($query)
    {
        return $query->where('is_current', true);
    }

    public function scopeActive($query)
    {
        return $query->where('status', 'active');
    }

    public function scopeByYear($query, int $year)
    {
        return $query->where('year', $year);
    }

    // ============================================================
    // Helpers
    // ============================================================

    public static function getCurrent(): ?self
    {
        return static::where('is_current', true)->first();
    }

    public function getEventCountAttribute(): int
    {
        return $this->events()->count();
    }

    public function getCompletedEventCountAttribute(): int
    {
        return $this->events()->where('status', 'completed')->count();
    }
}