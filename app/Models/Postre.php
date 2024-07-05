<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Postre extends Model
{
    use HasFactory;

    protected $table = 'postres';
    public $timestamps = false;
    protected $fillable = [
        'nombre_postre',
        'postre_precio',
        'postre_imagen',
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
