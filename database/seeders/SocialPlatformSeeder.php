<?php

namespace Database\Seeders;

use App\Models\SocialPlatform;
use Illuminate\Database\Seeder;

class SocialPlatformSeeder extends Seeder
{
    /**
     * Isi platform sosial dasar yang didukung QuickPost.
     * updateOrCreate membuat seeder aman dijalankan berulang kali.
     */
    public function run(): void
    {
        $platforms = [
            ['slug' => 'x', 'name' => 'X (Twitter)', 'color' => '#000000', 'caption_character_limit' => 280],
            ['slug' => 'instagram', 'name' => 'Instagram', 'color' => '#E1306C', 'caption_character_limit' => 2200],
            ['slug' => 'facebook', 'name' => 'Facebook', 'color' => '#1877F2', 'caption_character_limit' => 63206],
            ['slug' => 'linkedin', 'name' => 'LinkedIn', 'color' => '#0A66C2', 'caption_character_limit' => 3000],
            ['slug' => 'tiktok', 'name' => 'TikTok', 'color' => '#000000', 'caption_character_limit' => 2200],
        ];

        foreach ($platforms as $platform) {
            SocialPlatform::updateOrCreate(
                ['slug' => $platform['slug']],
                [
                    'name' => $platform['name'],
                    'color' => $platform['color'],
                    'caption_character_limit' => $platform['caption_character_limit'],
                    'is_active' => true,
                    'supported_media_types' => ['image', 'video'],
                ],
            );
        }
    }
}
