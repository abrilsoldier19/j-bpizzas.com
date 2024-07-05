<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;
    protected $table = 'orden_pedidos';
    protected $fillable = [
        'nombre_usuario',
        'email',
        'telefono',
        'direccion',
        'metodo_pago',
        'productos',
        'cantidad_productos',
        'imagen_producto',
        'total_pago',
        'id_usuario',
    ];

    public function vendedor()
    {
        return $this->belongsTo(User::class, 'id_usuario');
    }

}
