<?php

namespace App\Http\Controllers;

use App\Models\detalleFactura;
use Illuminate\Http\Request;

class DetalleFacturaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $detalles = detalleFactura::query()->paginate($request->input('perPage', 10));

        // Obtén el número total de registros.
        $total = $detalles->total();
        
        // Retorna la respuesta JSON y agrega el encabezado.
        return response()->json($detalles->items())
            ->header('X-Total-Count', $total);
        // $detalles = detalleFactura::all();
        // return $detalles;
    }

    
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'factura_id' => 'required|exists:facturas,id',
            'producto_id' => 'required|exists:productos,id',
            'cantidad' => 'required|integer|min:1',
            'precio' => 'required|numeric|min:0',
        ]);

        $detalle = detalleFactura::create($request->all());
        return response()->json($detalle, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(detalleFactura $detalleFactura)
    {
        return response()->json($detalleFactura, 200);
    }

    

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, detalleFactura $detalleFactura)
    {
        $request->validate([
            'factura_id' => 'sometimes|required|exists:facturas,id',
            'producto_id' => 'sometimes|required|exists:productos,id',
            'cantidad' => 'sometimes|required|integer|min:1',
            'precio' => 'sometimes|required|numeric|min:0',
        ]);

        $detalleFactura->update($request->all());
        return response()->json($detalleFactura, 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(detalleFactura $detalleFactura)
    {
        $detalleFactura->delete();
        return response()->json(null, 204);
    }
}
