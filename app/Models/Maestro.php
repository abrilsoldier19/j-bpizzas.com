<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class Maestro extends Model
{
    public $timestamps = false;
    use HasFactory;
    protected $primaryKey = 'IdMaestros';
    protected $fillable = ['NombreMaestro', 'Correos','carrera_id'];
 
    //Creamos una funcion se relaciona con tabla maestros
    public function maestros(){
        return $this->belongsToMany(maestro::class, 'IdMaestros', 'NombreMaestro');
    }
    public function carreras(){
        return $this->hasOne(carrera::class , 'IdCarreras','carrera_id');//retornamos una relacion
    }

    public function alumnos()
{
    return $this->hasMany(FormatoAnexo19Mensual::class, 'NombreMaestro', 'NombreMaestro');
}

    public function calificaciones(){
        return $this->belongsTo(Calificacion::class , 'IdCarreras','Maestro_id');//retornamos una relacion
    }

}
