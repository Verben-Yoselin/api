<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Client;
use Illuminate\Http\Request;

class ClientController extends Controller
{
    public function index()
    {
        $clients = Client::with('person')->get();
        return response()->json($clients);
    }

    public function store(Request $request)
    {
        $request->validate([
            'id' => 'required|exists:people,id|unique:clients',
            'join_date_time' => 'required|date'
        ]);

        $client = Client::create($request->all());
        return response()->json($client, 201);
    }

    public function show(Client $client)
    {
        return response()->json($client->load('person'));
    }

    public function update(Request $request, Client $client)
    {
        $request->validate([
            'join_date_time' => 'date'
        ]);

        $client->update($request->all());
        return response()->json($client);
    }

    public function destroy(Client $client)
    {
        $client->delete();
        return response()->json(null, 204);
    }
}