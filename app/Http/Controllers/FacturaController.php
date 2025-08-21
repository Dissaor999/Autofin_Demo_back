<?php

namespace App\Http\Controllers;

use App\Models\factura;
use Illuminate\Http\Request;

class FacturaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(REquest $request)
    {
        $facturas = factura::query()->paginate($request->input('perPage', 10));

        // Obtén el número total de registros.
        $total = $facturas->total();
        
        // Retorna la respuesta JSON y agrega el encabezado.
        return response()->json($facturas->items())
            ->header('X-Total-Count', $total);
        
    }

   

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'clientes_id' => 'required|exists:clientes,id',
            'numeroFactura' => 'required|string|max:255',
            'fechaHora' => 'required|date',
        ]);

        $factura = factura::create($request->all());
        return response()->json($factura, 201); 
    }

    /**
     * Display the specified resource.
     */
    public function show(factura $factura)
    {
        return $factura;
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, factura $factura)
    {
        $request->validate([
            'clientes_id' => 'sometimes|required|exists:clientes,id',
            'numeroFactura' => 'sometimes|required|string|max:255',
            'fechaHora' => 'sometimes|required|date',
        ]);

        $factura->update($request->all());
        return response()->json($factura, 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(factura $factura)
    {
        $factura->delete();
        return response()->json(null, 204);
    }
}
