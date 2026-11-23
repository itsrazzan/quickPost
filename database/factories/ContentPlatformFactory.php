<?php

namespace Database\Factories;

use App\Models\Content;
use App\Models\ContentPlatform;
use App\Models\SocialAccount;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<ContentPlatform>
 */
class ContentPlatformFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'content_id' => Content::factory(),
            'social_account_id' => SocialAccount::factory(),
            'status' => 'pending',
            'scheduled_at' => null,
            'external_post_id' => null,
            'error_message' => null,
            'published_at' => null,
        ];
    }
}
