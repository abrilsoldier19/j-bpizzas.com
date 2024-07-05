<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

//agregamos lo siguiente
use App\Http\Controllers\Controller;

use App\Models\User;
use App\Models\Alumno;
use App\Models\Maestro;
use App\Models\Carrera;
use App\Models\FormatoAnexo19Mensual;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\DB;
use App\Models\Materia;
use App\Models\Calificacion;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Arr;
use Spatie\Permission\Models\Permission;
use Illuminate\Support\Facades\Auth;
use Illuminate\Pagination\LengthAwarePaginator;
use PDF;

class FormatoAnexo19MensualController extends Controller
{
    // $data = Process::with('user')->findOrFail(Auth::id()); 
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

     public function index(Request $request)
{
    $user = Auth::user();
    $formatos = FormatoAnexo19Mensual::query();
    $filtroCarrera = $request->input('carrera');
    $filtroSalon = $request->input('salon');
    $filtroTurno = $request->input('turno');
    $maestroId = $request->input('Maestro_id');

    // Use aliases for the table names in the JOIN clause
    $formatos->join('carreras', 'formatoanexomensual19.NombreCarrera', '=', 'carreras.IdCarreras');

    //filtro de carrera
    if ($filtroCarrera) {
        $formatos->where('carreras.IdCarreras', $filtroCarrera);
    }

    //filtro maestro
    if ($maestroId) {
        $formatos->where('NombreMaestro', $maestroId);
    }

    if ($filtroSalon) {
        $formatos->where('salon', $filtroSalon);
    }

    if ($filtroTurno) {
        $formatos->where('turno', $filtroTurno);
    }

    if ($user->hasRole('Maestro')) {
        // If the user is a teacher, show only the records assigned to them
        $formatos->where('NombreMaestro', $user->name);

        // Include the students assigned to the teacher
        $formatos->with('alumnos');
    }

    $formatos = $formatos->paginate(10);
    $materias = Materia::all();
    $carreras = Carrera::all();
    $maestros = Maestro::all();
    $fechaActual = now();

    return view('FormatoAnexo19Mensual.index', compact('formatos', 'materias', 'carreras', 'maestros', 'fechaActual', 'filtroCarrera', 'maestroId', 'user', 'filtroTurno', 'filtroSalon'));
}

     public function guardarCheckpoints(Request $request)
     {
        $idAlumno = $request->input('Alumno_id');
        $checkpoint1 = $request->input('checkpoint1') ? true : false;
        $checkpoint2 = $request->input('checkpoint2') ? true : false;
        $checkpoint3 = $request->input('checkpoint3') ? true : false;

        $formato = FormatoAnexo19Mensual::find($idAlumno);

        if ($formato) {
            $formato->checkpoint1 = $checkpoint1;
            $formato->checkpoint2 = $checkpoint2;
            $formato->checkpoint3 = $checkpoint3;
            $formato->save();
            return redirect()->back()->with('success', 'Checkpoints guardados exitosamente.');
        } else {
            return redirect()->back()->with('error', 'El registro no se encontró.');
        }

     }

     
     
     
          public function filtrar(Request $request)
         { 
              $user = Auth::user();
     
             // Obtener los parámetros de búsqueda del formulario
             $alumno = $request->input('Alumno');
             $semestre = $request->input('Semestre');
             $carrera = $request->input('Carrera');
             $turno = $request->input('turno');
             $salon = $request->input('salon');
     
             // Obtener las calificaciones según los filtros
             $query = FormatoAnexo19Mensual::query();
     
             if ($user->hasRole('Maestro')) {
             // Si el usuario es un maestro, mostrar solo las calificaciones asignadas a él
             $query->where('NombreMaestro', $user->name);
             } elseif ($user->hasRole('Alumno')) {
             // Si el usuario es un alumno, mostrar solo las calificaciones asignadas a él
             $query->where('NombreAlumno', $user->id);
             }
     
             if (!empty($alumno)) {
             $query->where('NombreAlumno', $alumno);
             }
     
            if (!empty($semestre)) {
             $query->where('Semestre', $semestre);
            }
     
            if (!empty($carrera)) {
             $query->where('NombreCarrera', $carrera);
            }
     
            if (!empty($turno)) {
             $query->where('turno', $turno);
            }
     
            if (!empty($salon)) {
             $query->where('salon', $salon);
            }
     
            $formatos = $query->paginate(10);
     
            return view('FormatoAnexo19Mensual.index', compact('formatos'));
         }
     
