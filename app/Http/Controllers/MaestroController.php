<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Maestro;
use App\Models\Carrera;
use App\Models\User;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Arr;
use Spatie\Permission\Models\Permission;
use Illuminate\Support\Facades\Auth;

class MaestroController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $maestros = Maestro::all();
        
        $maestros = Maestro::paginate(10);
        return view('Maestros.index', compact('maestros'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        
        $currentUser = $request->user();
        $carreras = Carrera::all();

        if (!$currentUser->hasRole('Administrador')) {
            return redirect()->route('Maestros.crear')->with('error', 'No tienes permiso para agregar maestros.');
        }

        $permission = Permission::get();
        return view('Maestros.crear',compact('permission', 'carreras'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $maestro = new Maestro;
        $maestro ->IdMaestros = $request->input('IdMaestros');
        $maestro ->NombreMaestro = $request->input('NombreMaestro');
        $maestro ->Correos = $request->input('Correos');
        $maestro ->carrera_id = $request->input('carrera_id');
        
        $maestro->save();

        return redirect()->route('Maestros.index');
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
    public function edit(Request $request, $id)
    {
        $currentUser = $request->user();
        $carreras = Carrera::all();

        if (!$currentUser->hasRole('Administrador')) {
            return redirect()->route('Maestros.editar')->with('error', 'No tienes permiso para agregar maestros.');
        }

        $maestro = Maestro::find($id);
        $permission = Permission::get();

        return view('Maestros.editar',compact('permission', 'maestro', 'carreras'));
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
        $maestro = Maestro::find($id);
        $maestro->update($request->all());

        $maestro->save();
        // salva el objeto 'Calificacion' actualizado a la base de datos
        
        return redirect()->route('Maestros.index')->with('success', 'Calificación actualizada exitosamente.'); // redirect the user back to the 'index' view
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $maestro = Maestro::findOrFail($id);
        $maestro->delete();

        return redirect()->route('Maestros.index')->with('success', 'Calificación eliminada exitosamente.');
    }
}
