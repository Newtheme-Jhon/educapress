<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Traits\SeoPageTrait;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

//seotools
use Artesaos\SEOTools\Facades\SEOMeta;
use Artesaos\SEOTools\Facades\OpenGraph;

class PostController extends Controller
{
    use AuthorizesRequests;
    use SeoPageTrait;

    public function index()
    {
        $posts = Post::all();

        /**
         * seotools : https://github.com/artesaos/seotools
         * Este metodo se encuentra en el trait SeoPageTrait
         */
        $this->generateIndexSeoPage('post');

        return view('posts.index', compact('posts'));
    }

    public function show(Post $post)
    {
        //authorize
        $this->authorize('published', $post);

        $related_posts = Post::where('post_category_id', $post->post_category_id)
            ->where('id', '!=', $post->id)
            ->where('status', 2)
            ->orderBy('created_at', 'desc')
            ->take(6)
            ->get();

        /**
         * seotools : https://github.com/artesaos/seotools
         * Este metodo se encuentra en el trait SeoPageTrait
         */
        $this->generateShowSeoPage('post', $post);

        return view('posts.show', compact('post', 'related_posts'));
    }
}
