
@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Alumnos</h1>
        <table class="table">
            <thead>
                <tr>
                    <th>Id</th>
                    <th>Nombre</th>
                    <th>Correo</th>
                    <th>Materia</th>
                    <th>Maestro</th>
                    <th>Semestre</th>
                    <th>Calificación Final</th>
                    <th>Carrera</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($alumnos as $alumno)
                    <tr>
                        <td>{{ $alumno->IdAlumnos }}</td>
                        <td>{{ $alumno->nombre }}</td>
                        <td>{{ $alumno->correo }}</td>
                        <td>{{ $alumno->materia }}</td>
                        <td>{{ $alumno->maestro }}</td>
                        <td>{{ $alumno->semestre }}</td>
                        <td>{{ $alumno->calificacion_final }}</td>
                        <td>{{ $alumno->carrera }}</td>
                    </tr>
                    <td>
                    @can('editar-alumno')
                        <a href="{{ route('alumnos.edit', $alumno->id) }}" class="btn btn-sm btn-primary">Editar</a>
                    @endcan
                    @can('borrar-alumno')
                        <form action="{{ route('alumnos.destroy', $alumno->id) }}" method="POST" style="display: inline-block;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-danger">Borrar</button>
                        </form>
                    @endcan
                </td>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection

@can('crear-rol')
    <a href="{{ route('Alumnos.create') }}" class="btn btn-success">Agregar</a>
@endcan