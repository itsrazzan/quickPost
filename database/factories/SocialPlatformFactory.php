<?php

namespace Database\Factories;

use App\Models\SocialPlatform;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends Factory<SocialPlatform>
 */
class SocialPlatformFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'slug' => Str::slug(fake()->unique()->words(2, true)),
            'name' => fake()->company(),
            'icon' => null,
            'color' => '#4F46E5',
            'is_active' => true,
            'supported_media_types' => null,
            'caption_character_limit' => 2200,
            'max_media_count' => 10,
        ];
    }
}
