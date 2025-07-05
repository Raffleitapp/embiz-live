<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\SystemSetting;

class SystemSettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $settings = [
            [
                'key' => 'site_name',
                'value' => 'Embiz',
                'type' => 'string',
                'description' => 'Site name',
                'is_public' => true,
            ],
            [
                'key' => 'site_description',
                'value' => 'Connecting Black entrepreneurs and professionals worldwide',
                'type' => 'string',
                'description' => 'Site description',
                'is_public' => true,
            ],
            [
                'key' => 'admin_email',
                'value' => 'admin@embiz.com',
                'type' => 'string',
                'description' => 'Admin email address',
                'is_public' => false,
            ],
            [
                'key' => 'notifications_enabled',
                'value' => 'true',
                'type' => 'boolean',
                'description' => 'Enable notifications',
                'is_public' => false,
            ],
            [
                'key' => 'maintenance_mode',
                'value' => 'false',
                'type' => 'boolean',
                'description' => 'Maintenance mode',
                'is_public' => false,
            ],
        ];

        foreach ($settings as $setting) {
            SystemSetting::create($setting);
        }
    }
}
