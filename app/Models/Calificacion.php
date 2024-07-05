<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

//Agregamos spatie
use Spatie\Permission\Traits\HasRoles;

class Calificacion extends Model
{
    public $timestamps = false;
    use HasFactory;
    protected $primaryKey = 'IdCalificacions';
    protected $fillable = ['Alumno_id', 'Materia_id', 'comentarios','U1','U2','U3','U4','U5','U6','U7','U8', 'U9', 'U10', 'U11', 'U12','Calificacion_Final','Semester','Maestro','Añosemestre','Carrera_id', 'turno','salon'];
 

    public function calificaciones(){
        return $this->hasOne(calificacion::class, 'IdCalificacions','Calificacion_Final');
    } 
    //Creamos una funcion se relaciona con tabla users
    public function alumnos(){
        return $this->hasOne(user::class, 'id','Alumno_id');
    } //belongsToMany
    //Creamos una funcion se relaciona con tabla materias
    public function materias(){
        return $this->hasOne(materia::class, 'IdMaterias','Materia_id');
    }
    //Creamos una funcion se relaciona con tabla semestres
    public function semestres(){
        return $this->belongsTo(semestre::class, 'IdSemestres','Semester');
    }
    //Creamos una funcion se relaciona con tabla maestros
    public function maestros(){
        return $this->hasOne(Maestro::class, 'IdMaestros','Maestro');
    }
    //Creamos una funcion se relaciona con tabla año de curso
    public function añosemestres(){
        return $this->hasOne(añosemestre::class, 'IdAño_semestres','Añosemestre');
    }
     //Creamos una funcion se relaciona con tabla carreras
     public function carreras(){
        return $this->hasOne(carrera::class , 'IdCarreras','Carrera_id');//retornamos una relacion
    }
    public function alumnoreprobados()
    {
        return $this->hasMany(AlumnoReprobado::class, 'Calif_Final_id');
    }

    public function horarios()
    {
        return $this->belongsTo(Calificacion::class, 'IdCalificacions','turno');
    }

    public function salones()
    {
        return $this->belongsTo(Calificacion::class, 'IdCalificacions','salon');
    }
    public function comentarios()
    {
        return $this->hasOne(Formato::class, 'IdFormatos', 'calificacion_id');
    }
}