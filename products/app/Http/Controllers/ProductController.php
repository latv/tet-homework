<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Tet\Helper\Common;
use App\Imports\ProductsImport;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): JsonResponse
    {
        $products = Product::all();
        return response()->json($products);
    }

    public function store(Request $request): JsonResponse
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

    public function show(int $id): JsonResponse
    {
        $product = Product::where('id', $id)->firstOrFail();
        $product->totalAmount = Common::productTotalAmount($product->price, $product->stock);
        
        return response()->json($product);
    }

    public function update(int $id, Request $request): JsonResponse
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


    public function destroy(int $id): Response
    {
        Product::where('id', $id)->firstOrFail()->delete();

        return response()->noContent();
    }

    public function import(Request $request): JsonResponse 
    {
        $request->validate([
            'file' => 'required|mimes:xlsx,csv',
        ]);

        Excel::queueImport(new ProductsImport, $request->file('file'));

        return response()->json(['message' => 'Import started'], 202);
    }
}
