<?php

namespace Database\Factories;

use App\Models\Content;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Content>
 */
class ContentFactory extends Factory
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
            'title' => fake()->sentence(4),
            'caption' => fake()->paragraph(),
            'first_comment' => null,
            'status' => 'draft',
            'scheduled_at' => null,
            'published_at' => null,
            'timezone' => 'Asia/Jakarta',
        ];
    }
}
