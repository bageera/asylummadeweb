<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class VehicleClass extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'slug',
        'description',
        'rules_url',
        'min_weight_lbs',
        'engine_rules',
        'safety_requirements',
        'sort_order',
        'is_active',
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];

    // ============================================================
    // Relationships
    // ============================================================

    public function events(): BelongsToMany
    {
        return $this->belongsToMany(Event::class, 'event_classes')
            ->withPivot(['laps', 'purse', 'entry_fee', 'heat_race', 'feature_laps', 'sort_order'])
            ->withTimestamps();
    }

    public function eventClasses(): HasMany
    {
        return $this->hasMany(EventClass::class);
    }

    public function registrations(): HasMany
    {
        return $this->hasMany(Registration::class);
    }

    public function results(): HasMany
    {
        return $this->hasMany(Result::class);
    }

    public function pointsStandings(): HasMany
    {
        return $this->hasMany(PointsStanding::class);
    }

    // ============================================================
    // Scopes
    // ============================================================

    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    public function scopeOrdered($query)
    {
        return $query->orderBy('sort_order')->orderBy('name');
    }

    // ============================================================
    // Helpers
    // ============================================================

    public function getRouteKeyName(): string
    {
        return 'slug';
    }
}