<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Str;

class AffiliateProgramme extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'programme_name',
        'description',
        'commission_rate',
        'minimum_payout',
        'payment_method',
        'terms_conditions',
        'referral_code',
        'total_referrals',
        'total_earnings',
        'pending_commission',
        'paid_commission',
        'status',
        'approved_at',
    ];

    protected $casts = [
        'terms_conditions' => 'array',
        'commission_rate' => 'decimal:2',
        'minimum_payout' => 'decimal:2',
        'total_earnings' => 'decimal:2',
        'pending_commission' => 'decimal:2',
        'paid_commission' => 'decimal:2',
        'approved_at' => 'datetime',
    ];

    /**
     * Boot the model.
     */
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            if (empty($model->referral_code)) {
                $model->referral_code = $model->generateReferralCode();
            }
        });
    }

    /**
     * Get the user that owns the affiliate programme.
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Generate a unique referral code.
     */
    private function generateReferralCode(): string
    {
        do {
            $code = strtoupper(Str::random(8));
        } while (self::where('referral_code', $code)->exists());

        return $code;
    }

    /**
     * Add a referral and update commission.
     */
    public function addReferral(float $amount): void
    {
        $commission = $amount * ($this->commission_rate / 100);
        
        $this->increment('total_referrals');
        $this->increment('total_earnings', $commission);
        $this->increment('pending_commission', $commission);
    }

    /**
     * Process payout.
     */
    public function processPayout(float $amount): void
    {
        $this->decrement('pending_commission', $amount);
        $this->increment('paid_commission', $amount);
    }

    /**
     * Check if eligible for payout.
     */
    public function isEligibleForPayout(): bool
    {
        return $this->pending_commission >= $this->minimum_payout;
    }

    /**
     * Approve the affiliate programme.
     */
    public function approve(): void
    {
        $this->update([
            'status' => 'active',
            'approved_at' => now(),
        ]);
    }

    /**
     * Scope a query to only include active programmes.
     */
    public function scopeActive($query)
    {
        return $query->where('status', 'active');
    }

    /**
     * Scope a query to only include approved programmes.
     */
    public function scopeApproved($query)
    {
        return $query->whereNotNull('approved_at');
    }
}
