<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
        'phone',
        'emergency_contact',
        'emergency_phone',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    // ============================================================
    // Relationships
    // ============================================================

    public function teams(): HasMany
    {
        return $this->hasMany(Team::class, 'owner_id');
    }

    public function driver(): BelongsTo
    {
        return $this->belongsTo(Driver::class, 'user_id');
    }

    public function registrations(): HasMany
    {
        return $this->hasMany(Registration::class, 'user_id');
    }

    // ============================================================
    // Role Helpers
    // ============================================================

    /**
     * Check if user is a super user (full access to everything).
     */
    public function isSuperUser(): bool
    {
        return $this->role === 'super_user';
    }

    /**
     * Check if user can manage all teams (super_user or admin).
     */
    public function isAdmin(): bool
    {
        return in_array($this->role, ['super_user', 'admin']);
    }

    /**
     * Check if user is an official (track official).
     */
    public function isOfficial(): bool
    {
        return in_array($this->role, ['super_user', 'admin', 'official']);
    }

    /**
     * Check if user owns a team (super_user, admin, or team_owner).
     */
    public function isTeamOwner(): bool
    {
        return in_array($this->role, ['super_user', 'admin', 'team_owner']);
    }

    /**
     * Check if user can manage a specific team.
     */
    public function canManageTeam(Team $team): bool
    {
        return $this->isSuperUser() || 
               ($this->isAdmin() && $this->isTeamOwner()) || 
               $team->owner_id === $this->id;
    }

    /**
     * Check if user can access admin panel.
     */
    public function canAccessAdmin(): bool
    {
        return in_array($this->role, ['super_user', 'admin']);
    }

    /**
     * Get human-readable role name.
     */
    public function getRoleNameAttribute(): string
    {
        return match($this->role) {
            'super_user' => 'Super User',
            'admin' => 'Administrator',
            'official' => 'Track Official',
            'team_owner' => 'Team Owner',
            'driver' => 'Driver',
            default => 'Unknown',
        };
    }

    /**
     * Get all available roles.
     */
    public static function getRoles(): array
    {
        return [
            'super_user' => 'Super User',
            'admin' => 'Administrator',
            'official' => 'Track Official',
            'team_owner' => 'Team Owner',
            'driver' => 'Driver',
        ];
    }
}