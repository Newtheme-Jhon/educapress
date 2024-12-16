<?php

namespace App\Http\Controllers\Admin\Post;

use App\Http\Controllers\Controller;
use App\Models\PostCategory;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories = PostCategory::all();
        return view('admin.posts.categories.index', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.posts.categories.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //return $request->all();
        $data = $request->validate([
            'title' => 'required|unique:post_categories,title|max:255',
            'slug' => 'required|unique:post_categories|max:255',
        ]);

        PostCategory::create($data);
        return redirect()->route('admin.post_categories.index')->with('success', 'Categoria creada correctamente');
    }

    /**
     * Display the specified resource.
     */
    public function show(PostCategory $post_category)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(PostCategory $post_category)
    {
        //dd($post_category->posts()->count());
        return view('admin.posts.categories.edit', compact('post_category'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, PostCategory $post_category)
    {
        $data = $request->validate([
            'title' => 'required|unique:post_categories,title,' . $post_category->id . '|max:255',
            'slug' => 'required|unique:post_categories,slug,' . $post_category->id . '|max:255',
        ]);

        $post_category->update($data);
        return redirect()->route('admin.post_categories.edit', compact('post_category'))->with('success', 'Categoria actualizada correctamente');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(PostCategory $post_category)
    {
        if ($post_category->posts()->count() > 0) {
            return response()->json(['message' => 'No se puede eliminar la categoria porque tiene posts asociados'], 400);
        }

        $post_category->delete();
        return response()->json(['message' => 'Categoria eliminada correctamente'], 200);
    }

}
