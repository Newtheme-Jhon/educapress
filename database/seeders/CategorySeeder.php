<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
            'Desarrollo Web',
            'Diseño Web',
            'Desarrollo Móvil',
            'Diseño Móvil',
            'Desarrollo de Videojuegos',
            'Diseño de Videojuegos',
        ];

        foreach ($categories as $category) {
            Category::create([
                'name' => $category,
                'slug' => str($category)->slug(),
            ]);
        }
    }
}
