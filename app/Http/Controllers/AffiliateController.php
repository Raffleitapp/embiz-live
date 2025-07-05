<?php

namespace App\Http\Controllers;

use App\Models\AffiliateProgramme;
use App\Models\Profile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class AffiliateController extends Controller
{
    use AuthorizesRequests;

    /**
     * Display the affiliate page.
     */
    public function index()
    {
        $user = Auth::user();
        
        // Get affiliate programme if exists
        $affiliateProgramme = $user->affiliateProgramme;
        
        // Get affiliate partners (founding members)
        $affiliatePartners = Profile::with('user')
                                   ->foundingMembers()
                                   ->active()
                                   ->limit(10)
                                   ->get();
        
        // Get recommended profiles for networking
        $recommendations = Profile::with('user')
                                 ->active()
                                 ->where('user_id', '!=', $user->id)
                                 ->inRandomOrder()
                                 ->limit(3)
                                 ->get();
        
        return view('affiliate', compact('affiliateProgramme', 'affiliatePartners', 'recommendations'));
    }

    /**
     * Join the affiliate programme.
     */
    public function join(Request $request)
    {
        $request->validate([
            'programme_name' => 'required|string|max:255',
            'description' => 'required|string|max:1000',
            'commission_rate' => 'required|numeric|min:0|max:100',
            'minimum_payout' => 'required|numeric|min:0',
            'payment_method' => 'required|string|max:255',
            'terms_conditions' => 'nullable|array',
        ]);

        $user = Auth::user();

        // Check if user already has an affiliate programme
        if ($user->affiliateProgramme) {
            return response()->json([
                'message' => 'You already have an affiliate programme.'
            ], 400);
        }

        $affiliateProgramme = AffiliateProgramme::create([
            'user_id' => $user->id,
            'programme_name' => $request->programme_name,
            'description' => $request->description,
            'commission_rate' => $request->commission_rate,
            'minimum_payout' => $request->minimum_payout,
            'payment_method' => $request->payment_method,
            'terms_conditions' => $request->terms_conditions ?? [],
            'status' => 'active',
        ]);

        return response()->json([
            'message' => 'Successfully joined the affiliate programme!',
            'programme' => $affiliateProgramme
        ]);
    }

    /**
     * Update affiliate programme settings.
     */
    public function update(Request $request, AffiliateProgramme $affiliateProgramme)
    {
        $this->authorize('update', $affiliateProgramme);

        $request->validate([
            'programme_name' => 'required|string|max:255',
            'description' => 'required|string|max:1000',
            'commission_rate' => 'required|numeric|min:0|max:100',
            'minimum_payout' => 'required|numeric|min:0',
            'payment_method' => 'required|string|max:255',
            'terms_conditions' => 'nullable|array',
        ]);

        $affiliateProgramme->update([
            'programme_name' => $request->programme_name,
            'description' => $request->description,
            'commission_rate' => $request->commission_rate,
            'minimum_payout' => $request->minimum_payout,
            'payment_method' => $request->payment_method,
            'terms_conditions' => $request->terms_conditions ?? [],
        ]);

        return response()->json([
            'message' => 'Affiliate programme updated successfully!',
            'programme' => $affiliateProgramme
        ]);
    }

    /**
     * Get affiliate programme statistics.
     */
    public function getStats()
    {
        $user = Auth::user();
        $programme = $user->affiliateProgramme;

        if (!$programme) {
            return response()->json([
                'message' => 'No affiliate programme found.'
            ], 404);
        }

        return response()->json([
            'programme' => $programme,
            'stats' => [
                'total_referrals' => $programme->total_referrals,
                'total_earnings' => $programme->total_earnings,
                'pending_commission' => $programme->pending_commission,
                'paid_commission' => $programme->paid_commission,
                'is_eligible_for_payout' => $programme->isEligibleForPayout(),
            ]
        ]);
    }

    /**
     * Process a referral.
     */
    public function processReferral(Request $request, AffiliateProgramme $affiliateProgramme)
    {
        $request->validate([
            'amount' => 'required|numeric|min:0',
            'referral_details' => 'nullable|string|max:500',
        ]);

        $affiliateProgramme->addReferral($request->amount);

        return response()->json([
            'message' => 'Referral processed successfully!',
            'programme' => $affiliateProgramme->fresh()
        ]);
    }

    /**
     * Request payout.
     */
    public function requestPayout(Request $request, AffiliateProgramme $affiliateProgramme)
    {
        $this->authorize('update', $affiliateProgramme);

        $request->validate([
            'amount' => 'required|numeric|min:0',
        ]);

        $amount = $request->amount;

        if ($amount > $affiliateProgramme->pending_commission) {
            return response()->json([
                'message' => 'Requested amount exceeds pending commission.'
            ], 400);
        }

        if (!$affiliateProgramme->isEligibleForPayout()) {
            return response()->json([
                'message' => 'Minimum payout amount not reached.'
            ], 400);
        }

        // In a real application, you would integrate with a payment processor
        // For now, we'll just update the records
        $affiliateProgramme->processPayout($amount);

        return response()->json([
            'message' => 'Payout processed successfully!',
            'programme' => $affiliateProgramme->fresh()
        ]);
    }

    /**
     * Get affiliate partners.
     */
    public function getPartners()
    {
        $partners = Profile::with('user')
                          ->foundingMembers()
                          ->active()
                          ->verified()
                          ->orderBy('profile_views', 'desc')
                          ->paginate(12);

        return response()->json($partners);
    }

    /**
     * Express interest in affiliate programme.
     */
    public function expressInterest(Request $request)
    {
        $request->validate([
            'message' => 'nullable|string|max:500',
            'contact_method' => 'nullable|string|max:255',
        ]);

        $user = Auth::user();

        // Here you would typically send an email or create a notification
        // For now, we'll just return a success response
        
        return response()->json([
            'message' => 'Thank you for your interest! We will contact you soon.',
            'user' => $user->load('profile')
        ]);
    }

    /**
     * Get affiliate programme by referral code.
     */
    public function getByReferralCode($referralCode)
    {
        $programme = AffiliateProgramme::where('referral_code', $referralCode)
                                      ->active()
                                      ->with('user.profile')
                                      ->first();

        if (!$programme) {
            return response()->json([
                'message' => 'Invalid referral code.'
            ], 404);
        }

        return response()->json($programme);
    }
}
