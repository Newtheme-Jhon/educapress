<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Price;
use Illuminate\Http\Request;

class PriceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $prices = Price::all();
        return view('admin.prices.index', compact('prices'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.prices.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //return $request->value;
        $request->validate([
            'value' => 'required|numeric|unique:prices',
        ]);

        

        Price::create($request->all());
        return redirect()->route('admin.prices.index')->with('success', 'Price created successfully.');

    }

    /**
     * Display the specified resource.
     */
    public function show(Price $price)
    {
        return view('admin.prices.show', compact('price'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Price $price)
    {
        return view('admin.prices.edit', compact('price'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Price $price)
    {
        $request->validate([
            'value' => 'required|unique:prices,value,' . $price->id,
        ]);

        $price->update($request->all());
        return redirect()->route('admin.prices.edit', $price)->with('success', 'Price updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Price $price)
    {
        $price->delete();
        return response()->json(['success' => 'Precio eliminado correctamente.']);
    }
}
