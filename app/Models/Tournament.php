<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Tournament extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'gender',
        'start_date',
        'end_date',
        'status',
        'format',
        'settings',
        'organizer_id',
    ];

    protected $casts = [
        'start_date' => 'date',
        'end_date' => 'date',
        'settings' => 'array',
    ];

    // Relazioni
    public function organizer(): BelongsTo
    {
        return $this->belongsTo(User::class, 'organizer_id');
    }

    public function categories(): HasMany
    {
        return $this->hasMany(Category::class);
    }

    public function venues(): HasMany
    {
        return $this->hasMany(Venue::class);
    }

    // Scopes
    public function scopeActive($query)
    {
        return $query->where('status', '!=', 'cancelled');
    }

    public function scopeForOrganizer($query, $organizerId)
    {
        return $query->where('organizer_id', $organizerId);
    }

    public function scopeByStatus($query, $status)
    {
        return $query->where('status', $status);
    }

    // Metodi helper
    public function isDraft(): bool
    {
        return $this->status === 'draft';
    }

    public function isPublished(): bool
    {
        return $this->status === 'published';
    }

    public function isOngoing(): bool
    {
        return $this->status === 'ongoing';
    }

    public function isCompleted(): bool
    {
        return $this->status === 'completed';
    }

    public function getTotalTeamsAttribute(): int
    {
        return $this->categories->sum(function ($category) {
            return $category->teams->count();
        });
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

    public function getStatusDisplayAttribute(): string
    {
        return match($this->status) {
            'draft' => __('Bozza'),
            'published' => __('Pubblicato'),
            'ongoing' => __('In corso'),
            'completed' => __('Completato'),
            'cancelled' => __('Annullato'),
            default => $this->status,
        };
    }
}
