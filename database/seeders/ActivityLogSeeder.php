<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\ActivityLog;
use App\Models\User;

class ActivityLogSeeder extends Seeder
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

        $activities = [
            [
                'action' => 'Created new opportunity',
                'description' => 'TechFlow Solutions - Software Developer position',
                'type' => 'create',
            ],
            [
                'action' => 'Updated profile',
                'description' => 'Changed profile visibility settings',
                'type' => 'update',
            ],
            [
                'action' => 'Logged in',
                'description' => 'User authentication successful',
                'type' => 'login',
            ],
            [
                'action' => 'Sent message',
                'description' => 'New message sent to connection',
                'type' => 'message',
            ],
            [
                'action' => 'Joined network',
                'description' => 'Connected with another user',
                'type' => 'connection',
            ],
            [
                'action' => 'Updated opportunity',
                'description' => 'Modified opportunity details',
                'type' => 'update',
            ],
            [
                'action' => 'Profile viewed',
                'description' => 'Profile was viewed by another user',
                'type' => 'view',
            ],
        ];

        foreach ($users as $user) {
            // Create 3-7 random activities for each user
            $numActivities = rand(3, 7);
            
            for ($i = 0; $i < $numActivities; $i++) {
                $activity = $activities[array_rand($activities)];
                
                ActivityLog::create([
                    'user_id' => $user->id,
                    'action' => $activity['action'],
                    'description' => $activity['description'],
                    'type' => $activity['type'],
                    'metadata' => json_encode(['generated' => true]),
                    'ip_address' => '127.0.0.1',
                    'user_agent' => 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36',
                    'created_at' => now()->subDays(rand(0, 30))->subHours(rand(0, 23)),
                    'updated_at' => now()->subDays(rand(0, 30))->subHours(rand(0, 23)),
                ]);
            }
        }
    }
}
