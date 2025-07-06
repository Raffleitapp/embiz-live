<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class MessageInterest extends Model
{
    use HasFactory;

    protected $fillable = [
        'message_id',
        'user_id',
        'interest_level',
        'response_type',
        'comments',
        'investment_amount',
        'responded_at',
    ];

    protected $casts = [
        'responded_at' => 'datetime',
        'investment_amount' => 'decimal:2',
    ];

    /**
     * Get the message that owns the interest.
     */
    public function message(): BelongsTo
    {
        return $this->belongsTo(Message::class);
    }

    /**
     * Get the user that owns the interest.
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Scope a query to only include interested responses.
     */
    public function scopeInterested($query)
    {
        return $query->where('response_type', 'interested');
    }

    /**
     * Scope a query to only include not interested responses.
     */
    public function scopeNotInterested($query)
    {
        return $query->where('response_type', 'not_interested');
    }

    /**
     * Scope a query to only include founding members.
     */
    public function scopeFoundingMembers($query)
    {
        return $query->whereHas('user.profile', function ($q) {
            $q->where('is_founding_member', true);
        });
    }

    /**
     * Get the interest level display name.
     */
    public function getInterestLevelDisplayAttribute()
    {
        return match($this->interest_level) {
            'high' => 'High Interest',
            'medium' => 'Medium Interest',
            'low' => 'Low Interest',
            default => 'Unknown'
        };
    }
}
