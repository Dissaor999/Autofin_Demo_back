<?php

namespace App\Http\Controllers;

use App\Models\cliente;
use Illuminate\Http\Request;

class clienteController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $clients = Cliente::all();
        return $clients;
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:clientes',
            'domicilio' => 'nullable|string|max:255',
        ]);

        $client = Cliente::create($request->all());
        return response()->json($client, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(cliente $cliente)
    {
        return $cliente;
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, cliente $cliente)
    {
        $request->validate([
            'nombre' => 'sometimes|required|string|max:255',
            'email' => 'sometimes|required|string|email|max:255|unique:clientes,email,' . $cliente->id,
            'domicilio' => 'nullable|string|max:255',
        ]);
        
        $cliente->update($request->all());
        return response()->json($cliente, 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(cliente $cliente)
    {
        $cliente->delete();
        return response()->json(null, 204);
    }
}
