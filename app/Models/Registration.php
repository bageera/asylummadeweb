<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Registration extends Model
{
    use HasFactory;

    protected $fillable = [
        'event_id',
        'driver_id',
        'team_id',
        'vehicle_class_id',
        'car_number',
        'car_make',
        'car_model',
        'car_year',
        'car_color',
        'transponder_id',
        'pit_pass_number',
        'status',
        'checked_in',
        'check_in_time',
        'paid',
        'payment_method',
        'payment_reference',
        'withdrawal_reason',
        'notes',
    ];

    protected $casts = [
        'car_number' => 'integer',
        'car_year' => 'integer',
        'checked_in' => 'boolean',
        'check_in_time' => 'datetime',
        'paid' => 'boolean',
    ];

    // Status constants
    const STATUS_PENDING = 'pending';
    const STATUS_REGISTERED = 'registered';
    const STATUS_CHECKED_IN = 'checked_in';
    const STATUS_WITHDRAWN = 'withdrawn';
    const STATUS_NO_SHOW = 'no_show';

    // Payment method constants
    const PAYMENT_CASH = 'cash';
    const PAYMENT_CARD = 'card';
    const PAYMENT_TRANSFER = 'transfer';
    const PAYMENT_ONLINE = 'online';

    // ============================================================
    // Relationships
    // ============================================================

    public function event(): BelongsTo
    {
        return $this->belongsTo(Event::class);
    }

    public function driver(): BelongsTo
    {
        return $this->belongsTo(Driver::class);
    }

    public function team(): BelongsTo
    {
        return $this->belongsTo(Team::class);
    }

    public function vehicleClass(): BelongsTo
    {
        return $this->belongsTo(VehicleClass::class);
    }

    // ============================================================
    // Scopes
    // ============================================================

    public function scopePending($query)
    {
        return $query->where('status', self::STATUS_PENDING);
    }

    public function scopeRegistered($query)
    {
        return $query->where('status', self::STATUS_REGISTERED);
    }

    public function scopeCheckedIn($query)
    {
        return $query->where('status', self::STATUS_CHECKED_IN);
    }

    public function scopeForEvent($query, int $eventId)
    {
        return $query->where('event_id', $eventId);
    }

    public function scopeUnpaid($query)
    {
        return $query->where('paid', false);
    }

    // ============================================================
    // Helpers
    // ============================================================

    public function getDriverNameAttribute(): string
    {
        if ($this->driver) {
            return $this->driver->full_name;
        }
        return 'Guest Driver';
    }

    public function getCarDescriptionAttribute(): string
    {
        $parts = array_filter([
            $this->car_year,
            $this->car_make,
            $this->car_model,
        ]);
        return implode(' ', $parts) ?: 'Not specified';
    }

    public function getStatusLabelAttribute(): string
    {
        return match($this->status) {
            self::STATUS_PENDING => 'Pending',
            self::STATUS_REGISTERED => 'Registered',
            self::STATUS_CHECKED_IN => 'Checked In',
            self::STATUS_WITHDRAWN => 'Withdrawn',
            self::STATUS_NO_SHOW => 'No Show',
            default => ucfirst($this->status),
        };
    }

    public function getStatusColorAttribute(): string
    {
        return match($this->status) {
            self::STATUS_PENDING => 'warning',
            self::STATUS_REGISTERED => 'success',
            self::STATUS_CHECKED_IN => 'info',
            self::STATUS_WITHDRAWN => 'secondary',
            self::STATUS_NO_SHOW => 'danger',
            default => 'secondary',
        };
    }

    public function isPending(): bool
    {
        return $this->status === self::STATUS_PENDING;
    }

    public function isRegistered(): bool
    {
        return $this->status === self::STATUS_REGISTERED;
    }

    public function isCheckedIn(): bool
    {
        return $this->status === self::STATUS_CHECKED_IN;
    }

    public static function getStatuses(): array
    {
        return [
            self::STATUS_PENDING => 'Pending',
            self::STATUS_REGISTERED => 'Registered',
            self::STATUS_CHECKED_IN => 'Checked In',
            self::STATUS_WITHDRAWN => 'Withdrawn',
            self::STATUS_NO_SHOW => 'No Show',
        ];
    }

    public static function getPaymentMethods(): array
    {
        return [
            self::PAYMENT_CASH => 'Cash',
            self::PAYMENT_CARD => 'Card',
            self::PAYMENT_TRANSFER => 'Bank Transfer',
            self::PAYMENT_ONLINE => 'Online Payment',
        ];
    }
}