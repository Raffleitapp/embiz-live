<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Profile;
use App\Models\ActivityLog;
use App\Models\Role;
use App\Models\Permission;
use App\Models\SupportTicket;
use App\Models\SystemSetting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Auth;
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
        $roles = Role::all();
        return view('members.add', compact('roles'));
    }

    /**
     * Store a new member.
     */
    public function storeMember(Request $request)
    {
        $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:8',
            'role' => 'required|exists:roles,id',
            'send_notification' => 'boolean',
        ]);

        // Create user
        $user = User::create([
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role_id' => $request->role,
            'email_verified_at' => now(),
        ]);

        // Get the role
        $role = Role::find($request->role);

        // Create profile
        $profileData = [
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'profile_type' => 'entrepreneur',
            'is_founding_member' => $role->name === 'founding_member',
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

    /**
     * Show settings page.
     */
    public function settings()
    {
        $settings = SystemSetting::all()->keyBy('key');
        
        return view('dashboard.settings', compact('settings'));
    }

    /**
     * Update settings.
     */
    public function updateSettings(Request $request)
    {
        $request->validate([
            'site_name' => 'required|string|max:255',
            'site_description' => 'nullable|string|max:1000',
            'admin_email' => 'required|email',
            'notifications_enabled' => 'boolean',
            'maintenance_mode' => 'boolean',
        ]);

        // Update settings
        SystemSetting::setValue('site_name', $request->site_name);
        SystemSetting::setValue('site_description', $request->site_description);
        SystemSetting::setValue('admin_email', $request->admin_email);
        SystemSetting::setValue('notifications_enabled', $request->boolean('notifications_enabled'), 'boolean');
        SystemSetting::setValue('maintenance_mode', $request->boolean('maintenance_mode'), 'boolean');

        return redirect()->route('dashboard.settings')->with('success', 'Settings updated successfully!');
    }

    /**
     * Show activity logs.
     */
    public function activityLogs()
    {
        $activities = ActivityLog::with('user')
            ->orderBy('created_at', 'desc')
            ->paginate(20);

        return view('dashboard.activity-logs', compact('activities'));
    }

    /**
     * Show roles and permissions.
     */
    public function rolesPermissions()
    {
        $roles = Role::with('permissions')->withCount('users')->get();
        $permissions = Permission::all()->groupBy('group');

        return view('dashboard.roles-permissions', compact('roles', 'permissions'));
    }

    /**
     * Create new role.
     */
    public function createRole(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:roles,name',
            'description' => 'nullable|string|max:1000',
            'permissions' => 'array',
        ]);

        // Create the role
        $role = Role::create([
            'name' => strtolower(str_replace(' ', '_', $request->name)),
            'display_name' => $request->name,
            'description' => $request->description,
        ]);

        // Attach permissions if provided
        if ($request->permissions) {
            $permissionIds = Permission::whereIn('id', $request->permissions)->pluck('id');
            $role->permissions()->sync($permissionIds);
        }

        return redirect()->route('dashboard.roles-permissions')->with('success', 'Role created successfully!');
    }

    /**
     * Update role.
     */
    public function updateRole(Request $request, $roleId)
    {
        $role = Role::findOrFail($roleId);
        
        $request->validate([
            'name' => 'required|string|max:255|unique:roles,name,' . $role->id,
            'description' => 'nullable|string|max:1000',
            'permissions' => 'array',
        ]);

        // Update the role
        $role->update([
            'name' => strtolower(str_replace(' ', '_', $request->name)),
            'display_name' => $request->name,
            'description' => $request->description,
        ]);

        // Sync permissions if provided
        if ($request->has('permissions')) {
            $permissionIds = Permission::whereIn('id', $request->permissions)->pluck('id');
            $role->permissions()->sync($permissionIds);
        }

        return redirect()->route('dashboard.roles-permissions')->with('success', 'Role updated successfully!');
    }

    /**
     * Delete role.
     */
    public function deleteRole($roleId)
    {
        $role = Role::findOrFail($roleId);
        
        // Don't allow deletion of system roles
        if (in_array($role->name, ['super_admin', 'admin', 'user'])) {
            return response()->json(['success' => false, 'message' => 'Cannot delete system roles.']);
        }

        // Check if role has users
        if ($role->users()->count() > 0) {
            return response()->json(['success' => false, 'message' => 'Cannot delete role with assigned users.']);
        }

        $role->delete();

        return response()->json(['success' => true, 'message' => 'Role deleted successfully!']);
    }

    /**
     * Edit role.
     */
    public function editRole($roleId)
    {
        $role = Role::with('permissions')->findOrFail($roleId);
        $permissions = Permission::all()->groupBy('group');
        
        return response()->json([
            'role' => $role,
            'permissions' => $permissions->toArray()
        ]);
    }

    /**
     * Show support page.
     */
    public function support()
    {
        $tickets = SupportTicket::with(['user', 'assignedTo'])
            ->orderBy('created_at', 'desc')
            ->paginate(20);

        return view('dashboard.support', compact('tickets'));
    }

    /**
     * Create support ticket.
     */
    public function createSupportTicket(Request $request)
    {
        $request->validate([
            'subject' => 'required|string|max:255',
            'priority' => 'required|in:Low,Medium,High,Critical',
            'category' => 'required|string',
            'description' => 'required|string|min:10',
        ]);

        SupportTicket::create([
            'subject' => $request->subject,
            'priority' => $request->priority,
            'category' => $request->category,
            'description' => $request->description,
            'user_id' => Auth::id(),
        ]);

        // Log the activity
        Auth::user()->logActivity('Created support ticket', 'Support ticket: ' . $request->subject, 'support');

        return redirect()->route('dashboard.support')->with('success', 'Support ticket created successfully! Our team will respond within 24 hours.');
    }
}
