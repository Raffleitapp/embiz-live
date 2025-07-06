<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Message extends Model
{
    use HasFactory;

    protected $fillable = [
        'sender_id',
        'recipient_id',
        'subject',
        'message',
        'message_type',
        'investment_amount',
        'investment_currency',
        'read_at',
        'is_important',
        'is_archived',
        'thread_id',
        'attachments',
    ];

    protected $casts = [
        'read_at' => 'datetime',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
        'is_important' => 'boolean',
        'is_archived' => 'boolean',
        'attachments' => 'array',
        'investment_amount' => 'decimal:2',
    ];

    /**
     * Get the sender of the message.
     */
    public function sender(): BelongsTo
    {
        return $this->belongsTo(User::class, 'sender_id');
    }

    /**
     * Get the recipient of the message.
     */
    public function recipient(): BelongsTo
    {
        return $this->belongsTo(User::class, 'recipient_id');
    }

    /**
     * Mark the message as read.
     */
    public function markAsRead(): void
    {
        $this->update(['read_at' => now()]);
    }

    /**
     * Mark the message as important.
     */
    public function markAsImportant(): void
    {
        $this->update(['is_important' => true]);
    }

    /**
     * Archive the message.
     */
    public function archive(): void
    {
        $this->update(['is_archived' => true]);
    }

    /**
     * Unarchive the message.
     */
    public function unarchive(): void
    {
        $this->update(['is_archived' => false]);
    }

    /**
     * Check if the message is read.
     */
    public function isRead(): bool
    {
        return !is_null($this->read_at);
    }

    /**
     * Check if the message is unread.
     */
    public function isUnread(): bool
    {
        return is_null($this->read_at);
    }

    /**
     * Scope a query to only include unread messages.
     */
    public function scopeUnread($query)
    {
        return $query->whereNull('read_at');
    }

    /**
     * Scope a query to only include read messages.
     */
    public function scopeRead($query)
    {
        return $query->whereNotNull('read_at');
    }

    /**
     * Scope a query to only include important messages.
     */
    public function scopeImportant($query)
    {
        return $query->where('is_important', true);
    }

    /**
     * Scope a query to only include archived messages.
     */
    public function scopeArchived($query)
    {
        return $query->where('is_archived', true);
    }

    /**
     * Scope a query to only include non-archived messages.
     */
    public function scopeNotArchived($query)
    {
        return $query->where('is_archived', false);
    }

    /**
     * Scope a query to filter by thread.
     */
    public function scopeInThread($query, $threadId)
    {
        return $query->where('thread_id', $threadId);
    }

    /**
     * Get the interests for this message.
     */
    public function interests()
    {
        return $this->hasMany(MessageInterest::class);
    }

    /**
     * Get interested responses for this message.
     */
    public function interestedResponses()
    {
        return $this->hasMany(MessageInterest::class)->interested();
    }

    /**
     * Get not interested responses for this message.
     */
    public function notInterestedResponses()
    {
        return $this->hasMany(MessageInterest::class)->notInterested();
    }

    /**
     * Get founding member responses for this message.
     */
    public function foundingMemberResponses()
    {
        return $this->hasMany(MessageInterest::class)->foundingMembers();
    }

    /**
     * Check if this message is an investment post.
     */
    public function isInvestmentPost()
    {
        return $this->sender && $this->sender->isAdmin();
    }

    /**
     * Get response statistics for this message.
     */
    public function getResponseStats()
    {
        $totalResponses = $this->interests()->count();
        $interestedCount = $this->interestedResponses()->count();
        $notInterestedCount = $this->notInterestedResponses()->count();
        $foundingMemberInterested = $this->foundingMemberResponses()->interested()->count();
        $foundingMemberTotal = $this->foundingMemberResponses()->count();
        
        return [
            'total_responses' => $totalResponses,
            'interested_count' => $interestedCount,
            'not_interested_count' => $notInterestedCount,
            'founding_member_interested' => $foundingMemberInterested,
            'founding_member_total' => $foundingMemberTotal,
            'interest_rate' => $totalResponses > 0 ? ($interestedCount / $totalResponses) * 100 : 0,
            'founding_member_interest_rate' => $foundingMemberTotal > 0 ? ($foundingMemberInterested / $foundingMemberTotal) * 100 : 0,
        ];
    }
}
