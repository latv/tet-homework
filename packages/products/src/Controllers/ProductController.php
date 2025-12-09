<?php

namespace Tet\Products\Controllers;
use Illuminate\Support\Facades\Http;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Tet\Products\Models\Product;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        $client = new \GuzzleHttp\Client();
        $response = $client->get('http://products:8000/api/products');
        $products = json_decode($response->getBody()->getContents(), true);

        return view('products::index', compact('products'));
    }

    public function show($id, Request $request)
    {
        $client = new \GuzzleHttp\Client();
        $response = $client->get('http://products:8000/api/products/' . $id);
        $product = json_decode($response->getBody()->getContents(), true);
        return view('products::show', compact('product'));
    }

    public function editView($id)
    {
        $client = new \GuzzleHttp\Client();
        $response = $client->get('http://products:8000/api/products/' . $id);
        $product = json_decode($response->getBody()->getContents(), true);
        
        return view('products::edit_view', compact('product'));
    }

    public function createView()
    {
        return view('products::create_view');
    }

    public function store(Request $request)
    {
        
        $data = $request->only(['name', 'description', 'price', 'stock', 'is_active']);
        $rules = [
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'required|numeric|min:0',
            'stock' => 'required|integer|min:0',
            'is_active' => 'sometimes|boolean',
        ];

        $validator = Validator::make($data, $rules);
        
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $client = new \GuzzleHttp\Client();
        $response = $client->post('http://products:8000/api/products', [
            'form_params' => $data
        ]);
        
        return redirect()->route('products.index');
    }

    public function update($id, Request $request)
    {

        $data = $request->only(['name', 'description', 'price', 'stock', 'is_active']);

        $rules = [
            'name' => 'sometimes|required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'sometimes|required|numeric|min:0',
            'stock' => 'sometimes|required|integer|min:0',
            'is_active' => 'sometimes|boolean',
        ];

        $validator = Validator::make($data, $rules);
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $client = new \GuzzleHttp\Client();
        $response = $client->put('http://products:8000/api/products/'. $id, [
            'form_params' => $data
        ]);

        return redirect()->route('products.show', ['id' => $id]);
    }

    public function destroy($id)
    {
        $client = new \GuzzleHttp\Client();
        
        $client->delete('http://products:8000/api/products/' . $id);

        return redirect()->route('products.index');
    }

    public function import(Request $request)
    {
        $request->validate([
            'file' => 'required|file|mimes:xlsx,csv',
        ]);

        $file = $request->file('file');

        $client = new \GuzzleHttp\Client();
        
        try {
            $client->post('http://products:8000/api/products/import', [
                'multipart' => [
                    [
                        'name'     => 'file',
                        'contents' => fopen($file->getPathname(), 'r'),
                        'filename' => $file->getClientOriginalName(),
                    ],
                ],
            ]);
        } catch (\Exception $e) {
            return redirect()->route('products.index')->with('error', 'Import failed.');
        }

        return redirect()->route('products.index');
    }
}