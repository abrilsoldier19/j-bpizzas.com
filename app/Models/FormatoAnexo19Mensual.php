<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class FormatoAnexo19Mensual extends Model
{
    use HasFactory;

    protected $table = 'formatoanexomensual19';

    public $timestamps = false;

    protected $primaryKey = 'Alumno_id';
    protected $fillable = ['NombreAlumno', 'NombreMateria', 'NombreCarrera', 'NombreMaestro', 'Semestre','turno', 'salon', 'comentarios'];

   
    public function alumnos(){
        return $this->belongsTo(User::class, 'NombreAlumno', 'id');
    }
    //Creamos una funcion se relaciona con tabla materias
    public function materias(){
        return $this->belongsTo(materia::class, 'NombreMateria', 'IdMaterias');
    }
    public function carreras(){
        return $this->belongsTo(carrera::class, 'NombreCarrera', 'IdCarreras');
    }
    public function horarios()
    {
        return $this->belongsTo(FormatoAnexo19Mensual::class, 'turnos', 'turno');
    }
    public function maestros(){
        return $this->hasOne(Maestro::class, 'IdMaestros','NombreMaestro');
    }
    public function semestres(){
        return $this->belongsTo(semestre::class, 'IdSemestres','Semestre');
    }
    public function salones()
    {
        return $this->belongsTo(FormatoAnexo19Mensual::class, 'salones' , 'salon');
    }
    public function comentarios()
    {
        return $this->belongsTo(FormatoAnexo19Mensual::class, 'IdFormatoAnexo19' , 'comentarios');
    }
}
