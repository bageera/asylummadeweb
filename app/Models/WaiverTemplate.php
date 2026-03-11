<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class WaiverTemplate extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'slug',
        'content',
        'version',
        'requires_signature',
        'requires_parent_signature',
        'valid_for_days',
        'is_active',
    ];

    protected $casts = [
        'requires_signature' => 'boolean',
        'requires_parent_signature' => 'boolean',
        'is_active' => 'boolean',
        'valid_for_days' => 'integer',
    ];

    // ============================================================
    // Relationships
    // ============================================================

    public function waivers(): HasMany
    {
        return $this->hasMany(Waiver::class);
    }

    // ============================================================
    // Scopes
    // ============================================================

    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    // ============================================================
    // Helpers
    // ============================================================

    public function getRouteKeyName(): string
    {
        return 'slug';
    }

    public function hasValidWaiver(User $user, ?Event $event = null): bool
    {
        $query = $this->waivers()
            ->where('user_id', $user->id)
            ->where('is_valid', true);

        if ($event) {
            $query->where('event_id', $event->id);
        }

        $waiver = $query->latest()->first();

        if (!$waiver) {
            return false;
        }

        if ($this->valid_for_days > 0) {
            return $waiver->expires_at->isFuture();
        }

        return true;
    }

    public function createForUser(User $user, string $signatureData, ?Event $event = null): Waiver
    {
        $expiresAt = $this->valid_for_days > 0
            ? now()->addDays($this->valid_for_days)
            : null;

        return $this->waivers()->create([
            'user_id' => $user->id,
            'event_id' => $event?->id,
            'signature_data' => $signatureData,
            'ip_address' => request()->ip(),
            'user_agent' => request()->userAgent(),
            'signed_at' => now(),
            'expires_at' => $expiresAt,
        ]);
    }
}