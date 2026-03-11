<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Waiver extends Model
{
    use HasFactory;

    protected $fillable = [
        'waiver_template_id',
        'user_id',
        'event_id',
        'signature_data',
        'ip_address',
        'user_agent',
        'signed_at',
        'expires_at',
        'is_valid',
    ];

    protected $casts = [
        'signed_at' => 'datetime',
        'expires_at' => 'datetime',
        'is_valid' => 'boolean',
    ];

    // ============================================================
    // Relationships
    // ============================================================

    public function waiverTemplate(): BelongsTo
    {
        return $this->belongsTo(WaiverTemplate::class);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function event(): BelongsTo
    {
        return $this->belongsTo(Event::class);
    }

    // ============================================================
    // Scopes
    // ============================================================

    public function scopeValid($query)
    {
        return $query->where('is_valid', true)
            ->where(function ($q) {
                $q->whereNull('expires_at')
                    ->orWhere('expires_at', '>', now());
            });
    }

    public function scopeForEvent($query, int $eventId)
    {
        return $query->where('event_id', $eventId);
    }

    // ============================================================
    // Helpers
    // ============================================================

    public function isExpired(): bool
    {
        return $this->expires_at && $this->expires_at->isPast();
    }

    public function isValid(): bool
    {
        return $this->is_valid && !$this->isExpired();
    }

    public function markInvalid(): void
    {
        $this->update(['is_valid' => false]);
    }
}