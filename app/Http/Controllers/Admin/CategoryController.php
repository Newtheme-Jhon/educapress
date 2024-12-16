<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories = Category::all();

        return view('admin.categories.index', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.categories.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|max:255',
            'slug' => 'required|unique:categories',
            'description' => 'required',
        ]);

        Category::create($request->all());

        return redirect()->route('admin.categories.index')
                ->with('success', 'La categoria se ha creado correctamente');
    }

    /**
     * Display the specified resource.
     */
    public function show(Category $category)
    {
        return view('admin.categories.show', compact('category'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Category $category)
    {
        return view('admin.categories.edit', compact('category'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Category $category)
    {
        $request->validate([
            'name' => 'required|max:255',
            'slug' => 'required|unique:categories,slug,' . $category->id,
            'description' => 'required',
        ]);

        $category->update($request->all());

        return redirect()->route('admin.categories.edit', $category)
                ->with('success', 'La categoria se ha actualizado correctamente');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Category $category)
    {
        if($category->courses->count() > 0){
            return response()->json([
                'status' => 'error',
                'message' => 'No se puede eliminar la categoria porque tiene cursos asociados',
            ], 400);
        }

        $category->delete();
        return response()->json([
            'status' => 'success',
            'message' => 'La categoria se ha eliminado correctamente',
        ], 200);

    }
}
