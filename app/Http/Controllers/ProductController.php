<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::with('category')->get();
        return response()->json($products);
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'url_picture' => 'nullable|string',
            'category_id' => 'required|exists:category_products,id',
            'stock' => 'required|integer|min:0'
        ]);

        $product = Product::create($request->all());
        return response()->json($product, 201);
    }

    public function show(Product $product)
    {
        return response()->json($product->load('category'));
    }

    public function update(Request $request, Product $product)
    {
        $request->validate([
            'name' => 'string|max:255',
            'description' => 'string',
            'url_picture' => 'nullable|string',
            'category_id' => 'exists:category_products,id',
            'stock' => 'integer|min:0'
        ]);

        $product->update($request->all());
        return response()->json($product);
    }

    public function destroy(Product $product)
    {
        $product->delete();
        return response()->json(null, 204);
    }
}