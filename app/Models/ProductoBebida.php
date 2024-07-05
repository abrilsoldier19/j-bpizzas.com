<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductoBebida extends Model
{
    use HasFactory;
    protected $table = 'producto_bebidas';
    protected $fillable = [
        'id_bebida',
        'id_comprador',
        'cantidad_comprada'
    ];

    public function detalle(){
        return $this->hasOne(Bebida::class, 'id_bebida');
    }

    public function vendedor()
    {
        return $this->belongsTo(User::class, 'id_comprador');
    }
}
