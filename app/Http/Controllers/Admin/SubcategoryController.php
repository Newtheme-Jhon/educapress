<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Subcategory;
use Illuminate\Http\Request;

class SubcategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $subcategories = Subcategory::all();
        return view('admin.subcategories.index', compact('subcategories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = \App\Models\Category::all();

        return view('admin.subcategories.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // return $request->all();

        $data = $request->validate([
            'name'          => 'required|string|max:255',
            'slug'          => 'required|string|max:255|unique:subcategories',
            'category_id'   => 'required|exists:categories,id',
        ]);

        Subcategory::create($data);

        return redirect()->route('admin.subcategories.index')->with('success', 'Subcategoria creada correctamente.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Subcategory $subcategory)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Subcategory $subcategory)
    {

        $categories = \App\Models\Category::all();
        return view('admin.subcategories.edit', compact('subcategory', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Subcategory $subcategory)
    {
        $data = $request->validate([
            'name'          => 'required|string|max:255',
            'slug'          => 'required|string|max:255|unique:subcategories,slug,' . $subcategory->id,
            'category_id'   => 'required|exists:categories,id',
        ]);

        $subcategory->update($data);
        return redirect()->route('admin.subcategories.edit', $subcategory)->with('success', 'Subcategoria actualizada correctamente.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Subcategory $subcategory)
    {
        $courses = $subcategory->courses;

        if ($courses->pluck('id')->count() > 0) {
            return response()->json(['error' => 'No se puede eliminar la subcategoría porque tiene cursos asociados.'], 400);
        }

        $subcategory->delete();
        return response()->json(['success' => 'Subcategoría eliminada correctamente.'], 200);
    }
}
