<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Category extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'min_age',
        'max_age',
        'gender',
        'tournament_id',
        'min_teams',
        'max_teams',
        'format',
        'rules',
    ];

    protected $casts = [
        'rules' => 'array',
    ];

    // Relazioni
    public function tournament(): BelongsTo
    {
        return $this->belongsTo(Tournament::class);
    }

    public function teams(): HasMany
    {
        return $this->hasMany(Team::class);
    }

    // Metodi helper
    public function getTeamsCountAttribute(): int
    {
        return $this->teams()->count();
    }

    public function canAddTeam(): bool
    {
        if ($this->max_teams && $this->teams_count >= $this->max_teams) {
            return false;
        }
        return true;
    }

    public function hasMinimumTeams(): bool
    {
        return $this->teams_count >= $this->min_teams;
    }

    public function getGenderDisplayAttribute(): string
    {
        return match($this->gender) {
            'male' => __('Maschile'),
            'female' => __('Femminile'),
            'mixed' => __('Misto'),
            default => $this->gender,
        };
    }

    public function getAgeRangeAttribute(): string
    {
        if ($this->min_age && $this->max_age) {
            return "Età {$this->min_age}-{$this->max_age}";
        } elseif ($this->min_age) {
            return "Età {$this->min_age}+";
        } elseif ($this->max_age) {
            return "Età fino a {$this->max_age}";
        }
        return 'Tutte le età';
    }
}
