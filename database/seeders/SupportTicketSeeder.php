<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\SupportTicket;
use App\Models\User;

class SupportTicketSeeder extends Seeder
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

        $tickets = [
            [
                'subject' => 'Unable to update profile',
                'description' => 'I am having trouble updating my profile information. The save button does not seem to work.',
                'priority' => 'Medium',
                'status' => 'Open',
                'category' => 'Technical',
            ],
            [
                'subject' => 'Feature request: Dark mode',
                'description' => 'Would love to see a dark mode option for the platform to reduce eye strain during extended use.',
                'priority' => 'Low',
                'status' => 'In Progress',
                'category' => 'Feature Request',
            ],
            [
                'subject' => 'Payment issue',
                'description' => 'Having trouble with payment processing for my affiliate programme. Transaction keeps failing.',
                'priority' => 'High',
                'status' => 'Resolved',
                'category' => 'Billing',
            ],
            [
                'subject' => 'Connection request not working',
                'description' => 'When I try to send connection requests, I get an error message.',
                'priority' => 'Medium',
                'status' => 'Open',
                'category' => 'Technical',
            ],
            [
                'subject' => 'Account verification delay',
                'description' => 'My account verification is taking longer than expected. Please help expedite the process.',
                'priority' => 'High',
                'status' => 'In Progress',
                'category' => 'Account',
            ],
        ];

        foreach ($tickets as $ticketData) {
            SupportTicket::create([
                'subject' => $ticketData['subject'],
                'description' => $ticketData['description'],
                'priority' => $ticketData['priority'],
                'status' => $ticketData['status'],
                'category' => $ticketData['category'],
                'user_id' => $users->random()->id,
                'assigned_to' => $users->where('email', 'admin@embiz.com')->first()?->id,
                'created_at' => now()->subDays(rand(0, 30)),
                'updated_at' => now()->subDays(rand(0, 7)),
            ]);
        }
    }
}
