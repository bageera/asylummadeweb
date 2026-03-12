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
        'athlete_id',
        'team_id',
        'vehicle_class_id',
        'first_name',
        'last_name',
        'email',
        'phone',
        'date_of_birth',
        'emergency_contact_name',
        'emergency_contact_phone',
        'bib_number',
        'seed_time',
        'seed_distance',
        'seed_mark',
        'status',
        'checked_in',
        'check_in_time',
        'paid',
        'payment_method',
        'payment_reference',
        'agreed_rules_at',
        'agreed_waiver_at',
        'agreed_safety_at',
        'waiver_id',
        'notes',
        'withdrawal_reason',
    ];

    protected $casts = [
        'date_of_birth' => 'date',
        'bib_number' => 'integer',
        'checked_in' => 'boolean',
        'check_in_time' => 'datetime',
        'paid' => 'boolean',
        'agreed_rules_at' => 'datetime',
        'agreed_waiver_at' => 'datetime',
        'agreed_safety_at' => 'datetime',
    ];

    // Status constants
    const STATUS_PENDING = 'pending';
    const STATUS_REGISTERED = 'registered';
    const STATUS_CHECKED_IN = 'checked_in';
    const STATUS_WITHDRAWN = 'withdrawn';
    const STATUS_NO_SHOW = 'no_show';
    const STATUS_DISQUALIFIED = 'disqualified';

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

    /**
     * Athlete profile (Driver model is used for athletes in this system)
     */
    public function athlete(): BelongsTo
    {
        return $this->belongsTo(Driver::class, 'athlete_id');
    }

    public function team(): BelongsTo
    {
        return $this->belongsTo(Team::class);
    }

    /**
     * Event class (track event, field event, etc.)
     */
    public function eventClass(): BelongsTo
    {
        return $this->belongsTo(VehicleClass::class, 'vehicle_class_id');
    }

    public function signedWaiver(): BelongsTo
    {
        return $this->belongsTo(Waiver::class, 'waiver_id');
    }

    // Legacy alias for compatibility
    public function driver(): BelongsTo
    {
        return $this->athlete();
    }

    public function vehicleClass(): BelongsTo
    {
        return $this->eventClass();
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

    public function getAthleteNameAttribute(): string
    {
        if ($this->athlete) {
            return $this->athlete->full_name;
        }
        return trim("{$this->first_name} {$this->last_name}") ?: 'Guest Athlete';
    }

    public function getSeedDisplayAttribute(): string
    {
        if ($this->seed_time) {
            return $this->seed_time;
        }
        if ($this->seed_distance) {
            return $this->seed_distance;
        }
        if ($this->seed_mark) {
            return $this->seed_mark;
        }
        return 'NT'; // No Time/Mark
    }

    public function getStatusLabelAttribute(): string
    {
        return match($this->status) {
            self::STATUS_PENDING => 'Pending',
            self::STATUS_REGISTERED => 'Registered',
            self::STATUS_CHECKED_IN => 'Checked In',
            self::STATUS_WITHDRAWN => 'Withdrawn',
            self::STATUS_NO_SHOW => 'No Show',
            self::STATUS_DISQUALIFIED => 'Disqualified',
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
            self::STATUS_DISQUALIFIED => 'danger',
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
            self::STATUS_DISQUALIFIED => 'Disqualified',
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