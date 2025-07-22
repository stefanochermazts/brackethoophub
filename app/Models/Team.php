<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Team extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'short_name',
        'description',
        'logo_path',
        'primary_color',
        'secondary_color',
        'category_id',
        'company_id',
        'coach_id',
        'status',
        'registration_date',
        'contact_info',
    ];

    protected $casts = [
        'registration_date' => 'datetime',
        'contact_info' => 'array',
    ];

    // Relazioni
    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    public function company(): BelongsTo
    {
        return $this->belongsTo(User::class, 'company_id');
    }

    public function coach(): BelongsTo
    {
        return $this->belongsTo(User::class, 'coach_id');
    }

    // Metodi helper
    public function getDisplayNameAttribute(): string
    {
        return $this->short_name ?: $this->name;
    }

    public function getStatusDisplayAttribute(): string
    {
        return match($this->status) {
            'registered' => __('Registrata'),
            'confirmed' => __('Confermata'),
            'withdrawn' => __('Ritirata'),
            'disqualified' => __('Squalificata'),
            default => $this->status,
        };
    }

    public function isActive(): bool
    {
        return in_array($this->status, ['registered', 'confirmed']);
    }

    public function getLogoUrlAttribute(): ?string
    {
        return $this->logo_path ? asset('storage/' . $this->logo_path) : null;
    }
}
