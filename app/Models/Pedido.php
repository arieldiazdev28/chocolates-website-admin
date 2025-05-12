<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pedido extends Model
{
    protected $table = 'pedidos';

    protected $fillable = [
        'cliente',
        'productos',
        'total',
        'fecha_entrega',
        'comentarios',
        'estado',
    ];

    protected $casts = [
        'productos' => 'array',
        'fecha_entrega' => 'date',
    ];
}

