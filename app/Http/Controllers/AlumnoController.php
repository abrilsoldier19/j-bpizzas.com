<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Alumno;



class AlumnoController extends Controller
{
    public function index()
    {
        $alumnos = Alumno::all();
        return view('Alumnos.index', ['Alumnos' => $alumnos]);
    }

    public function create()
    {
        return view('Alumnos.create');
    }

    public function store(Request $request)
    {
        Alumno::create($request->all());
        return redirect()->route('Alumnos.index');
    }

    public function edit($id)
    {
        $alumno = Alumno::findOrFail($id);
        return view('Alumnos.edit', ['Alumno' => $alumno]);
    }

    public function update(Request $request, $id)
    {
        $alumno = Alumno::findOrFail($id);
        $alumno->update($request->all());
        return redirect()->route('Alumnos.index');
    }

    public function destroy($id)
    {
        $alumno = Alumno::findOrFail($id);
        $alumno->delete();
        return redirect()->route('Alumnos.index');
    }
}
