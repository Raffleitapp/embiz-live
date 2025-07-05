<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Profile;
use App\Models\Role;
use Illuminate\Support\Facades\Hash;

class ProfileSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Get roles for assignment
        $adminRole = Role::where('name', 'admin')->first();
        $foundingMemberRole = Role::where('name', 'founding_member')->first();
        $memberRole = Role::where('name', 'member')->first();

        // Create sample users with profiles
        $users = [
            [
                'first_name' => 'Admin',
                'last_name' => 'User',
                'email' => 'admin@embiz.com',
                'password' => Hash::make('password'),
                'role_id' => $adminRole?->id,
                'profile' => [
                    'first_name' => 'Admin',
                    'last_name' => 'User',
                    'title' => 'System Administrator',
                    'company' => 'Embiz',
                    'bio' => 'System administrator with full access to manage the platform.',
                    'location' => 'Remote',
                    'profile_type' => 'entrepreneur',
                    'interests' => ['administration', 'system management'],
                    'skills' => ['system administration', 'user management'],
                    'portfolio_count' => 0,
                    'profile_views' => 50,
                    'is_founding_member' => false,
                    'is_verified' => true,
                    'is_active' => true,
                ]
            ],
            [
                'first_name' => 'Amina',
                'last_name' => 'Walker',
                'email' => 'amina@example.com',
                'password' => Hash::make('password'),
                'role_id' => $foundingMemberRole?->id,
                'profile' => [
                    'first_name' => 'Amina',
                    'last_name' => 'Walker',
                    'title' => 'Founder & CEO',
                    'company' => 'FemmeFound',
                    'bio' => 'Amina Walker is a passionate advocate for the economic empowerment of Black women across the entrepreneurial landscape. With a strong background in finance and community development, Amina has spent the past decade building bridges between underrepresented entrepreneurs and critical funding opportunities.',
                    'location' => 'Washington, DC',
                    'profile_type' => 'entrepreneur',
                    'interests' => ['fintech', 'women empowerment', 'entrepreneurship', 'funding'],
                    'skills' => ['finance', 'business development', 'mentorship', 'networking'],
                    'portfolio_count' => 50,
                    'profile_views' => 125,
                    'is_founding_member' => true,
                    'is_verified' => true,
                    'is_active' => true,
                ]
            ],
            [
                'first_name' => 'Kemi',
                'last_name' => 'Robinson',
                'email' => 'kemi@example.com',
                'password' => Hash::make('password'),
                'role_id' => $foundingMemberRole?->id,
                'profile' => [
                    'first_name' => 'Kemi',
                    'last_name' => 'Robinson',
                    'title' => 'Founder',
                    'company' => 'NourishHer',
                    'bio' => 'Kemi Robinson is a passionate food-tech entrepreneur on a mission to transform how busy women of color access healthy, culturally resonant meals. With a background in nutrition science and digital innovation, Kemi has pioneered solutions that bridge the gap between traditional cooking and modern convenience.',
                    'location' => 'Birmingham, UK',
                    'profile_type' => 'entrepreneur',
                    'interests' => ['food tech', 'nutrition', 'women of color', 'health'],
                    'skills' => ['product development', 'nutrition science', 'digital marketing', 'food safety'],
                    'portfolio_count' => 50,
                    'profile_views' => 98,
                    'is_founding_member' => true,
                    'is_verified' => true,
                    'is_active' => true,
                ]
            ],
            [
                'first_name' => 'Chantelle',
                'last_name' => 'Nkrumah',
                'email' => 'chantelle@example.com',
                'password' => Hash::make('password'),
                'role_id' => $foundingMemberRole?->id,
                'profile' => [
                    'first_name' => 'Chantelle',
                    'last_name' => 'Nkrumah',
                    'title' => 'CFO',
                    'company' => 'EquitySpark',
                    'bio' => 'Chantelle Nkrumah is a dynamic financial strategist committed to empowering Black-led startups through funding education, smart capital structuring, and sustainable growth planning. With over a decade of experience in corporate finance and venture capital, Chantelle brings both analytical rigor and cultural understanding to her advisory work.',
                    'location' => 'Houston, TX',
                    'profile_type' => 'advisor',
                    'interests' => ['venture capital', 'financial planning', 'startup growth', 'diversity'],
                    'skills' => ['financial analysis', 'venture capital', 'strategic planning', 'mentorship'],
                    'portfolio_count' => 50,
                    'profile_views' => 87,
                    'is_founding_member' => true,
                    'is_verified' => true,
                    'is_active' => true,
                ]
            ],
            [
                'first_name' => 'Marcus',
                'last_name' => 'Johnson',
                'email' => 'marcus@example.com',
                'password' => Hash::make('password'),
                'role_id' => $memberRole?->id,
                'profile' => [
                    'first_name' => 'Marcus',
                    'last_name' => 'Johnson',
                    'title' => 'Managing Partner',
                    'company' => 'Equity Ventures',
                    'bio' => 'Marcus Johnson is a seasoned investor with 15+ years of experience in early-stage venture capital, focusing on diverse founders and underrepresented markets. He has invested in over 100 startups and has a particular interest in fintech, healthtech, and social impact ventures.',
                    'location' => 'Atlanta, GA',
                    'profile_type' => 'investor',
                    'interests' => ['venture capital', 'early stage', 'fintech', 'social impact'],
                    'skills' => ['due diligence', 'portfolio management', 'startup mentorship', 'market analysis'],
                    'portfolio_count' => 100,
                    'profile_views' => 156,
                    'is_founding_member' => false,
                    'is_verified' => true,
                    'is_active' => true,
                ]
            ],
            [
                'first_name' => 'Jasmine',
                'last_name' => 'Williams',
                'email' => 'jasmine@example.com',
                'password' => Hash::make('password'),
                'role_id' => $memberRole?->id,
                'profile' => [
                    'first_name' => 'Jasmine',
                    'last_name' => 'Williams',
                    'title' => 'Co-Founder',
                    'company' => 'TechBridge Solutions',
                    'bio' => 'Jasmine Williams is a tech entrepreneur and software engineer who founded TechBridge Solutions to provide affordable technology solutions for small businesses in underserved communities. She is passionate about closing the digital divide and creating opportunities for minority-owned businesses.',
                    'location' => 'Chicago, IL',
                    'profile_type' => 'entrepreneur',
                    'interests' => ['technology', 'digital divide', 'small business', 'community development'],
                    'skills' => ['software engineering', 'business development', 'project management', 'community outreach'],
                    'portfolio_count' => 25,
                    'profile_views' => 73,
                    'is_founding_member' => false,
                    'is_verified' => true,
                    'is_active' => true,
                ]
            ],
        ];

        foreach ($users as $userData) {
            $user = User::create([
                'first_name' => $userData['first_name'],
                'last_name' => $userData['last_name'],
                'email' => $userData['email'],
                'password' => $userData['password'],
                'role_id' => $userData['role_id'],
                'email_verified_at' => now(),
            ]);

            $user->profile()->create($userData['profile']);
        }
    }
}
