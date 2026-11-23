<?php

namespace Database\Factories;

use App\Models\Media;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Media>
 */
class MediaFactory extends Factory
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
            'disk' => 'public',
            'file_name' => fake()->word().'.jpg',
            'file_path' => 'media/'.fake()->uuid().'.jpg',
            'mime_type' => 'image/jpeg',
            'file_size' => 1024,
            'dimensions' => ['width' => 1080, 'height' => 1080],
            'metadata' => null,
        ];
    }
}
