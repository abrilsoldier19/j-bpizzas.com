<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

//agregamos lo siguiente
use App\Http\Controllers\Controller;
use App\Models\Carrera;
use App\Models\Materia;
use App\Models\User;
use App\Models\Semestre;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Arr;
use Spatie\Permission\Models\Permission;

class MateriaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $carreras = Carrera::all();
        $semestres = Semestre::all();
        $materias = Materia::all();
        $materias = Materia::paginate(6); //definimos variable 
        return view('Materias.index', array('materias'=>$materias, 'carreras'=>$carreras, 'semestres'=>$semestres)); //llama la vista para ser visualizada
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $permission = Permission::get();
        $carreras = Carrera::all();
        $semestres = Semestre::all();
        return view('Materias.crear',compact('permission', 'carreras', 'semestres')); 
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
            'NombreMateria' => 'required',
            'carrera_id' => 'required',
            'semestre_id' => 'required',
            // ...resto de las validaciones
        ]);

        $materia = new Materia;
        $materia->NombreMateria = $request->input('NombreMateria');
        $materia->carrera_id = $request->input('carrera_id');
        $materia->semestre_id = $request->input('semestre_id');

        
        $materia->save();

        return redirect()->route('Materias.index')->with('success', 'Materia creada exitosamente.');

    }


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $materia = Materia::find($id);
        $carreras = Carrera::all();
        $semestres = Semestre::all();
        $permission = Permission::get();
        return view('Materias.editar',compact('permission', 'materia', 'carreras', 'semestres')); 
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
        $materia = Materia::find($id);
        
        if (!$materia) 
        {
            return redirect()->route('Materias.index')->with('error', 'No se pudo encontrar la calificación que intenta actualizar.');
        }
    
        $materia->NombreMateria = $request->input('NombreMateria');
        $materia->carrera_id = $request->input('carrera_id');
        $materia->semestre_id = $request->input('semestre_id');
        
        $materia->save();

        return redirect()->route('Materias.index')->with('success', 'Calificación actualizada con éxito.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $materia = Materia::findOrFail($id);
        $materia->delete();

        return redirect()->route('Materias.index')->with('success', 'Calificación eliminada exitosamente.');
    }
}
