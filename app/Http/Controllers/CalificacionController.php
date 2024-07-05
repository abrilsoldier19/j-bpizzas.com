<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

//agregamos lo siguiente
use App\Http\Controllers\Controller;
use App\Models\Calificacion;
use App\Models\Alumno;
use App\Models\Carrera;
use App\Models\Materia;
use App\Models\User;
use App\Models\Maestro;
use App\Models\AñoSemestre;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Arr;
use Spatie\Permission\Models\Permission;
use Illuminate\Support\Facades\Auth;
use Illuminate\Pagination\LengthAwarePaginator;

class CalificacionController extends Controller
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
    $calificaciones = Calificacion::query();
    $user = $request->user();
    $permission = Permission::get();

    $materias = Materia::all();
    $carreras = Carrera::all();
    $alumnos = User::all();

    $materiaId = $request->input('Materia_id');
    $filtroAlumno = $request->input('Alumno');
    $filtroSemestre = $request->input('Semestre');
    $filtroCarrera = $request->input('Carrera');
    $filtroTurno = $request->input('turno');
    $filtroSalon = $request->input('salon');

    $calificaciones->join('carreras', 'calificacions.Carrera_id', '=', 'carreras.IdCarreras')
        ->join('users', 'calificacions.Alumno_id', '=', 'users.id');



    if ($filtroCarrera) {
        $calificaciones->where('carreras.IdCarreras', $filtroCarrera);
    }

    if ($filtroAlumno) {
         $calificaciones->where('users.id', $filtroAlumno);
    }

     if ($filtroSemestre) {
        $calificaciones->where('Semester', $filtroSemestre);
    }

    if ($filtroSalon) {
        $calificaciones->where('salon', $filtroSalon);
    }

    if ($filtroTurno) {
       $calificaciones->where('turno', $filtroTurno);
    }
    
    
    if ($user->hasRole('Maestro')) {
        // If the user is a teacher, show only the calificaciones assigned to them
        $calificaciones->where('Maestro', $user->name);
    } elseif ($user->hasRole('Alumno')) {
        // If the user is an alumno, show only their own calificaciones
        $calificaciones->where('Alumno_id', $user->id);
    }

    if ($user->hasRole('Administrador')) {
        $alumnos = User::whereHas('roles', function ($query) {
            $query->where('name', 'Alumno');
        })->get();
        } elseif ($user->hasRole('Maestro')) {
            $alumnos = User::whereHas('roles', function ($query) {
                $query->where('name', 'Alumno');
            })->get();
        } else {
            $alumnos = collect([$user]);
        }
    $calificaciones = $calificaciones->paginate(7)->appends($request->all());

         
    return view('Calificaciones.index', compact('calificaciones', 'materias', 'carreras', 'materiaId', 'filtroCarrera', 'filtroTurno', 'filtroSalon', 'filtroAlumno', 'filtroSemestre', 'alumnos'));
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
        $añosemestres = AñoSemestre::all();

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
    return view('Calificaciones.crear', compact('permission', 'currentUser', 'alumnos', 'carreraAlumno', 'materias',  'carreras', 'maestros', 'añosemestres'));
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
            'Alumno_id' => 'required',
            'Materia_id' => 'required',
            'U1' => 'required',
            'U2' => 'required',
            'U3' => 'required',
            'U4' => 'required',
            'U5' => 'required',
            'U6' => 'required',
            'U7' => 'required',
            'U8' => 'required',
            'U9' => 'required',
            'U10' => 'required',
            'U11' => 'required',
            'U12' => 'required',
            
            'Semester' => 'required',
            'Maestro' => 'required',
            'Añosemestre' => 'required',
            'Carrera_id' => 'required',
            'turno' => 'required',
            'salon'=> 'required',
            // ...resto de las validaciones
        ]);

        $calificacion = new Calificacion;
        $calificacion->Alumno_id = $request->input('Alumno_id');
        $calificacion->Materia_id = $request->input('Materia_id');
        $calificacion->U1 = $request->input('U1');
        $calificacion->U2 = $request->input('U2');
        $calificacion->U3 = $request->input('U3');
        $calificacion->U4 = $request->input('U4');
        $calificacion->U5 = $request->input('U5');
        $calificacion->U6 = $request->input('U6');
        $calificacion->U7 = $request->input('U7');
        $calificacion->U8 = $request->input('U8');
        $calificacion->U9 = $request->input('U9');
        $calificacion->U10 = $request->input('U10');
        $calificacion->U11 = $request->input('U11');
        $calificacion->U12= $request->input('U12');
        $carreraId = $request->input('Carrera_id');
