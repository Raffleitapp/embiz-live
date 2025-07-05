<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Profile extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'first_name',
        'last_name',
        'title',
        'company',
        'bio',
        'location',
        'website',
        'linkedin',
        'twitter',
        'avatar',
        'profile_type',
        'profile_views',
        'portfolio_count',
        'interests',
        'skills',
        'is_founding_member',
        'is_verified',
        'is_active',
    ];

    protected $casts = [
        'interests' => 'array',
        'skills' => 'array',
        'is_founding_member' => 'boolean',
        'is_verified' => 'boolean',
        'is_active' => 'boolean',
    ];

    /**
     * Get the user that owns the profile.
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the full name of the profile owner.
     */
    public function getFullNameAttribute(): string
    {
        return $this->first_name . ' ' . $this->last_name;
    }

    /**
     * Increment profile views.
     */
    public function incrementViews(): void
    {
        $this->increment('profile_views');
    }

    /**
     * Scope a query to only include verified profiles.
     */
    public function scopeVerified($query)
    {
        return $query->where('is_verified', true);
    }

    /**
     * Scope a query to only include founding members.
     */
    public function scopeFoundingMembers($query)
    {
        return $query->where('is_founding_member', true);
    }

    /**
     * Scope a query to only include active profiles.
     */
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }
}
