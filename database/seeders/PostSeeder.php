<?php

namespace Database\Seeders;

use App\Models\Post;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PostSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $posts = Post::factory(20)->create();

        foreach($posts as $post){

            $tagIds = [];

            // Genera un número aleatorio de etiquetas entre 2 y 4 (ajusta según tus necesidades)
            $numberOfTags = rand(2, 4);
    
            // Agrega IDs de etiquetas aleatorios al array
            for ($i = 0; $i < $numberOfTags; $i++) {
                $tagIds[] = rand(1, 8); // Ajusta el rango de IDs de etiquetas según tu base de datos
            }
    
            // Elimina duplicados (opcional)
            $tagIds = array_unique($tagIds);
    
            // Asocia las etiquetas al post
            $post->tags()->attach($tagIds);

        }
    }
}
