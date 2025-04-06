<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\OrderDetail;
use Illuminate\Http\Request;

class OrderDetailController extends Controller
{
    // GET /orderdetails
    public function index()
    {
        $orderDetails = OrderDetail::all();
        return response()->json($orderDetails);
    }

    // POST /orderdetails
    public function store(Request $request)
    {
        $validated = $request->validate([
            // Define your validation rules here
            // 'field' => 'required|string|max:255',
        ]);

        $orderDetail = OrderDetail::create($validated);

        return response()->json($orderDetail, 201);
    }

    // GET /orderdetails/{id}
    public function show($id)
    {
        $orderDetail = OrderDetail::findOrFail($id);
        return response()->json($orderDetail);
    }

    // PUT/PATCH /orderdetails/{id}
    public function update(Request $request, $id)
    {
        $orderDetail = OrderDetail::findOrFail($id);
        $validated = $request->validate([
            // Define your validation rules here
            // 'field' => 'sometimes|required|string|max:255',
        ]);

        $orderDetail->update($validated);

        return response()->json($orderDetail);
    }

    // DELETE /orderdetails/{id}
    public function destroy($id)
    {
        $orderDetail = OrderDetail::findOrFail($id);
        $orderDetail->delete();

        return response()->json(['message' => 'OrderDetail deleted successfully']);
    }
}