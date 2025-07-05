<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Profile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

class DashboardController extends Controller
{
    /**
     * Display the dashboard.
     */
    public function index()
    {
        $totalUsers = User::count();
        $activeUsers = User::whereHas('profile', function ($query) {
            $query->where('is_active', true);
        })->count();
        $foundingMembers = User::whereHas('profile', function ($query) {
            $query->where('is_founding_member', true);
        })->count();
        
        // Get opportunities count
        $totalOpportunities = \App\Models\Opportunity::count();
        $activeOpportunities = \App\Models\Opportunity::where('status', 'active')->count();
        
        // Get recent users for the table (limit to 10 for dashboard)
        $users = User::with('profile')->orderBy('created_at', 'desc')->limit(10)->get();
        
        return view('dashboard', compact('totalUsers', 'activeUsers', 'foundingMembers', 'totalOpportunities', 'activeOpportunities', 'users'));
    }

    /**
     * Show all members.
     */
    public function members()
    {
        $users = User::with('profile')->orderBy('created_at', 'desc')->paginate(20);
        
        return view('members.index', compact('users'));
    }

    /**
     * Show the add member form.
     */
    public function addMember()
    {
        return view('members.add');
    }

    /**
     * Store a new member.
     */
    public function storeMember(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:8',
            'role' => 'required|string|in:User,Founding Member,Admin',
            'send_notification' => 'boolean',
        ]);

        // Create user
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'email_verified_at' => now(),
        ]);

        // Create profile
        $profileData = [
            'first_name' => explode(' ', $request->name)[0],
            'last_name' => explode(' ', $request->name)[1] ?? '',
            'profile_type' => 'entrepreneur',
            'is_founding_member' => $request->role === 'Founding Member',
            'is_verified' => true,
            'is_active' => true,
        ];

        $user->profile()->create($profileData);

        // Send notification email if requested
        if ($request->send_notification) {
            // In a real app, you would send an email here
            // Mail::to($user->email)->send(new WelcomeEmail($user, $request->password));
        }

        return redirect()->route('dashboard.members')->with('success', 'Member added successfully!');
    }

    /**
     * Generate a random password.
     */
    public function generatePassword()
    {
        $password = Str::random(12);
        
        return response()->json([
            'password' => $password
        ]);
    }

    /**
     * Update user role.
     */
    public function updateUserRole(Request $request, User $user)
    {
        $request->validate([
            'role' => 'required|string|in:User,Founding Member,Admin',
        ]);

        if ($user->profile) {
            $user->profile->update([
                'is_founding_member' => $request->role === 'Founding Member',
            ]);
        }

        return response()->json([
            'message' => 'User role updated successfully!',
            'user' => $user->load('profile')
        ]);
    }

    /**
     * Toggle user status.
     */
    public function toggleUserStatus(User $user)
    {
        if ($user->profile) {
            $user->profile->update([
                'is_active' => !$user->profile->is_active
            ]);
        }

        return response()->json([
            'message' => 'User status updated successfully!',
            'user' => $user->load('profile')
        ]);
    }

    /**
     * Delete a user.
     */
    public function deleteUser(User $user)
    {
        $user->delete();

        return response()->json([
            'message' => 'User deleted successfully!'
        ]);
    }

    /**
     * Search members.
     */
    public function searchMembers(Request $request)
    {
        $query = $request->get('q');
        
        $users = User::with('profile')
            ->where(function ($queryBuilder) use ($query) {
                $queryBuilder->where('name', 'like', "%{$query}%")
                             ->orWhere('email', 'like', "%{$query}%");
            })
            ->orderBy('created_at', 'desc')
            ->get();

        return response()->json($users);
    }
}
