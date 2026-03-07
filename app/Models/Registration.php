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
        'vehicle_class_id',
        'team_id',
        'car_number',
        'car_make',
        'car_model',
        'car_year',
        'car_color',
        'transponder_id',
        'pit_pass_number',
        'checked_in',
        'check_in_time',
        'paid',
        'payment_method',
        'payment_reference',
        'withdrawal_reason',
        'status',
    ];

    protected $casts = [
        'car_year' => 'integer',
        'car_number' => 'integer',
        'checked_in' => 'boolean',
        'check_in_time' => 'datetime',
        'paid' => 'boolean',
    ];

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

    public function vehicleClass(): BelongsTo
    {
        return $this->belongsTo(VehicleClass::class);
    }

    public function team(): BelongsTo
    {
        return $this->belongsTo(Team::class);
    }

    public function result()
    {
        return $this->hasOne(Result::class);
    }

    // ============================================================
    // Scopes
    // ============================================================

    public function scopeRegistered($query)
    {
        return $query->where('status', 'registered');
    }

    public function scopeCheckedIn($query)
    {
        return $query->where('status', 'checked_in');
    }

    public function scopeByEvent($query, int $eventId)
    {
        return $query->where('event_id', $eventId);
    }

    public function scopeByClass($query, int $classId)
    {
        return $query->where('vehicle_class_id', $classId);
    }

    // ============================================================
    // Helpers
    // ============================================================

    public function checkIn(): void
    {
        $this->update([
            'checked_in' => true,
            'check_in_time' => now(),
            'status' => 'checked_in',
        ]);
    }

    public function withdraw(string $reason = null): void
    {
        $this->update([
            'status' => 'withdrawn',
            'withdrawal_reason' => $reason,
        ]);
    }

    public function markPaid(string $method, string $reference = null): void
    {
        $this->update([
            'paid' => true,
            'payment_method' => $method,
            'payment_reference' => $reference,
        ]);
    }

    public function getCarDescriptionAttribute(): string
    {
        $parts = array_filter([
            $this->car_year,
            $this->car_make,
            $this->car_model,
        ]);
        return implode(' ', $parts) ?: 'Unknown';
    }
}