         /**
          * Show the form for creating a new resource.
          *
          * @return \Illuminate\Http\Response
          */
         public function create(Request $request)
         {
             $currentUser = $request->user();
             $permission = Permission::get();
             $carreras = Carrera::all();
             $carreraAlumno = $currentUser->carrera_id;
             $materias = Materia::all();
             $maestros = Maestro::all();
     
             // Obtén los alumnos según el tipo de usuario
             if ($currentUser->hasRole('Administrador')) {
             $alumnos = User::whereHas('roles', function ($query) {
                 $query->where('name', 'Alumno');
             })->get();
             } elseif ($currentUser->hasRole('Maestro')) {
                 $alumnos = User::whereHas('roles', function ($query) {
                     $query->where('name', 'Alumno');
                 })->get();
             } else {
                 $alumnos = collect([$currentUser]);
             }
         return view('FormatoAnexo19Mensual.crear', compact('permission', 'currentUser', 'alumnos', 'carreraAlumno', 'materias',  'carreras', 'maestros'));
         }
     
     
         /**
          * Store a newly created resource in storage.
          *
          * @param  \Illuminate\Http\Request  $request
          * @return \Illuminate\Http\Response
          */
         public function store(Request $request)
         {
             $request->validate([
                 'NombreAlumno' => 'required',
                 'NombreMateria' => 'required',
                 
                 'Semestre' => 'required',
                 'NombreMaestro' => 'required',
                 'NombreCarrera' => 'required',
                 'turno' => 'required',
                 'salon'=> 'required',
                 // ...resto de las validaciones
             ]);
     
             $formato = new FormatoAnexo19Mensual;
             $formato->NombreAlumno = $request->input('NombreAlumno');
             $formato->NombreMateria = $request->input('NombreMateria');
             $formato->Semestre = $request->input('Semestre');
             $formato->NombreMaestro = $request->input('NombreMaestro');
             $formato->NombreCarrera = $request->input('NombreCarrera');
             $formato->turno = $request->input('turno');
             $formato->salon = $request->input('salon');
     
             
             $formato->save();
     
             return redirect()->route('FormatoAnexo19Mensual.index')->with('success', 'Calificación creada exitosamente.');
     
         }
     
         /**
          * Display the specified resource.
          *
          * @param  int  $id
          * @return \Illuminate\Http\Response
          */
         
     
         /**
          * Show the form for editing the specified resource.
          *
          * @param  int  $id
          * @return \Illuminate\Http\Response
          */
     
          public function agregarComentarios(Request $request)
    {
        $id = $request->input('id');
        $formato = FormatoAnexo19Mensual::findOrFail($id);
        $formato->comentarios = $request->input('comentarios');
        $formato->save();


        return redirect()->route('FormatoAnexo19Mensual.index')->with('success', 'Comentario creada exitosamente.');
    }
     
     
     
         public function edit(Request $request, $id)
         {
              $formato = FormatoAnexo19Mensual::find($id);
              $currentUser = $request->user();
              $permission = Permission::get();
              $carreras = Carrera::all();
              $carreraAlumno = $currentUser->carrera_id;
              $materias = Materia::all();
              $maestros = Maestro::all();
      
              // Obtén los alumnos según el tipo de usuario
              if ($currentUser->hasRole('Administrador')) {
              $alumnos = User::whereHas('roles', function ($query) {
                  $query->where('name', 'Alumno');
              })->get();
              } elseif ($currentUser->hasRole('Maestro')) {
                  $alumnos = User::whereHas('roles', function ($query) {
                      $query->where('name', 'Alumno');
                  })->get();
              } else {
                  $alumnos = collect([$currentUser]);
              }
          return view('FormatoAnexo19Mensual.editar', compact('permission', 'currentUser', 'alumnos', 'materias', 'carreras', 'carreraAlumno', 'maestros', 'formato'));
         }

         
     
         /**
          * Update the specified resource in storage.
          *
          * @param  \Illuminate\Http\Request  $request
          * @param  int  $id
          * @return \Illuminate\Http\Response
          */
         public function update(Request $request, $id)
         {
             $formato = FormatoAnexo19Mensual::find($id);
             
             if (!$formato) 
             {
                 return redirect()->route('FormatoAnexo19Mensual.index')->with('error', 'No se pudo encontrar la calificación que intenta actualizar.');
             }
         
             $formato->NombreAlumno = $request->input('NombreAlumno');
             $formato->NombreMateria = $request->input('NombreMateria');
             $formato->Semestre = $request->input('Semestre');
             $formato->NombreMaestro = $request->input('NombreMaestro');
             $formato->NombreCarrera = $request->input('NombreCarrera');
             $formato->turno = $request->input('turno');
             $formato->salon = $request->input('salon');
             
             $formato->save();
     
             return redirect()->route('FormatoAnexo19Mensual.index')->with('success', 'Calificación actualizada con éxito.');
         }

         

         
     
         public function show($id) {
             $formato = FormatoAnexo19Mensual::find($id);
             return redirect()->route('FormatoAnexo19Mensual.index', compact('formato'));
         }
     
         /**
          * Remove the specified resource from storage.
          *
          * @param  int  $id
          * @return \Illuminate\Http\Response
          */
         public function destroy($id)
         {
             $formato = FormatoAnexo19Mensual::findOrFail($id);
             $formato->delete();
     
             return redirect()->route('FormatoAnexo19Mensual.index')->with('success', 'Calificación eliminada exitosamente.');
         }
}
