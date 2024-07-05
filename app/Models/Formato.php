<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class Formato extends Model
{
    use HasFactory;

    protected $table = 'formatos';

    public $timestamps = false;

    protected $primaryKey = 'IdFormatos';
    protected $fillable = ['calificacion_id','observaciones'];

    public function comentarios()
    {
        return $this->hasOne(Calificacion::class);
    }

    public function calificacion()
    {
        return $this->belongsTo(Calificacion::class, 'IdFormatos', 'IdFormatos');
    }
}
