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

class Carrera extends Model
{
    use HasFactory, HasApiTokens, Notifiable, HasRoles ;
    // use HasRoles;

    protected $table = 'carreras';
    protected $fillable = ['NombreCarrera'];

    //Creamos una funcion 
    public function maestros(){
        return $this->hasMany(maestro::class);
    }

    public function materias()
    {
        return $this->hasMany(Materia::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function alumnos()
{
    return $this->hasMany(Alumno::class);
}
public function carreras()
{
    return $this->hasMany(User::class);
}
}
