<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Opportunity;
use App\Models\User;

class OpportunitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = User::all();
        
        if ($users->isEmpty()) {
            return;
        }

        $opportunities = [
            [
                'user_id' => $users->random()->id,
                'title' => 'Seed Funding for FinTech Startup',
                'description' => 'We are seeking $250,000 in seed funding to launch our innovative financial technology platform that provides banking services to underserved communities. Our platform combines mobile banking, micro-lending, and financial education to help Black entrepreneurs access capital and build credit.',
                'type' => 'funding',
                'amount' => 250000.00,
                'currency' => 'USD',
                'location' => 'New York, NY',
                'industry' => 'FinTech',
                'stage' => 'startup',
                'requirements' => ['Business plan', 'Financial projections', 'Team bios', 'Market analysis'],
                'contact_email' => 'funding@example.com',
                'deadline' => now()->addDays(30),
                'status' => 'active',
                'is_featured' => true,
                'views' => 245,
                'applications' => 12,
            ],
            [
                'user_id' => $users->random()->id,
                'title' => 'Series A Investment - Healthcare Platform',
                'description' => 'Our healthcare platform is revolutionizing access to quality healthcare in underserved communities. We have proven traction with 10,000+ users and are seeking $2M in Series A funding to expand our reach and enhance our technology.',
                'type' => 'investment',
                'amount' => 2000000.00,
                'currency' => 'USD',
                'location' => 'San Francisco, CA',
                'industry' => 'Healthcare',
                'stage' => 'growth',
                'requirements' => ['Due diligence materials', 'Financial statements', 'Growth metrics', 'Technical documentation'],
                'contact_email' => 'investment@example.com',
                'deadline' => now()->addDays(45),
                'status' => 'active',
                'is_featured' => true,
                'views' => 189,
                'applications' => 8,
            ],
            [
                'user_id' => $users->random()->id,
                'title' => 'Strategic Partnership - Food Tech',
                'description' => 'We are looking for strategic partners to help scale our food technology platform that connects Black-owned restaurants with customers. Ideal partners would have experience in food delivery, marketing, or logistics.',
                'type' => 'partnership',
                'amount' => null,
                'currency' => 'USD',
                'location' => 'Los Angeles, CA',
                'industry' => 'Food & Beverage',
                'stage' => 'growth',
                'requirements' => ['Company overview', 'Partnership proposal', 'References'],
                'contact_email' => 'partnerships@example.com',
                'deadline' => now()->addDays(60),
                'status' => 'active',
                'is_featured' => false,
                'views' => 167,
                'applications' => 15,
            ],
            [
                'user_id' => $users->random()->id,
                'title' => 'Mentorship Program - E-commerce',
                'description' => 'Join our mentorship program designed for Black entrepreneurs in e-commerce. We provide one-on-one mentoring, group workshops, and access to our network of successful business owners. Perfect for early-stage entrepreneurs looking to scale their online businesses.',
                'type' => 'mentorship',
                'amount' => null,
                'currency' => 'USD',
                'location' => 'Remote',
                'industry' => 'E-commerce',
                'stage' => 'idea',
                'requirements' => ['Business concept', 'Application form', 'Commitment letter'],
                'contact_email' => 'mentorship@example.com',
                'deadline' => now()->addDays(21),
                'status' => 'active',
                'is_featured' => false,
                'views' => 98,
                'applications' => 23,
            ],
            [
                'user_id' => $users->random()->id,
                'title' => 'Federal Grant - Community Development',
                'description' => 'A federal grant opportunity of up to $500,000 is available for businesses focused on community development in underserved areas. The grant supports initiatives that create jobs, provide essential services, or improve economic opportunities for minority communities.',
                'type' => 'grant',
                'amount' => 500000.00,
                'currency' => 'USD',
                'location' => 'Nationwide',
                'industry' => 'Community Development',
                'stage' => 'established',
                'requirements' => ['Grant application', 'Project proposal', 'Budget breakdown', 'Community impact assessment'],
                'contact_email' => 'grants@example.com',
                'deadline' => now()->addDays(90),
                'status' => 'active',
                'is_featured' => true,
                'views' => 342,
                'applications' => 56,
            ],
            [
                'user_id' => $users->random()->id,
                'title' => 'Angel Investment - EdTech Startup',
                'description' => 'Seeking angel investors for our educational technology platform that provides coding and digital literacy training to underrepresented youth. We are raising $100,000 to develop our MVP and launch pilot programs in 5 cities.',
                'type' => 'investment',
                'amount' => 100000.00,
                'currency' => 'USD',
                'location' => 'Boston, MA',
                'industry' => 'Education Technology',
                'stage' => 'startup',
                'requirements' => ['Pitch deck', 'Demo video', 'Team background', 'Market research'],
                'contact_email' => 'angel@example.com',
                'deadline' => now()->addDays(35),
                'status' => 'active',
                'is_featured' => false,
                'views' => 156,
                'applications' => 19,
            ],
            [
                'user_id' => $users->random()->id,
                'title' => 'Venture Capital - Clean Energy',
                'description' => 'Our clean energy startup is developing innovative solar solutions for low-income communities. We are seeking $5M in venture capital to scale our technology and expand to 10 new markets. Strong focus on environmental justice and community ownership.',
                'type' => 'investment',
                'amount' => 5000000.00,
                'currency' => 'USD',
                'location' => 'Austin, TX',
                'industry' => 'Clean Energy',
                'stage' => 'growth',
                'requirements' => ['Comprehensive business plan', 'Technical specifications', 'Environmental impact report', 'Financial projections'],
                'contact_email' => 'vc@example.com',
                'deadline' => now()->addDays(75),
                'status' => 'active',
                'is_featured' => true,
                'views' => 298,
                'applications' => 7,
            ],
        ];

        foreach ($opportunities as $opportunityData) {
            Opportunity::create($opportunityData);
        }
    }
}
