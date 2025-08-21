<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\HasMany;

class detalleFactura extends Model
{
    protected $table = 'facturas';
    protected $fillable = [
        'cantidad',
        'facturas_id',
        'productos_id',
    ];
    public function factura(): HasOne
    {
        return $this->hasOne(factura::class, 'facturas_id');
    }
    public function productos(): HasOne
    {
        return $this->hasMany(producto::class);
    }
}
    
