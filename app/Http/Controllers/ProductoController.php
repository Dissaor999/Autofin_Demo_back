<?php

namespace App\Http\Controllers;

use App\Models\producto;
use Illuminate\Http\Request;

class ProductoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $productos = producto::all();
        return response()->json($productos);
    }

    

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required|string|max:255',
            'marca' => 'required|string|max:255',
            'costo' => 'required|numeric',
            'precioVenta' => 'required|numeric',
        ]);

        $producto = producto::create($request->all());

        return response()->json($producto, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(producto $producto)
    {
        return response()->json($producto);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, producto $producto)
    {
        $request->validate([
            'nombre' => 'sometimes|required|string|max:255',
            'marca' => 'sometimes|required|string|max:255',
            'costo' => 'sometimes|required|numeric',
            'precioVenta' => 'sometimes|required|numeric',
        ]);

        $producto->update($request->all());

        return response()->json($producto);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(producto $producto)
    {
        $producto->delete();
        return response()->json(null, 204); 
    }
}
