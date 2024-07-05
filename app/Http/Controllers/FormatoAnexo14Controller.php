<?php

namespace App\Http\Controllers;

use App\Models\Maestro;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

//agregamos lo siguiente
use App\Http\Controllers\Controller;
use App\Models\AlumnoReprobado;
use App\Models\User;
use App\Models\Carrera;
use App\Models\Semestre;
use App\Models\FormatoAnexo14;
use App\Models\Materia;
use App\Models\Calificacion;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Arr;
use Spatie\Permission\Models\Permission;
use Illuminate\Support\Facades\Auth;
use Illuminate\Pagination\LengthAwarePaginator;

class FormatoAnexo14Controller extends Controller
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
    $permission = Permission::get();

    $formatos = FormatoAnexo14::query();

    $materias = Materia::all();
    $carreras = Carrera::all();
    $semestres = Semestre::all();
    $maestros = Maestro::all();

    $formatos->join('carreras', 'formatoanexo14.Carrera_id', '=', 'carreras.IdCarreras')
        ->join('materias', 'formatoanexo14.Materia_id', '=', 'materias.IdMaterias')
        ->join('semestres', 'formatoanexo14.Semestre_id', '=', 'semestres.IdSemestres');
    
    if ($user->hasRole('Maestro')) {
        // Si el usuario es un maestro, muestra solo las calificaciones asignadas a él
        $formatos->where('Maestro', $user->name);
    } elseif ($user->hasRole('Alumno')) {
        // Si el usuario es un alumno, muestra solo sus propias calificaciones
        $formatos->where('Alumno_id', $user->id);
    }
    
    // Aplicar filtros
    $filtroCarrera = $request->input('carrera');
    $filtroTurno = $request->input('turno');
    $filtroSemestre = $request->input('semestre');
    $filtroSalon = $request->input('salon');

    if ($filtroCarrera) {
        $formatos->where('carreras.IdCarreras', $filtroCarrera);
    }
    
    if ($filtroTurno) {
        $formatos->where('Turno', $filtroTurno);
    }
    
    if ($filtroSemestre) {
        $formatos->where('semestres.IdSemestres', $filtroSemestre);
    }
    
    if ($filtroSalon) {
        $formatos->where('Salon', $filtroSalon);
    }
    
    $formatos = $formatos->paginate(10);

    return view('FormatoAnexo14.index', compact('formatos', 'materias', 'carreras', 'semestres', 'maestros', 'filtroCarrera', 'filtroTurno', 'filtroSalon', 'filtroSemestre'));
}



     public function filtrar(Request $request)
    { 
        $formatos = FormatoAnexo14::query();

        $filtroCarrera = $request->input('Carrera_id');
        $filtroTurno = $request->input('Turno');
        $filtroSemestre = $request->input('Semestre_id');
        $filtroSalon = $request->input('Salon');
    
        if ($filtroCarrera) {
            $formatos->where('carreras.IdCarreras', $filtroCarrera);
        }
        
        if ($filtroTurno) {
            $formatos->where('Turno', $filtroTurno);
        }
        
        if ($filtroSemestre) {
            $formatos->where('semestres.IdSemestres', $filtroSemestre);
        }
        
        if ($filtroSalon) {
            $formatos->where('Salon', $filtroSalon);
        }
    
        return view('FormatoAnexo14.index', ['formatos' => $formatos]);
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
        $carreraAlumno = $currentUser->Carrera_id;
        $materias = Materia::all();
        $semestres = Semestre::all();
        $maestros = Maestro::all();

        // Obtén los alumnos según el tipo de usuario
        if ($currentUser->hasRole('Administrador')) {
        $alumnos = User::whereHas('roles', function ($query) {
            $query->where('name', 'Alumno_id');
        })->get();
        } elseif ($currentUser->hasRole('Maestro')) {
            $alumnos = User::whereHas('roles', function ($query) {
                $query->where('name', 'Alumno_id');
            })->get();
        } else {
            $alumnos = collect([$currentUser]);
        }

    return view('FormatoAnexo14.crear', compact('permission', 'currentUser', 'alumnos', 'carreraAlumno', 'materias',  'carreras','semestres','maestros'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'Alumno_id' => 'required',
            'Materia_id' => 'required',
            'Maestro' => 'required',
            'U1' => 'required',
            'U2' => 'required',
            'U3' => 'required',
            'U4' => 'required',
            'U5' => 'required',
            'U6' => 'required',
            'U7' => 'required',
            'U8' => 'required',
            
            'Semestre_id' => 'required',
            'Carrera_id' => 'required',
            'Turno' => 'required',
            'Salon'=> 'required',
            // ...resto de las validaciones
        ]);

        $formatos = new FormatoAnexo14;
        $formatos->Alumno_id = $request->input('Alumno_id');
        $formatos->Materia_id = $request->input('Materia_id');
        $formatos->Maestro = $request->input('Maestro');
        $formatos->U1 = $request->input('U1');
        $formatos->U2 = $request->input('U2');
        $formatos->U3 = $request->input('U3');
        $formatos->U4 = $request->input('U4');
        $formatos->U5 = $request->input('U5');
        $formatos->U6 = $request->input('U6');
        $formatos->U7 = $request->input('U7');
        $formatos->U8 = $request->input('U8');
        $formatos->Semestre_id = $request->input('Semestre_id');
        $formatos->Carrera_id = $request->input('Carrera_id');
        $formatos->Turno = $request->input('Turno');
        $formatos->Salon = $request->input('Salon');

        
        $formatos->save();
        return redirect()->route('FormatoAnexo14.index')->with('success', 'Unidades actualizadas exitosamente.');
    }

    public function guardarTabla(Request $request)
{
    $datos = $request->input('datos');

    // Check if $datos is null before proceeding
    if (!is_null($datos)) {
        // Recorrer los datos y guardarlos en la base de datos
        foreach ($datos as $fila) {
            $formatos = formatosAnexo14::find($fila['id']);
            $formatos->Alumno_id = $fila['Alumno_id'];
            $formatos->Materia_id = $fila['Materia_id'];
            $formatos->Maestro = $fila['Maestro'];
            $formatos->Semestre_id = $fila['Semestre_id'];
            $formatos->Carrera_id = $fila['Carrera_id'];
            $formatos->Turno = $fila['Turno'];
            $formatos->Salon = $fila['Salon'];
            $formatos->U1 = $fila['U1'];
            $formatos->U2 = $fila['U2'];
            $formatos->U3 = $fila['U3'];
            $formatos->U4 = $fila['U4'];
            $formatos->U5 = $fila['U5'];
            $formatos->U6 = $fila['U6'];
            $formatos->U7 = $fila['U7'];
            $formatos->U8 = $fila['U8'];
            $formatos->observaciones = $fila['observaciones'];
            $formatos->save();
        }
        return response()->json(['success' => true]);
    } else {
        return response()->json(['success' => false]);
    }
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
        $formatos = FormatoAnexo14::findOrFail($id);
        $formatos->observaciones = $request->input('observaciones');
        $formatos->save();

        //return $user->hasRole('Maestro'|'Administrador');

        return redirect()->route('FormatoAnexo14.index')->with('success', 'Comentario creada exitosamente.');
    }



    public function edit(Request $request, $id)
    {
        $formatos = FormatoAnexo14::find($id);
         $currentUser = $request->user();
         $permission = Permission::get();
         $carreras = Carrera::all();
         $carreraAlumno = $currentUser->carrera_id;
         $materias = Materia::all();
         $maestros = Maestro::all();
         $semestres = Semestre::all();
 
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
 
     return view('FormatoAnexo14.editar', compact('permission', 'currentUser', 'alumnos', 'materias', 'carreras', 'carreraAlumno', 'maestros', 'formatos', 'semestres'));
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
        $formatos = FormatoAnexo14::find($id);
        
        if (!$formatos) 
        {
            return redirect()->route('FormatoAnexo14.index')->with('error', 'No se pudo encontrar la calificación que intenta actualizar.');
        }

        $formatos->Alumno_id = $request->input('Alumno_id');
        $formatos->Materia_id = $request->input('Materia_id');
        $formatos->Maestro = $request->input('Maestro');
        $formatos->U1 = $request->input('U1');
        $formatos->U2 = $request->input('U2');
        $formatos->U3 = $request->input('U3');
        $formatos->U4 = $request->input('U4');
        $formatos->U5 = $request->input('U5');
        $formatos->U6 = $request->input('U6');
        $formatos->U7 = $request->input('U7');
        $formatos->U8 = $request->input('U8');
        $formatos->Semestre_id = $request->input('Semestre_id');
        $formatos->Carrera_id = $request->input('Carrera_id');
        $formatos->Turno = $request->input('Turno');
        $formatos->Salon = $request->input('Salon');
        
        $formatos->save();

        return redirect()->route('FormatoAnexo14.index')->with('success', 'Calificación actualizada con éxito.');
    }

    public function show($id) {
        $formatos= FormatoAnexo14::find($id);
        return view('FormatoAnexo14.index', compact('formatos'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $formatos = FormatoAnexo14::findOrFail($id);
        $formatos->delete();

        return redirect()->route('FormatoAnexo14.index')->with('success', 'Calificación eliminada exitosamente.');
    }
}
