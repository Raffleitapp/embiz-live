<?php

namespace App\Http\Controllers;

use App\Models\Profile;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class UserProfileController extends Controller
{
    /**
     * Display the user's profile.
     */
    public function show(User $user)
    {
        $user->load('profile');
        
        // Increment profile views if not viewing own profile
        if (Auth::id() !== $user->id && $user->profile) {
            $user->profile->incrementViews();
        }

        return view('user-profile', compact('user'));
    }

    /**
     * Show the form for editing the user's profile.
     */
    public function edit()
    {
        $user = Auth::user();
        $user->load('profile');
        
        return view('profile.edit', compact('user'));
    }

    /**
     * Update the user's profile.
     */
    public function update(Request $request)
    {
        $user = Auth::user();
        
        $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'title' => 'nullable|string|max:255',
            'company' => 'nullable|string|max:255',
            'bio' => 'nullable|string|max:1000',
            'location' => 'nullable|string|max:255',
            'website' => 'nullable|url|max:255',
            'linkedin' => 'nullable|url|max:255',
            'twitter' => 'nullable|url|max:255',
            'avatar' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'profile_type' => 'required|in:entrepreneur,investor,affiliate,advisor',
            'interests' => 'nullable|array',
            'skills' => 'nullable|array',
        ]);

        $profileData = $request->only([
            'first_name', 'last_name', 'title', 'company', 'bio', 'location',
            'website', 'linkedin', 'twitter', 'profile_type', 'interests', 'skills'
        ]);

        // Handle avatar upload
        if ($request->hasFile('avatar')) {
            // Delete old avatar if exists
            if ($user->profile && $user->profile->avatar) {
                Storage::disk('public')->delete($user->profile->avatar);
            }
            
            $path = $request->file('avatar')->store('avatars', 'public');
            $profileData['avatar'] = $path;
        }

        // Create or update profile
        if ($user->profile) {
            $user->profile->update($profileData);
        } else {
            $user->profile()->create($profileData);
        }

        return redirect()->route('profile.edit')->with('success', 'Profile updated successfully!');
    }

    /**
     * Get profile data for API.
     */
    public function getProfile(User $user)
    {
        $user->load('profile');
        
        return response()->json([
            'user' => $user,
            'profile' => $user->profile,
        ]);
    }

    /**
     * Search profiles.
     */
    public function search(Request $request)
    {
        $query = $request->get('q');
        $profileType = $request->get('type');
        $location = $request->get('location');
        $verified = $request->get('verified');

        $profiles = Profile::with('user')
            ->active()
            ->when($query, function ($queryBuilder) use ($query) {
                $queryBuilder->where(function ($q) use ($query) {
                    $q->where('first_name', 'like', "%{$query}%")
                      ->orWhere('last_name', 'like', "%{$query}%")
                      ->orWhere('company', 'like', "%{$query}%")
                      ->orWhere('title', 'like', "%{$query}%")
                      ->orWhere('bio', 'like', "%{$query}%");
                });
            })
            ->when($profileType, function ($queryBuilder) use ($profileType) {
                $queryBuilder->where('profile_type', $profileType);
            })
            ->when($location, function ($queryBuilder) use ($location) {
                $queryBuilder->where('location', 'like', "%{$location}%");
            })
            ->when($verified, function ($queryBuilder) {
                $queryBuilder->verified();
            })
            ->orderBy('profile_views', 'desc')
            ->paginate(12);

        return response()->json($profiles);
    }

    /**
     * Get recommended profiles for networking.
     */
    public function getRecommendations()
    {
        $user = Auth::user();
        $user->load('profile');

        // Get profiles with similar interests or profile type
        $recommendations = Profile::with('user')
            ->active()
            ->where('user_id', '!=', $user->id)
            ->when($user->profile && $user->profile->interests, function ($query) use ($user) {
                $interests = $user->profile->interests;
                $query->where(function ($q) use ($interests) {
                    foreach ($interests as $interest) {
                        $q->orWhereJsonContains('interests', $interest);
                    }
                });
            })
            ->when($user->profile && $user->profile->profile_type, function ($query) use ($user) {
                // Recommend complementary profile types
                $complementaryTypes = [
                    'entrepreneur' => ['investor', 'advisor'],
                    'investor' => ['entrepreneur'],
                    'affiliate' => ['entrepreneur', 'investor'],
                    'advisor' => ['entrepreneur']
                ];
                
                $types = $complementaryTypes[$user->profile->profile_type] ?? [];
                if (!empty($types)) {
                    $query->whereIn('profile_type', $types);
                }
            })
            ->inRandomOrder()
            ->limit(6)
            ->get();

        return response()->json($recommendations);
    }
}
