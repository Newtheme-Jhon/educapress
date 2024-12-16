<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Lesson>
 */
class LessonFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->sentence,
            'platform' => 2,
            'video_path' => 'EACKgOxPRnA',
            'video_original_name' => 'https://youtu.be/EACKgOxPRnA?si=wsl_GPSqykTbDcBI',
            'image_path' => 'https://img.youtube.com/vi/EACKgOxPRnA/0.jpg',
            'description' => $this->faker->paragraph,
            'duration' => 375,
            'is_processed' => 1,
        ];
    }
}
