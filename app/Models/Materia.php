<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class Materia extends Model
{
    public $timestamps = false;
    use HasFactory;
    protected $primaryKey = 'IdMaterias';
    protected $fillable = ['NombreMateria', 'carrera_id', 'semestre_id'];

    //Creamos una funcion se relaciona con tabla carreras
    public function carreras(){
        return $this->belongsTo(carrera::class , 'carrera_id', 'IdCarreras');//retornamos una relacion
    }

    public function semestres(){
        return $this->belongsTo(Semestre::class , 'semestre_id', 'IdSemestres');//retornamos una relacion
    }

    public function calificaciones()
{
    return $this->hasMany(Calificacion::class, 'Materia_id');
}
}
