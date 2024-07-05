<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bebida extends Model
{
    use HasFactory;

    protected $table = 'bebidas';
    public $timestamps = false;
    protected $fillable = [
        'nombre_bebida',
        'bebida_precio',
        'bebida_imagen',
        'vendido',
        'id_usuario',
    ];

    public function vendedor(){
        return $this->
        belongsTo(Usuario::class, 'id_usuario');
    }

    public function pedidos()
    {
        return $this->hasMany('App\Pedido');
    }
}
