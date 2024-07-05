<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductoPostre extends Model
{
    use HasFactory;
    protected $table = 'producto_postres';
    protected $fillable = [
        'id_postre',
        'id_comprador',
        'cantidad_comprada'
    ];

    public function detalle(){
        return $this->hasOne(Postre::class, 'id_postre');
    }

    public function vendedor()
    {
        return $this->belongsTo(User::class, 'id_comprador');
    }
}
