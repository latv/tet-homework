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
        $products = Product::all();
        return response()->json($products);
    }

    public function store(Request $request)
    {

        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'required|numeric|min:0',
            'stock' => 'required|integer|min:0',
            'is_active' => 'nullable|boolean', 
        ]);

        $product = Product::create($request->only([
            'name', 
            'description', 
            'price', 
            'stock', 
            'is_active',
        ]));
        return response()->json($product, 201);
    }

    public function show(int $id)
    {
        $product = Product::where('id', $id)->firstOrFail();
        return response()->json($product);
    }

    public function update(int $id, Request $request)
    {
        $product = Product::where('id', $id)->firstOrFail();
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'required|numeric|min:0',
            'stock' => 'required|integer|min:0',
        ]);
        $data['is_active'] = $request->has('is_active') ? 1 : 0;
        $product->update($request->all());

        return response()->json($product);
    }


    public function destroy(int $id)
    {
        Product::where('id', $id)->firstOrFail()->delete();

        return response()->noContent();
    }
}
