<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;


class factura extends Model
{
    protected $table = 'facturas';
    protected $fillable = [
        'numeroFactura',
        'fechaHora',
        'clientes_id',
    ];

    public function cliente(): HasOne
    {
        return $this->hasOne(cliente::class, 'clientes_id');
    }
}
