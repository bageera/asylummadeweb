<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Driver extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'team_id',
        'first_name',
        'last_name',
        'nickname',
        'hometown',
        'license_number',
        'license_expires',
        'medical_expires',
        'bio',
        'profile_photo_path',
        'is_active',
    ];

    protected $casts = [
        'license_expires' => 'date',
        'medical_expires' => 'date',
        'is_active' => 'boolean',
    ];

    // ============================================================
    // Relationships
    // ============================================================

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function team(): BelongsTo
    {
        return $this->belongsTo(Team::class);
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

    public function scopeAlphabetical($query)
    {
        return $query->orderBy('last_name')->orderBy('first_name');
    }

    public function scopeByTeam($query, int $teamId)
    {
        return $query->where('team_id', $teamId);
    }

    // ============================================================
    // Helpers
    // ============================================================

    public function getFullNameAttribute(): string
    {
        return trim("{$this->first_name} {$this->last_name}");
    }

    public function getDisplayNameAttribute(): string
    {
        if ($this->nickname) {
            return "{$this->nickname} {$this->last_name}";
        }
        return $this->full_name;
    }

    public function getLicenseValidAttribute(): bool
    {
        if (!$this->license_expires) {
            return true;
        }
        return $this->license_expires->isFuture();
    }

    public function getMedicalValidAttribute(): bool
    {
        if (!$this->medical_expires) {
            return true;
        }
        return $this->medical_expires->isFuture();
    }

    public function isExpired(): bool
    {
        return !$this->license_valid || !$this->medical_valid;
    }
}