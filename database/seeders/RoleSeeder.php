<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Role;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $roles = [
            [
                'name' => 'super_admin',
                'display_name' => 'Super Admin',
                'description' => 'Full system access with all permissions',
                'is_default' => false,
            ],
            [
                'name' => 'admin',
                'display_name' => 'Admin',
                'description' => 'Administrative access to manage users and content',
                'is_default' => false,
            ],
            [
                'name' => 'moderator',
                'display_name' => 'Moderator',
                'description' => 'Content moderation and user management',
                'is_default' => false,
            ],
            [
                'name' => 'founding_member',
                'display_name' => 'Founding Member',
                'description' => 'Founding members with enhanced privileges',
                'is_default' => false,
            ],
            [
                'name' => 'member',
                'display_name' => 'Member',
                'description' => 'Standard user access',
                'is_default' => true,
            ],
        ];

        foreach ($roles as $role) {
            Role::create($role);
        }
    }
}
