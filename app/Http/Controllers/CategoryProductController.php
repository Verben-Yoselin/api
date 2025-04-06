<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\CategoryProduct;
use Illuminate\Http\Request;

class CategoryProductController extends Controller
{
    public function index()
    {
        $categories = CategoryProduct::all();
        return response()->json($categories);
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string'
        ]);

        $category = CategoryProduct::create($request->all());
        return response()->json($category, 201);
    }

    public function show(CategoryProduct $categoryProduct)
    {
        return response()->json($categoryProduct);
    }

    public function update(Request $request, CategoryProduct $categoryProduct)
    {
        $request->validate([
            'name' => 'string|max:255',
            'description' => 'string'
        ]);

        $categoryProduct->update($request->all());
        return response()->json($categoryProduct);
    }

    public function destroy(CategoryProduct $categoryProduct)
    {
        $categoryProduct->delete();
        return response()->json(null, 204);
    }
}