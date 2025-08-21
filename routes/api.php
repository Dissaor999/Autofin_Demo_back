<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\clienteController;
use App\Http\Controllers\ProductoController;
use App\Http\Controllers\FacturaController;
use App\Http\Controllers\DetalleFacturaController;



Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::post('register', [AuthController::class, 'register']);
Route::post('login', [AuthController::class, 'login']);


Route::middleware(['auth:sanctum'])->group(function()
    {
        Route::get('logout', [AuthController::class, 'logout']);
    }
);
Route::apiResource('cliente', clienteController::class);
Route::apiResource('factura', FacturaController::class);
Route::apiResource('detalle_factura', DetalleFacturaController::class);
Route::apiResource('producto', ProductoController::class);
