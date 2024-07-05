<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pedido extends Model
{
    use HasFactory;
    protected $table = 'pedidos';
    protected $fillable = [
        'id_producto',
        'id_bebida',
        'id_postre',
        'id_comprador',
        'cantidad_comprada_pizza',
        'cantidad_comprada_bebida',
        'cantidad_comprada_postre'
    ];

    public function vendedor()
    {
        return $this->belongsTo(User::class, 'id_comprador');
    }
}
