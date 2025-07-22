<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Venue extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'address',
        'city',
        'postal_code',
        'phone',
        'description',
        'facilities',
        'capacity',
        'latitude',
        'longitude',
        'tournament_id',
        'availability',
        'is_active',
    ];

    protected $casts = [
        'facilities' => 'array',
        'availability' => 'array',
        'is_active' => 'boolean',
        'latitude' => 'decimal:8',
        'longitude' => 'decimal:8',
    ];

    // Relazioni
    public function tournament(): BelongsTo
    {
        return $this->belongsTo(Tournament::class);
    }

    // Metodi helper
    public function getFullAddressAttribute(): string
    {
        $address = $this->address;
        if ($this->city) {
            $address .= ', ' . $this->city;
        }
        if ($this->postal_code) {
            $address .= ' ' . $this->postal_code;
        }
        return $address;
    }

    public function hasCoordinates(): bool
    {
        return !is_null($this->latitude) && !is_null($this->longitude);
    }

    public function getAvailabilityForDay(string $day): array
    {
        if (!$this->availability || !isset($this->availability[$day])) {
            return [];
        }
        return $this->availability[$day];
    }

    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    public function scopeInCity($query, string $city)
    {
        return $query->where('city', 'like', "%{$city}%");
    }
}
