<?php

namespace App\Http\Controllers;

use App\Models\Opportunity;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class OpportunityController extends Controller
{
    use AuthorizesRequests;
    /**
     * Display a listing of opportunities.
     */
    public function index(Request $request)
    {
        $query = Opportunity::with(['user', 'user.profile'])->active();

        // Apply filters
        if ($request->filled('search')) {
            $search = $request->get('search');
            $query->where(function ($q) use ($search) {
                $q->where('title', 'like', "%{$search}%")
                  ->orWhere('description', 'like', "%{$search}%")
                  ->orWhere('industry', 'like', "%{$search}%");
            });
        }

        if ($request->filled('type')) {
            $query->ofType($request->get('type'));
        }

        if ($request->filled('location')) {
            $query->inLocation($request->get('location'));
        }

        if ($request->filled('industry')) {
            $query->inIndustry($request->get('industry'));
        }

        if ($request->filled('min_amount')) {
            $query->where('amount', '>=', $request->get('min_amount'));
        }

        if ($request->filled('max_amount')) {
            $query->where('amount', '<=', $request->get('max_amount'));
        }

        $opportunities = $query->orderBy('is_featured', 'desc')
                              ->orderBy('created_at', 'desc')
                              ->paginate(12);

        return view('opportunities.index', compact('opportunities'));
    }

    /**
     * Show the form for creating a new opportunity.
     */
    public function create()
    {
        return view('opportunities.create');
    }

    /**
     * Store a newly created opportunity.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'type' => 'required|in:investment,funding,partnership,mentorship,grant',
            'amount' => 'nullable|numeric|min:0',
            'currency' => 'nullable|string|size:3',
            'location' => 'nullable|string|max:255',
            'industry' => 'nullable|string|max:255',
            'stage' => 'nullable|in:idea,startup,growth,established',
            'requirements' => 'nullable|string|max:2000',
            'contact_email' => 'nullable|email|max:255',
            'contact_phone' => 'nullable|string|max:20',
            'website' => 'nullable|url|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'deadline' => 'nullable|date|after:today',
            'status' => 'nullable|in:active,paused,closed,draft',
        ]);

        $data = $request->only([
            'title', 'description', 'type', 'amount', 'currency', 'location',
            'industry', 'stage', 'requirements', 'contact_email', 'contact_phone',
            'website', 'deadline', 'status'
        ]);

        $data['user_id'] = Auth::id();

        // Handle image upload
        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('opportunities', 'public');
            $data['image'] = $path;
        }

        $opportunity = Opportunity::create($data);

        return redirect()->route('dashboard.opportunities.show', $opportunity)->with('success', 'Opportunity created successfully!');
    }

    /**
     * Display the specified opportunity.
     */
    public function show(Opportunity $opportunity)
    {
        $opportunity->load(['user', 'user.profile']);
        
        // Increment views if not viewing own opportunity
        if (Auth::id() !== $opportunity->user_id) {
            $opportunity->incrementViews();
        }

        return view('opportunities.show', compact('opportunity'));
    }

    /**
     * Show the form for editing the specified opportunity.
     */
    public function edit(Opportunity $opportunity)
    {
        $this->authorize('update', $opportunity);
        
        return view('opportunities.edit', compact('opportunity'));
    }

    /**
     * Update the specified opportunity.
     */
    public function update(Request $request, Opportunity $opportunity)
    {
        $this->authorize('update', $opportunity);

        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'type' => 'required|in:investment,funding,partnership,mentorship,grant',
            'amount' => 'nullable|numeric|min:0',
            'currency' => 'nullable|string|size:3',
            'location' => 'nullable|string|max:255',
            'industry' => 'nullable|string|max:255',
            'stage' => 'nullable|in:idea,startup,growth,established',
            'requirements' => 'nullable|string|max:2000',
            'contact_email' => 'nullable|email|max:255',
            'contact_phone' => 'nullable|string|max:20',
            'website' => 'nullable|url|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'deadline' => 'nullable|date|after:today',
            'status' => 'nullable|in:active,paused,closed,draft',
        ]);

        $data = $request->only([
            'title', 'description', 'type', 'amount', 'currency', 'location',
            'industry', 'stage', 'requirements', 'contact_email', 'contact_phone',
            'website', 'deadline', 'status'
        ]);

        // Handle image upload
        if ($request->hasFile('image')) {
            // Delete old image if exists
            if ($opportunity->image) {
                Storage::disk('public')->delete($opportunity->image);
            }
            
            $path = $request->file('image')->store('opportunities', 'public');
            $data['image'] = $path;
        }

        $opportunity->update($data);

        return redirect()->route('opportunities.show', $opportunity)->with('success', 'Opportunity updated successfully!');
    }

    /**
     * Remove the specified opportunity.
     */
    public function destroy(Opportunity $opportunity)
    {
        $this->authorize('delete', $opportunity);

        // Delete associated image
        if ($opportunity->image) {
            Storage::disk('public')->delete($opportunity->image);
        }

        $opportunity->delete();

        return redirect()->route('opportunities.index')->with('success', 'Opportunity deleted successfully!');
    }

    /**
     * Get featured opportunities.
     */
    public function featured()
    {
        $opportunities = Opportunity::with(['user', 'user.profile'])
                                   ->active()
                                   ->featured()
                                   ->orderBy('created_at', 'desc')
                                   ->limit(6)
                                   ->get();

        return response()->json($opportunities);
    }

    /**
     * Apply to an opportunity.
     */
    public function apply(Request $request, Opportunity $opportunity)
    {
        $request->validate([
            'message' => 'required|string|max:1000',
            'contact_email' => 'required|email',
            'contact_phone' => 'nullable|string|max:20',
        ]);

        // Here you would typically create an application record
        // For now, we'll just increment the applications counter
        $opportunity->incrementApplications();

        return redirect()->route('opportunities.show', $opportunity)->with('success', 'Application submitted successfully!');
    }

    /**
     * Get user's opportunities.
     */
    public function myOpportunities()
    {
        $opportunities = Opportunity::where('user_id', Auth::id())
                                   ->with(['user', 'user.profile'])
                                   ->orderBy('created_at', 'desc')
                                   ->paginate(10);

        return view('opportunities.my-opportunities', compact('opportunities'));
    }
}
