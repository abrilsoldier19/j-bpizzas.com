<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pizzeria extends Model
{
    use HasFactory;
    protected $primaryKey = 'id';

    public $timestamps = false;
    protected $table = 'pizzeria';
    protected $fillable = [
        'nombre_pizza',
        'precio_pizza',
        'imagen_pizza',
        'vendido',
        'id_usuario',
    ];

    public function vendedor(){
        return $this->
        belongsTo(Usuario::class, 'id_usuario');
    }

    public function pedidos()
{
    return $this->hasMany(Pedido::class, 'id_producto');
}

}
