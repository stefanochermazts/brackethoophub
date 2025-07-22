<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
        'organizer_id',
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

    /**
     * Get the organizer that owns this user.
     */
    public function organizer()
    {
        return $this->belongsTo(User::class, 'organizer_id');
    }

    /**
     * Get the users that belong to this organizer.
     */
    public function users()
    {
        return $this->hasMany(User::class, 'organizer_id');
    }

    /**
     * Check if user is an admin.
     */
    public function isAdmin(): bool
    {
        return $this->role === 'admin';
    }

    /**
     * Check if user is an organizer.
     */
    public function isOrganizer(): bool
    {
        return $this->role === 'organizer';
    }

    /**
     * Check if user is a company.
     */
    public function isCompany(): bool
    {
        return $this->role === 'company';
    }

    /**
     * Check if user is a coach.
     */
    public function isCoach(): bool
    {
        return $this->role === 'coach';
    }

    /**
     * Check if user is a player.
     */
    public function isPlayer(): bool
    {
        return $this->role === 'player';
    }

    /**
     * Check if user is a regular user.
     */
    public function isUser(): bool
    {
        return $this->role === 'user';
    }

    /**
     * Get available roles for the current user.
     */
    public function getAvailableRoles(): array
    {
        $roleLabels = [
            'admin' => __('admin.administrator'),
            'organizer' => __('admin.organizer'),
            'company' => __('admin.company'),
            'coach' => __('admin.coach'),
            'player' => __('admin.player'),
            'user' => __('admin.user'),
        ];

        if ($this->isAdmin()) {
            return array_intersect_key($roleLabels, array_flip(['admin', 'organizer', 'company', 'coach', 'player', 'user']));
        }
        
        if ($this->isOrganizer()) {
            return array_intersect_key($roleLabels, array_flip(['company', 'coach', 'player']));
        }
        
        return [];
    }

    /**
     * Get role display name.
     */
    public function getRoleDisplayName(): string
    {
        return match($this->role) {
            'admin' => __('Amministratore'),
            'organizer' => __('Organizzatore'),
            'company' => __('Società'),
            'coach' => __('Coach'),
            'player' => __('Giocatore'),
            'user' => __('Utente'),
            default => __('Sconosciuto'),
        };
    }
}
