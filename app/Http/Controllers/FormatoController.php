<?php

namespace App\Http\Controllers;

use App\Models\Maestro;
use Illuminate\Http\Request;

//agregamos lo siguiente
use App\Http\Controllers\Controller;
use App\Models\Calificacion;
use App\Models\AlumnoReprobado;
use App\Models\User;
use App\Models\Carrera;
use App\Models\Semestre;
use App\Models\Formato;
use App\Models\Materia;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Arr;
use Spatie\Permission\Models\Permission;
use Illuminate\Support\Facades\Auth;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Pagination\Paginator;

class FormatoController extends Controller
{
    // $data = Process::with('user')->findOrFail(Auth::id()); 
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

     

     public function index(Request $request)
     {
         $query = Calificacion::select('Alumno_id')->get();
         $carreras = Carrera::all();
         $comentarios = Formato::all();
         $calificaciones = Calificacion::all();
         $maestros = Maestro::all();
         $turnos = Calificacion::all();
         $salones = Calificacion::all();
         $semestres = Semestre::all();

         $subjects = Calificacion::join('materias', 'materias.IdMaterias', '=', 'calificacions.Materia_id')
         ->select('materias.NombreMateria')
         ->distinct()
         ->get();


         $estudiantes = Calificacion::join('users', 'users.id', '=', 'calificacions.Alumno_id')
         ->join('materias', 'materias.IdMaterias', '=', 'calificacions.Materia_id')
         ->select('users.name', 'materias.NombreMateria', 'calificacions.U1', 'calificacions.U2', 'calificacions.U3', 'calificacions.U4', 'calificacions.U5', 'calificacions.U6', 'calificacions.U7', 'calificacions.U8', 'calificacions.U9', 'calificacions.U10', 'calificacions.U11', 'calificacions.U12')
         ->distinct()->where('Calificacion_Final', '<', 6.9);
        
     // Filter by selected semester and optionally by selected career
          $semestreId = $request->input('Semestre_id');
          $carreraId = $request->input('carrera_id');
          // Filter calificaciones by selected units
          $turnoId = $request -> input('turno');
          $salonId = $request -> input('salon');
          $maestroId = $request -> input('maestro');
          
        if (request()->has('carrera_id')) {
            $carreraId = request('carrera_id');
            $estudiantes->where('calificacions.Carrera_id', $carreraId);
        }

        if ($semestreId) {
            $estudiantes->whereRaw("calificacions.Semester LIKE '%$semestreId%'");
        }

        if ($turnoId) {
            $estudiantes->whereRaw("calificacions.turno LIKE '%$turnoId%'");
        }

        if ($salonId) {
            $estudiantes->whereRaw("calificacions.salon LIKE '%$salonId%'");
        }

        if ($maestroId) {
            $estudiantes->whereRaw("calificacions.Maestro LIKE '%$maestroId%'");
        }

        if (auth()->user()->hasRole('Maestro')) {
            // If the user is a teacher, filter only the students assigned to the teacher
            $estudiantes->where('calificacions.Maestro', auth()->user()->name);
        }

        $maestros = Maestro::with('calificaciones')->get();
        $estudiantes = $estudiantes->paginate(4)->appends($request->all());
     
     
         // Obtener la lista de alumnos distintos
         $alumnos = Calificacion::select('Alumno_id')->distinct()->get();
     
         // Obtener la lista de materias relacionadas con las calificaciones
         $calificaciones = Calificacion::first();
         $calificaciones = Calificacion::with('comentarios')->get();
         $calificaciones = Calificacion::select('U1', 'U2', 'U3','U4','U5','U6','U7', 'U8', 'U9', 'U10','U11','U12')->distinct()->get();
     
          // Filtrar por carrera seleccionada
         if (request()->has('carrera_id')) {
             $carreraId = request('carrera_id');
     
         } else {
             $alumnos = collect(); // Crear una colección vacía de alumnos
             $materias = collect(); // Crear una colección vacía de materias
             $semestres = collect();
             $calificaciones = collect();// Crear una colección vacía de calificaciones
             $maestros = collect();
             $calificacionesPorUnidad = [];
         }
            $calificaciones = Calificacion::with('materias')->get();
            $calificaciones->each(function ($calificacion) {
             $alumno = optional(Calificacion::find($calificacion->Alumno_id));
             $calificacion->alummos = $alumno->Alumno_id ?? null;
             $calificacion->materias = optional(Materia::find($calificacion->Materia_id))->NombreMateria;
         });
         // Filter calificaciones by selected units
         
         $formatos = Formato::paginate(6);
         return view('Formatos.index', compact('carreras', 'alumnos', 'estudiantes', 'subjects','semestres', 'calificaciones', 'maestros', 'turnos', 'salones', 'formatos', 'carreraId', 'maestroId'));
     }
     
     public function agregarComentarios(Request $request)
     {
         $formatoId = $request->input('calificacion_id');
         $observaciones = $request->input('observaciones');
     
         $formato = Formato::findOrFail($formatoId);
         $formato->observaciones = $observaciones;
         $formato->save();
     
         return redirect()->route('Formatos.index')->with('success', 'Comentario creado exitosamente.');
     }

    public function edit(Request $request, $id)
    {
        $formato = Formato::find($id);
        $permission = Permission::get();
    
        return view('Formatos.editar', compact('permission', 'formato'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function show($id) {
        $formato= Formato::find($id);
        return view('Formatos.index', compact('formato'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $formato = Formato::findOrFail($id);
        $formato->delete();

        return redirect()->route('Formatos.index')->with('success', 'Calificación eliminada exitosamente.');
    }
}
