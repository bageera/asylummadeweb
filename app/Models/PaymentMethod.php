<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class PaymentMethod extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'stripe_payment_method_id',
        'brand',
        'last_four',
        'exp_month',
        'exp_year',
        'is_default',
    ];

    protected $casts = [
        'exp_month' => 'integer',
        'exp_year' => 'integer',
        'is_default' => 'boolean',
    ];

    // ============================================================
    // Relationships
    // ============================================================

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    // ============================================================
    // Scopes
    // ============================================================

    public function scopeDefault($query)
    {
        return $query->where('is_default', true);
    }

    // ============================================================
    // Helpers
    // ============================================================

    public function setAsDefault(): void
    {
        // Remove default from other payment methods
        static::where('user_id', $this->user_id)
            ->where('id', '!=', $this->id)
            ->update(['is_default' => false]);

        $this->update(['is_default' => true]);
    }

    public function getBrandIcon(): string
    {
        return match (strtolower($this->brand)) {
            'visa' => 'bi-credit-card-2-front',
            'mastercard' => 'bi-credit-card-2-front',
            'amex', 'american express' => 'bi-credit-card-2-front',
            'discover' => 'bi-credit-card-2-front',
            default => 'bi-credit-card',
        };
    }

    public function getFormattedExpiry(): string
    {
        return sprintf('%02d/%d', $this->exp_month, $this->exp_year % 100);
    }

    public function isExpired(): bool
    {
        $expiry = \Carbon\Carbon::create($this->exp_year, $this->exp_month)->endOfMonth();
        return $expiry->isPast();
    }
}