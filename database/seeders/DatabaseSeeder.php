<?php

namespace Database\Seeders;

use App\Models\PostCategory;
use App\Models\Tag;
use App\Models\User;
use Database\Factories\PostCategoryFactory;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Storage;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        Storage::deleteDirectory('courses');
        Storage::makeDirectory('courses/images');

        //posts
        Storage::deleteDirectory('posts');
        Storage::makeDirectory('posts/images');
        
        // User::factory(10)->create();

        $this->call(RoleSeeder::class);
        $this->call(UserSeeder::class);

        Tag::factory(8)->create();
        PostCategory::factory(4)->create(); 
        $this->call(PostSeeder::class);

        $this->call([
            CategorySeeder::class,
            LevelSeeder::class,
            PriceSeeder::class
        ]);

        $this->call(CourseSeeder::class);

    }
}
