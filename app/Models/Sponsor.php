<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Sponsor extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'slug',
        'description',
        'website',
        'logo_path',
        'tier',
        'is_active',
        'sort_order',
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'tier' => 'integer',
        'sort_order' => 'integer',
    ];

    // ============================================================
    // Tier Constants
    // ============================================================

    const TIER_BRONZE = 1;
    const TIER_SILVER = 2;
    const TIER_GOLD = 3;
    const TIER_PLATINUM = 4;

    const TIERS = [
        self::TIER_BRONZE => 'Bronze',
        self::TIER_SILVER => 'Silver',
        self::TIER_GOLD => 'Gold',
        self::TIER_PLATINUM => 'Platinum',
    ];

    // ============================================================
    // Relationships
    // ============================================================

    public function events(): BelongsToMany
    {
        return $this->belongsToMany(Event::class, 'event_sponsor')
            ->withPivot('sponsorship_type')
            ->withTimestamps();
    }

    // ============================================================
    // Scopes
    // ============================================================

    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    public function scopeByTier($query, int $tier)
    {
        return $query->where('tier', $tier);
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

    public function getTierName(): string
    {
        return self::TIERS[$this->tier] ?? 'Unknown';
    }

    public function getLogoUrl(): string
    {
        if ($this->logo_path) {
            return asset('storage/' . $this->logo_path);
        }
        return asset('assets/images/default-sponsor.png');
    }

    public function isPlatinum(): bool
    {
        return $this->tier === self::TIER_PLATINUM;
    }

    public function isGold(): bool
    {
        return $this->tier === self::TIER_GOLD;
    }
}