if ($carreraId == 5) {
    $calificacion->Calificacion_Final = ($calificacion->U1 + $calificacion->U2 + $calificacion->U3 + $calificacion->U4 + $calificacion->U5 + $calificacion->U6 + $calificacion->U7 + $calificacion->U8 + $calificacion->U9 + $calificacion->U10 + $calificacion->U11 + $calificacion->U12) / 12;
} else {
    $calificacion->Calificacion_Final = ($calificacion->U1 + $calificacion->U2 + $calificacion->U3 + $calificacion->U4 + $calificacion->U5 + $calificacion->U6) / 6;
}
        $calificacion->Semester = $request->input('Semester');
        $calificacion->Maestro= $request->input('Maestro');
        $calificacion->Añosemestre = $request->input('Añosemestre');
        $calificacion->Carrera_id = $request->input('Carrera_id');
        $calificacion->turno = $request->input('turno');
        $calificacion->salon = $request->input('salon');

        
        $calificacion->save();

        return redirect()->route('Calificaciones.index')->with('success', 'Calificación creada exitosamente.');

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
        $calificacion = Calificacion::findOrFail($id);
        $calificacion->comentarios = $request->input('comentarios');
        $calificacion->save();


        return redirect()->route('Calificaciones.index')->with('success', 'Comentario creada exitosamente.');
    }



    public function edit(Request $request, $id)
    {
         $calificacion = Calificacion::find($id);
         $currentUser = $request->user();
         $permission = Permission::get();
         $carreras = Carrera::all();
         $carreraAlumno = $currentUser->carrera_id;
         $materias = Materia::all();
         $maestros = Maestro::all();
         $añosemestres = AñoSemestre::all();
 
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
     return view('Calificaciones.editar', compact('permission', 'currentUser', 'alumnos', 'materias', 'carreras', 'carreraAlumno', 'maestros', 'calificacion', 'añosemestres'));
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
        $calificacion = Calificacion::find($id);
        
        if (!$calificacion) 
        {
            return redirect()->route('Calificaciones.index')->with('error', 'No se pudo encontrar la calificación que intenta actualizar.');
        }
    
        $calificacion->Alumno_id = $request->input('Alumno_id');
        $calificacion->Materia_id = $request->input('Materia_id');
        $calificacion->U1 = $request->input('U1');
        $calificacion->U2 = $request->input('U2');
        $calificacion->U3 = $request->input('U3');
        $calificacion->U4 = $request->input('U4');
        $calificacion->U5 = $request->input('U5');
        $calificacion->U6 = $request->input('U6');
        $calificacion->U7 = $request->input('U7');
        $calificacion->U8 = $request->input('U8');
        $calificacion->U9 = $request->input('U9');
        $calificacion->U10 = $request->input('U10');
        $calificacion->U11 = $request->input('U11');
        $calificacion->U12= $request->input('U12');
        $carreraId = $request->input('Carrera_id');
        if ($carreraId == 5) {
            $calificacion->Calificacion_Final = ($calificacion->U1 + $calificacion->U2 + $calificacion->U3 + $calificacion->U4 + $calificacion->U5 + $calificacion->U6 + $calificacion->U7 + $calificacion->U8 + $calificacion->U9 + $calificacion->U10 + $calificacion->U11 + $calificacion->U12) / 12;
        } else {
            $calificacion->Calificacion_Final = ($calificacion->U1 + $calificacion->U2 + $calificacion->U3 + $calificacion->U4 + $calificacion->U5 + $calificacion->U6) / 6;
        }
        $calificacion->Semester = $request->input('Semester');
        $calificacion->Maestro = $request->input('Maestro');
        $calificacion->Añosemestre = $request->input('Añosemestre');
        $calificacion->Carrera_id = $request->input('Carrera_id');
        $calificacion->turno = $request->input('turno');
        $calificacion->salon = $request->input('salon');
        
        $calificacion->save();

        return redirect()->route('Calificaciones.index')->with('success', 'Calificación actualizada con éxito.');
    }

    public function show($id) {
        $calificacion = Calificacion::find($id);
        return redirect()->route('Calificaciones.index', compact('calificacion'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $calificacion = Calificacion::findOrFail($id);
        $calificacion->delete();

        return redirect()->route('Calificaciones.index')->with('success', 'Calificación eliminada exitosamente.');
    }
}
