<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Carrito extends Model
{
    use HasFactory;
    protected $table = 'carrito';
    protected $fillable = [
        'imagen_producto',
        'precio_producto',
        'nombre_producto',
        'id_usuario',
        'cantidad_producto',
    ];

    public function vendedor()
    {
        return $this->belongsTo(User::class, 'id_usuario');
    }
}
