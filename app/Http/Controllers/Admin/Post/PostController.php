<?php

namespace App\Http\Controllers\Admin\Post;

use App\Http\Controllers\Controller;
use App\Models\Post;
use App\Models\PostCategory;
use App\Models\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Storage;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class PostController extends Controller
{
    use AuthorizesRequests;

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $posts = Post::latest()->paginate(10);
        //return $posts;
        return view('admin.posts.index', compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $routeName = request()->route()->getName();

        $categories = PostCategory::all();
        $tags = Tag::pluck('title', 'id');
        $category = [];

        foreach($categories as $cat){
            $category += [$cat->id => $cat->title];
        }
        //dd($category);
        return view('admin.posts.create', compact('category', 'tags', 'routeName'));

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        //return $request->all();

        $data = $request->validate([
            'title'                 => 'required',
            'slug'                  => 'required|unique:posts',
            'user_id'               => 'required',
            'status'                => 'required|in:1,2',
            'content'               => 'required',
            'excerpt'               => 'required',
            'post_category_id'      => 'required',
            'tags'                  => 'required',
            'image_path'            => 'image|mimes:jpeg,png,jpg,gif,svg,webp|max:2048',
        ]);

        if($request->status == 2){
            array_merge($request->validate([
                'image_path' => 'required|image|mimes:jpeg,png,jpg,gif,svg,webp|max:2048'
            ]), $data);
        }

        if($request->file('image_path')){
            //$url = Storage::put('posts', $request->file('postImage'));
            $url = Storage::put('posts/images', $request->file('image_path'));
            $data['image_path'] = $url;
            $post = Post::create($data);
        }else{
            $data['image_path'] = null;
            $post = Post::create($data);
        }

        if($request->tags){
            $post->tags()->attach($request->tags);
        }

        Cache::flush();

        return redirect()->route('admin.posts.edit', $post)->with('success', 'Post creado correctamente');
    }

    /**
     * Display the specified resource.
     */
    public function show(Post $post)
    {
        //return $post;
        return view('admin.posts.show', compact('post'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Post $post)
    {
        //authorize
        $this->authorize('author', $post);

        $routeName = request()->route()->getName();

        $categories = PostCategory::all();
        $tags = Tag::pluck('title', 'id');
        $category = [];

        $post_tag = $post->tags()->get();
        $tag_id = [];

        //post image
        $image = $post->image;

        for($i=0; $i<count($post_tag); $i++){
            $obj = (int) $post_tag[$i]->id;
            array_push($tag_id, $obj);
        }

        foreach($categories as $cat){
            $category += [$cat->id => $cat->title];
        }
        
        return view('admin.posts.edit', compact('post', 'category', 'tags', 'routeName', 'tag_id', 'image'));

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Post $post)
    {

        //authorize
        $this->authorize('author', $post);

        $data = $request->validate([
            'title'                 => 'required',
            'slug'                  => 'required|unique:posts,slug,' . $post->id,
            'user_id'               => 'required',
            'status'                => 'required|in:1,2',
            'content'               => 'required',
            'excerpt'               => 'required',
            'post_category_id'      => 'required',
            'tags'                  => 'required',
            'image_path'            => 'image|mimes:jpeg,png,jpg,gif,svg,webp|max:2048',
        ]);

        //return $request->all();

        if($request->status == 2 && $post->image_path == null){
            array_merge($request->validate([
                'image_path' => 'required|image|mimes:jpeg,png,jpg,gif,svg,webp|max:2048'
            ]), $data);
        }

        //dd($request->hasFile('image_path'));

        if($request->file('image_path') && $post->image_path != null){
            Storage::delete($post->image_path);
        };

        if($request->hasFile('image_path')){

            $url = Storage::put('posts/images', $request->file('image_path'));
            $data['image_path'] = $url;
  
            $post->update($data);
           
        }else{
            $post->update($data);
        }

        if($request->tags){
            $post->tags()->sync($request->tags);
        }
  
        Cache::flush();
        return redirect()->route('admin.posts.edit', $post)->with('success', 'Post actualizado correctamente');
        
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Post $post)
    {
        //authorize
        $this->authorize('author', $post);

        $post->tags()->detach();
        $post->delete();
        return response()->json(['message' => 'Post eliminado correctamente']);
    }
}
