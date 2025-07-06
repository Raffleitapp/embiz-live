<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Carbon\Carbon;

class Opportunity extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'title',
        'description',
        'type',
        'amount',
        'currency',
        'location',
        'industry',
        'stage',
        'requirements',
        'contact_info',
        'contact_email',
        'contact_phone',
        'website',
        'image',
        'deadline',
        'status',
        'is_featured',
        'views',
        'applications',
    ];

    protected $casts = [
        'amount' => 'decimal:2',
        'deadline' => 'datetime',
        'is_featured' => 'boolean',
    ];

    /**
     * Get the user that owns the opportunity.
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Increment opportunity views.
     */
    public function incrementViews(): void
    {
        $this->increment('views');
    }

    /**
     * Increment opportunity applications.
     */
    public function incrementApplications(): void
    {
        $this->increment('applications');
    }

    /**
     * Scope a query to only include active opportunities.
     */
    public function scopeActive($query)
    {
        return $query->where('status', 'active');
    }

    /**
     * Scope a query to only include featured opportunities.
     */
    public function scopeFeatured($query)
    {
        return $query->where('is_featured', true);
    }

    /**
     * Scope a query to filter by type.
     */
    public function scopeOfType($query, $type)
    {
        return $query->where('type', $type);
    }

    /**
     * Scope a query to filter by location.
     */
    public function scopeInLocation($query, $location)
    {
        return $query->where('location', 'like', '%' . $location . '%');
    }

    /**
     * Scope a query to filter by industry.
     */
    public function scopeInIndustry($query, $industry)
    {
        return $query->where('industry', 'like', '%' . $industry . '%');
    }

    /**
     * Check if the opportunity is still active based on deadline.
     */
    public function isExpired(): bool
    {
        return $this->deadline && now()->isAfter($this->deadline);
    }
}
