<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductoPizzas extends Model
{
    use HasFactory;
    protected $table = 'producto_pizzas';
    protected $fillable = [
        'id_producto',
        'id_comprador',
        'cantidad_comprada'
    ];

    public function detalle(){
        return $this->hasOne(Pizzeria::class, 'id_producto');
    }

    public function vendedor()
    {
        return $this->belongsTo(User::class, 'id_comprador');
    }
}
