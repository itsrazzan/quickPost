<?php

namespace Database\Factories;

use App\Models\SocialAccount;
use App\Models\SocialPlatform;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<SocialAccount>
 */
class SocialAccountFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'user_id' => User::factory(),
            'social_platform_id' => SocialPlatform::factory(),
            'account_name' => fake()->name(),
            'username' => fake()->userName(),
            'avatar_url' => null,
            'access_token' => null,
            'refresh_token' => null,
            'token_expires_at' => null,
            'status' => 'connected',
            'is_demo' => false,
            'last_synced_at' => null,
        ];
    }
}
