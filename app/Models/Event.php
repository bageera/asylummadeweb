<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Str;

class Event extends Model
{
    use HasFactory;

    protected $fillable = [
        'season_id',
        'name',
        'slug',
        'event_date',
        'gates_open_time',
        'practice_start_time',
        'racing_start_time',
        'admission_general',
        'admission_pit',
        'admission_kids',
        'track_condition',
        'weather_notes',
        'special_notes',
        'status',
        'results_posted',
    ];

    protected $casts = [
        'event_date' => 'date',
        'gates_open_time' => 'datetime:H:i',
        'practice_start_time' => 'datetime:H:i',
        'racing_start_time' => 'datetime:H:i',
        'admission_general' => 'decimal:2',
        'admission_pit' => 'decimal:2',
        'admission_kids' => 'decimal:2',
        'results_posted' => 'boolean',
    ];

    protected static function booted(): void
    {
        static::creating(function (self $event) {
            if (empty($event->slug)) {
                $event->slug = Str::slug($event->name . '-' . $event->event_date->format('Y-m-d'));
            }
        });
    }

    // ============================================================
    // Relationships
    // ============================================================

    public function season(): BelongsTo
    {
        return $this->belongsTo(Season::class);
    }

    public function vehicleClasses(): BelongsToMany
    {
        return $this->belongsToMany(VehicleClass::class, 'event_classes')
            ->withPivot(['laps', 'purse', 'entry_fee', 'heat_race', 'feature_laps', 'sort_order'])
            ->withTimestamps()
            ->orderByPivot('sort_order');
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

    public function sponsors(): BelongsToMany
    {
        return $this->belongsToMany(Sponsor::class, 'event_sponsor')
            ->withPivot('sponsorship_type')
            ->withTimestamps()
            ->orderByPivot('sponsorship_type');
    }

    // ============================================================
    // Scopes
    // ============================================================

    public function scopeUpcoming($query)
    {
        return $query->where('event_date', '>=', now())
            ->whereIn('status', ['scheduled', 'registration_open']);
    }

    public function scopePast($query)
    {
        return $query->where('event_date', '<', now());
    }

    public function scopeCompleted($query)
    {
        return $query->where('status', 'completed');
    }

    public function scopeRegistrationOpen($query)
    {
        return $query->where('status', 'registration_open');
    }

    public function scopeBySeason($query, int $seasonId)
    {
        return $query->where('season_id', $seasonId);
    }

    public function scopeOrdered($query)
    {
        return $query->orderBy('event_date');
    }

    // ============================================================
    // Helpers
    // ============================================================

    public function getRouteKeyName(): string
    {
        return 'slug';
    }

    public function isUpcoming(): bool
    {
        return $this->event_date->isFuture() && in_array($this->status, ['scheduled', 'registration_open']);
    }

    public function isRegistrationOpen(): bool
    {
        return $this->status === 'registration_open';
    }

    public function isCompleted(): bool
    {
        return $this->status === 'completed';
    }

    public function getRegistrationCountAttribute(): int
    {
        return $this->registrations()->count();
    }

    public function getCheckedInCountAttribute(): int
    {
        return $this->registrations()->where('checked_in', true)->count();
    }
}