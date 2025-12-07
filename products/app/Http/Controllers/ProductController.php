<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // dd('āsd');
        $products = Product::all();
        return response()->json($products);
    }

public function store(Request $request)
{
        \Log::debug($request->all());

    $request->validate([
        'name' => 'required|string|max:255',
        'description' => 'nullable|string',
        'price' => 'required|numeric|min:0',
        'stock' => 'required|integer|min:0',
        'is_active' => 'nullable|boolean', 
    ]);

    // Pass the request data directly to the create method.
    // The Product model has a $fillable property that allows these fields to be mass assigned.
    $product = Product::create($request->only([
        'name', 
        'description', 
        'price', 
        'stock', 
        'is_active',
    ]));
    \Log::debug($product);
    return response()->json($product, 201);
}

    /**
     * Display the specified resource.
     */
    public function show(int $id)
    {
        $product = Product::where('id', $id)->firstOrFail();
        return response()->json($product);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Product $product)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'required|numeric|min:0',
            'stock' => 'required|integer|min:0',
        ]);

        $product->update($request->all());

        return response()->json($product);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        $product->delete();

        return response()->noContent(); // Or response()->json(null, 204);
    }
}
