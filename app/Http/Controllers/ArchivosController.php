<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\Archivos;
use Illuminate\Support\Facades\Auth;
use Spatie\Permission\Models\Permission;

class ArchivosController extends Controller
{


    public function create(Request $request)
    {
        $currentUser = $request->user();
        $permission = Permission::get();

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

        if (!auth()->user()->hasRole('Alumno')) {
            abort(403); // Return a 403 Forbidden error if the user is not a student
        }

    return view('Archivos.crear', compact('permission', 'currentUser', 'alumnos'));
    }


    public function store(Request $request)
{
    $request->validate([
        'file' => 'required|mimes:csv,txt,xlsx,xls,pdf|max:2048',
    ]);

    $file = $request->file('file');
    $fileName = $file->getClientOriginalName();
    $filePath = $file->storeAs('', $fileName, 'public');

    $archivos = new Archivos();
    $archivos->Alumno_id = $request->input('Alumno_id');
    $archivos->file_path = $filePath;
    $archivos->save();

    

    return redirect()->route('Archivos.index')->with('success', 'Archivo publicado exitosamente.');
}


    public function show($id)
    {
    }

    public function index()
    {
        $user = Auth::user();
        $archivos = Archivos::all();
        $archivos = Archivos::query();
        if ($user->hasRole('Alumno')) {
            // Si el usuario es un alumno, muestra solo sus archivos
            $archivos = Archivos::where('Alumno_id', $user->id)
                ->paginate(10);
        } else {
            // Si el usuario es un administrador, muestra todas las calificaciones
            $archivos = Archivos::paginate(10);
        }
        return view('Archivos.archivos', compact('archivos'));
    }

    public function edit(Request $request, $id)
    {
        if (!auth()->user()->hasRole('Alumno')) {
            abort(403); // Return a 403 Forbidden error if the user is not a student
        }
        return view('Archivos.editar');
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
        $request->validate([
            'file' => 'required|mimes:csv,txt,xlsx,xls,pdf|max:2048',
        ]);
    
        $file = $request->file('file');
        $fileName = time() .  $file->getClientOriginalName();
        $filePath = $file->storeAs($fileName, 'public');
    
        $archivos = new Archivos();
        $archivos->name = $request->input('name');
        $archivos->file_path = $filePath;
        $archivos->save();
    
        return redirect()->route('Archivos.index')->with('success', 'Archivo publicado exitosamente.');
    }

    public function descargar($id)
    {
        $archivo = Archivos::findOrFail($id);

        return Storage::disk('public')->download($archivo->file_path);
    }
    public function destroy($id)
    {
        $archivoss = Archivos::findOrFail($id);
        $archivoss->delete();

        return redirect()->route('Archivos.index')->with('success', 'Archivo eliminada exitosamente.');
    }
}
