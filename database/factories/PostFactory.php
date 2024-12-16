<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

use Illuminate\Support\Str;
use App\Models\PostCategory;
use App\Models\User;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class PostFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $name = $this->faker->unique()->sentence();
        return [
            'title'         => $name,
            'slug'          => Str::slug($name),
            'excerpt'       => $this->faker->text(250),
            'content'       => $this->faker->text(2000),
            'image_path'    => 'posts/images/' .  $this->faker->image('public/storage/posts/images', 640, 480, null, false),
            'status'        => $this->faker->randomElement([1, 2]),
            'post_category_id'   => PostCategory::all()->random()->id,
            'user_id'       => User::all()->random()->id,
        ];
    }
}
