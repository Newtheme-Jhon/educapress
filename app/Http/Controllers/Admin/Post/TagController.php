<?php

namespace App\Http\Controllers\Admin\Post;

use App\Http\Controllers\Controller;
use App\Models\Tag;
use Illuminate\Http\Request;

class TagController extends Controller
{

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $tags = Tag::all();
        return view('admin.posts.tags.index', compact('tags'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.posts.tags.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'title' => 'required|string|max:255|unique:tags,title',
            'slug' => 'required|string|max:255|unique:tags,slug',
        ]);

        Tag::create($data);

        return redirect()->route('admin.tags.index')->with('success', 'Etiqueta creada correctamente');
    }

    /**
     * Display the specified resource.
     */
    public function show(Tag $tag)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Tag $tag)
    {
        // dd($tag->posts->count());
        return view('admin.posts.tags.edit', compact('tag'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Tag $tag)
    {
        $data = $request->validate([
            'title' => 'required|string|max:255|unique:tags,title,' . $tag->id,
            'slug' => 'required|string|max:255|unique:tags,slug,' . $tag->id,
        ]);

        $tag->update($data);
        return redirect()->route('admin.tags.edit', $tag)->with('success', 'Etiqueta actualizada correctamente');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Tag $tag)
    {
        if($tag->posts->count() > 0){
            return response()->json(['message' => 'No se puede eliminar la etiqueta porque tiene posts asociados'], 400);
        }

        $tag->delete();
        return response()->json(['message' => 'Etiqueta eliminada correctamente'], 200);
    }
}
