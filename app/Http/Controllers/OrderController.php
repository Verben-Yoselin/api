<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function index()
    {
        $orders = Order::with(['client', 'vendor'])->get();
        return response()->json($orders);
    }

    public function store(Request $request)
    {
        $request->validate([
            'client_id' => 'required|exists:clients,id',
            'vendor_id' => 'required|exists:users,id',
            'total' => 'required|numeric|min:0',
            'date_time' => 'required|date'
        ]);

        $order = Order::create($request->all());
        return response()->json($order, 201);
    }

    public function show(Order $order)
    {
        return response()->json($order->load(['client', 'vendor']));
    }

    public function update(Request $request, Order $order)
    {
        $request->validate([
            'client_id' => 'exists:clients,id',
            'vendor_id' => 'exists:users,id',
            'total' => 'numeric|min:0',
            'date_time' => 'date'
        ]);

        $order->update($request->all());
        return response()->json($order);
    }

    public function destroy(Order $order)
    {
        $order->delete();
        return response()->json(null, 204);
    }
}