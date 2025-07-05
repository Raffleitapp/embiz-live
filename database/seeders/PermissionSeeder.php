<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Permission;
use App\Models\Role;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $permissions = [
            // User Management
            ['name' => 'manage_users', 'display_name' => 'Manage Users', 'description' => 'Create, edit, and delete users', 'group' => 'user_management'],
            ['name' => 'view_users', 'display_name' => 'View Users', 'description' => 'View user profiles and data', 'group' => 'user_management'],
            ['name' => 'edit_users', 'display_name' => 'Edit Users', 'description' => 'Edit user profiles', 'group' => 'user_management'],
            ['name' => 'delete_users', 'display_name' => 'Delete Users', 'description' => 'Delete user accounts', 'group' => 'user_management'],
            
            // Content Management
            ['name' => 'manage_content', 'display_name' => 'Manage Content', 'description' => 'Create, edit, and delete content', 'group' => 'content_management'],
            ['name' => 'view_content', 'display_name' => 'View Content', 'description' => 'View all content', 'group' => 'content_management'],
            ['name' => 'edit_content', 'display_name' => 'Edit Content', 'description' => 'Edit content', 'group' => 'content_management'],
            ['name' => 'delete_content', 'display_name' => 'Delete Content', 'description' => 'Delete content', 'group' => 'content_management'],
            
            // Messaging
            ['name' => 'send_messages', 'display_name' => 'Send Messages', 'description' => 'Send messages to other users', 'group' => 'messaging'],
            ['name' => 'view_messages', 'display_name' => 'View Messages', 'description' => 'View messages', 'group' => 'messaging'],
            ['name' => 'manage_messages', 'display_name' => 'Manage Messages', 'description' => 'Manage all messages in the system', 'group' => 'messaging'],
            
            // System Management
            ['name' => 'view_dashboard', 'display_name' => 'View Dashboard', 'description' => 'Access dashboard', 'group' => 'system'],
            ['name' => 'manage_settings', 'display_name' => 'Manage Settings', 'description' => 'Manage system settings', 'group' => 'system'],
            ['name' => 'view_logs', 'display_name' => 'View Logs', 'description' => 'View system logs', 'group' => 'system'],
            ['name' => 'manage_roles', 'display_name' => 'Manage Roles', 'description' => 'Manage user roles and permissions', 'group' => 'system'],
            ['name' => 'manage_support', 'display_name' => 'Manage Support', 'description' => 'Manage support tickets', 'group' => 'system'],
            
            // Opportunities
            ['name' => 'create_opportunities', 'display_name' => 'Create Opportunities', 'description' => 'Create new opportunities', 'group' => 'opportunities'],
            ['name' => 'view_opportunities', 'display_name' => 'View Opportunities', 'description' => 'View opportunities', 'group' => 'opportunities'],
            ['name' => 'manage_opportunities', 'display_name' => 'Manage Opportunities', 'description' => 'Manage all opportunities', 'group' => 'opportunities'],
            
            // Profile Management
            ['name' => 'view_profiles', 'display_name' => 'View Profiles', 'description' => 'View user profiles', 'group' => 'profile'],
            ['name' => 'edit_own_profile', 'display_name' => 'Edit Own Profile', 'description' => 'Edit own profile', 'group' => 'profile'],
            ['name' => 'view_own_data', 'display_name' => 'View Own Data', 'description' => 'View own data and statistics', 'group' => 'profile'],
        ];

        foreach ($permissions as $permission) {
            Permission::create($permission);
        }

        // Assign permissions to roles
        $this->assignPermissionsToRoles();
    }

    private function assignPermissionsToRoles()
    {
        $roles = Role::all();
        $permissions = Permission::all();

        foreach ($roles as $role) {
            switch ($role->name) {
                case 'super_admin':
                    // Super admin gets all permissions
                    $role->permissions()->attach($permissions);
                    break;
                    
                case 'admin':
                    // Admin gets most permissions except super admin level
                    $adminPermissions = $permissions->whereNotIn('name', ['manage_roles']);
                    $role->permissions()->attach($adminPermissions);
                    break;
                    
                case 'moderator':
                    // Moderator gets content and user management permissions
                    $modPermissions = $permissions->whereIn('name', [
                        'view_users', 'edit_users', 'manage_content', 'view_content', 
                        'edit_content', 'view_messages', 'view_dashboard', 'view_logs',
                        'view_opportunities', 'manage_opportunities', 'view_profiles'
                    ]);
                    $role->permissions()->attach($modPermissions);
                    break;
                    
                case 'founding_member':
                    // Founding members get enhanced user permissions
                    $foundingPermissions = $permissions->whereIn('name', [
                        'view_content', 'create_opportunities', 'view_opportunities',
                        'send_messages', 'view_messages', 'view_dashboard', 'view_profiles',
                        'edit_own_profile', 'view_own_data'
                    ]);
                    $role->permissions()->attach($foundingPermissions);
                    break;
                    
                case 'member':
                    // Members get basic permissions
                    $memberPermissions = $permissions->whereIn('name', [
                        'view_content', 'view_opportunities', 'view_messages',
                        'view_profiles', 'edit_own_profile', 'view_own_data'
                    ]);
                    $role->permissions()->attach($memberPermissions);
                    break;
            }
        }
    }
}
