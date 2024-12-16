<?php

namespace App\Http\Controllers\Admin\Post;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Laravel\Facades\Image;

class PostRequestController extends Controller
{

    public function index()
    {
        return view('admin.posts.api.index');
    }
    
    public function get()
    {
        $url_posts = config('services.wordpress_api.url') . 'posts';

        $posts = Http::withHeaders([
            'Authorization' => 'Basic ' . base64_encode( config('services.wordpress_api.username') . ':' . config('services.wordpress_api.password') ),
            'Content-Type' => 'application/json',
            'Cache-Control' => 'no-cache',
        ])
        ->get($url_posts)->json();
        
        $count = 0;


        foreach ($posts as $post) {

            $post_exist = DB::table('posts')->where('slug', $post['slug'])->count();

            if($post_exist == 0){

                $image_id = $post['featured_media'];
                $url_image = config('services.wordpress_api.url') . "media/$image_id";
                //$url_image = "/media/514";
                

                //peticion para recuperar las imagenes
                $media = Http::withHeaders([
                    'Authorization' => 'Basic ' . base64_encode( config('services.wordpress_api.username') . ':' . config('services.wordpress_api.password') ),
                    'Content-Type' => 'application/json',
                    'Cache-Control' => 'no-cache',
                ])
                ->get($url_image)->json();

                //dd($media);
                $url_image = $media['guid']['rendered'];

                //descargar la imagen y convertirla a .webp
                $contents = file_get_contents($url_image);
                $image = Image::read($contents);
                $fileName = 'imagen-' . $count . '.webp';
                $image->save(storage_path('app/public/posts/images/' . $fileName), 80);
                
                //guardar la ruta en la base de datos donde se almacenara la imagen 
                $image_path = 'posts/images/' . $fileName;

                DB::table('posts')->insert([
                    'title'         => $post['title']['rendered'],
                    'slug'          => $post['slug'],
                    'status'        => 2,
                    'excerpt'       => $post['excerpt']['rendered'],
                    'content'       => $post['content']['rendered'],
                    'user_id'       => 1,
                    'image_path'    => $image_path,
                    'post_category_id' => 1,
                    'created_at'    => Carbon::now(),
                    'updated_at'    => Carbon::now(),
                ]);

            }

            $count+=1;
        }

        return redirect()->route('admin.posts.index')->with('success', 'Posts creados correctamente');
    }
}
