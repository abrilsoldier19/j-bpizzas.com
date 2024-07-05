<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class FormatoAnexo19 extends Model
{
    use HasFactory;

    protected $table = 'formatoanexo19';

    public $timestamps = false;

    protected $primaryKey = 'IdFormatoAnexo19';
    protected $fillable = ['Alumno', 'Materia', 'Carrera', 'Maestro', 'Semestre','turno', 'salon', 'comentarios'];

    public function alumnos(){
        return $this->belongsTo(User::class, 'Alumno', 'id');
    }
    //Creamos una funcion se relaciona con tabla materias
    public function materias(){
        return $this->belongsTo(materia::class, 'Materia', 'IdMaterias');
    }
    public function carreras(){
        return $this->belongsTo(carrera::class, 'Carrera', 'IdCarreras');
    }
    public function horarios()
    {
        return $this->belongsTo(FormatoAnexo19::class, 'turnos', 'turno');
    }
    public function maestros(){
        return $this->hasOne(Maestro::class, 'IdMaestros','Maestro');
    }
    public function semestres(){
        return $this->belongsTo(semestre::class, 'IdSemestres','Semestre');
    }
    public function salones()
    {
        return $this->belongsTo(FormatoAnexo19::class, 'salones' , 'salon');
    }
    public function comentarios()
    {
        return $this->belongsTo(FormatoAnexo19::class, 'IdFormatoAnexo19' , 'comentarios');
    }
}
