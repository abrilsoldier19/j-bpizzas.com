@extends('layouts.app')

@section('content')
<section class="section">
    <head>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
    </head>
    <div class="section-header" style="display: flex; justify-content: center; align-items: center; ">
        <h3 style="font-weight: bold; font-size: 40px; font-family: Century Gothic, sans-serif; color: #012EBF;">Calificaciones</h3>
    </div>


    
    <div class="card-body">
       <h4 align="center" style="font-family: Consolas, sans-serif;"> Bienvenido  {{ auth()->user()->name }} {{ auth()->user()->email }} </h4>
    </div>
    @if (Auth::user()->hasRole('Administrador') || Auth::user()->hasRole('Maestro'))
  <form action="{{ route('Calificaciones.index') }}" method="GET">
    <div class="form-row justify-content-center">
        <div class="col-lg-2">
            <select class="form-control no-print" name="salon">
                <option value="">Salones</option>
                <option value="Salon A">Salon A</option>
                <option value="Salon B">Salon B</option>
                <option value="Salon C">Salon C</option>
                <option value="Salon D">Salon D</option>
                <option value="Salon E">Salon E</option>
                <option value="Salon F">Salon F</option>
                <option value="Salon G">Salon G</option>
                <option value="Salon H">Salon H</option>
            </select>
        </div>
        <div class="col-lg-2">
            <select class="form-control no-print" name="turno">
                <option value="">Turnos</option>
                <option value="Matutino">Matutino</option>
                <option value="Vespertino">Vespertino</option>
            </select>
        </div>
        <div class="col-lg-2">
            <select class="form-control no-print" name="Carrera" id="carrera">
                <option value="">Todos los carreras</option>
                @foreach ($carreras as $carrera)
                    <option value="{{ $carrera->IdCarreras }}" {{ $filtroCarrera == $carrera->IdCarreras ? 'selected' : '' }}>{{ $carrera->NombreCarrera }}</option>
                @endforeach
            </select>
        </div>
        <div class="col-lg-2">
            <select class="form-control no-print" name="Alumno" id="Alumno">
                <option value="">Todos los alumnos</option>
                @foreach($alumnos as $alumno)
                @if($alumno)
                    <option value="{{ $alumno->id }}">{{ $alumno->name }}</option>
                @endif
            @endforeach
            </select>
        </div>
        <div class="col-lg-2">
            <select class="form-control no-print" name="Semestre">
                <option value="">Semestres</option>
                <option value="1er Semestre">1er Semestre</option>
                <option value="2do Semestre">2do Semestre</option>
                <option value="3er Semestre">3er Semestre</option>
                <option value="4to Semestre">4to Semestre</option>
                <option value="5to Semestre">5to Semestre</option>
                <option value="6to Semestre">6to Semestre</option>
            </select>
        </div>
    </div>
    <div class="form-row justify-content-center">
        <div class="col-lg-1.5">
            <button type="submit" class="btn btn-primary btn-block">Buscar</button>
        </div>
    </div>
</form>
@endif
      <div class="section-body">
          <div class="row">
              <div class="col-lg-12">
                  <div class="card">
                      <div class="card-body">
                        @can('crear-rol')
                        <a class="btn btn-success" href="{{ route('Calificaciones.create') }}">Nuevo</a>                        
                        @endcan
                            <table class="table table-striped mt-2" style="font-family: Century Gothic, sans-serif;">
                                <thead style="background-color:#6777ef">
                                     <th style="color:#fff;">Alumno</th> <!--Nombre de columnas -->
                                     <th style="color:#fff;">Materia</th>
                                     @if (Auth::user()->hasRole('Maestro'))
                                          <th style="color:#fff;">Comentarios</th>
                                     @endif
                                     @can('Administrador-rol') 
                                          <th style="color:#fff;">Comentarios</th>
                                     @endcan
                                     @if (Auth::user()->hasRole('Maestro'))
                                     <th style="color:#fff;"></th>
                                     @endif
                                     <th style="color:#fff;">U1</th>
                                     <th style="color:#fff;">U2</th>
                                     <th style="color:#fff;">U3</th>
                                     <th style="color:#fff;">U4</th>
                                     <th style="color:#fff;">U5</th>
                                     <th style="color:#fff;">U6</th>
                                     <th style="color:#fff;">U7</th>
                                     <th style="color:#fff;">U8</th>
                                     <th style="color:#fff;">U9</th>
                                     <th style="color:#fff;">U10</th>
                                     <th style="color:#fff;">U11</th>
                                     <th style="color:#fff;">U12</th>
                                     <th style="color:#fff;">Semestre</th>
                                     <th style="color:#fff;">Maestro</th>
                                     <th style="display: ;">Año Semestre</th>
                                     <th style="display: ;">Carrera</th>
                                     <th style="display: ;">Horario</th>
                                     <th style="display: ;">Salon</th>
                                     <th style="color:#fff;">Acciones</th>
                                     @if (Auth::user()->hasRole('maestro'))
                                         <th>Acciones</th>
                                     @endif
                                </thead>
                                <tbody>
                                    @foreach ($calificaciones as $calificacion) {{--foreach a nivel de vista  --}}
                                    
                                    <tr>
                                    <td style="">{{$calificacion->alumnos->name}}
                                        {{-- <td style="">{{\Illuminate\Support\Facades\Auth::user()->name}}</td> --}}
                                        <td>{{$calificacion->materias->NombreMateria}}</td>
                                        @if (Auth::user()->hasRole('Maestro'))
                                           <td> 
                                               <form action="{{ route('Calificaciones.agregarComentarios') }}" method="POST">
                                                   @csrf
                                                   <input type="hidden" name="id" value="{{ $calificacion->IdCalificacions }}">
                                                   <textarea name="comentarios">{{$calificacion->comentarios}}</textarea>
                                                   <button type="submit" class="btn btn-dark" href="{{ route('Calificaciones.agregarComentarios') }}">Guardar</button>
                                               </form>
                                           </td>
                                        @endif
                                        @if (Auth::user()->hasRole('Administrador') || Auth::user()->hasRole('Maestro'))
                                        <td>{{$calificacion->comentarios}}</td>
                                        @endif
                                        <td>{{$calificacion->U1}}</td>
                                        <td>{{$calificacion->U2}}</td>
                                        <td>{{$calificacion->U3}}</td>
                                        <td>{{$calificacion->U4}}</td>
                                        <td>{{$calificacion->U5}}</td>
                                        <td>{{$calificacion->U6}}</td>
                                        <td>{{$calificacion->U7}}</td>
                                        <td>{{$calificacion->U8}}</td>
                                        <td>{{$calificacion->U9}}</td>
                                        <td>{{$calificacion->U10}}</td>
                                        <td>{{$calificacion->U11}}</td>
                                        <td>{{$calificacion->U12}}</td>
                                        <td>{{$calificacion->Semester}}</td>
                                        <td>{{$calificacion->Maestro}}</td>
                                        <td style="display: ;">{{$calificacion->Añosemestre}}</td>
                                        <td style="display: ;">{{$calificacion->carreras->NombreCarrera}}</td>
                                        <td style="display: ;">{{$calificacion->turno}}</td>
                                        <td style="display: ;">{{$calificacion->salon}}</td>
                                        {{-- boton Editar --}}
                                        <td>  
                                            @can('editar-rol') 
                                            <a class="btn btn-info" href="{{ route('Calificaciones.edit', $calificacion->IdCalificacions) }}">Editar</a>
                                            @endcan
                                            {{--boton borrar--}}
                                            @can('borrar-rol')
                                            {!! Form::open(['method' => 'DELETE','route' => ['Calificaciones.destroy', $calificacion->IdCalificacions],'style'=>'display:inline']) !!}
                                            {!! Form::submit('Borrar', ['class' => 'btn btn-danger']) !!}
                                            {!! Form::close() !!}
                                            @endcan
                                        </td></tr>{{-- y las tr son para las filas --}}
                                @endforeach
                                </tbody>
                            </table> 
                            <div class="pagination justify-content-end">
                            {!! $calificaciones->links() !!}
                          </div>  
                          <div class="mt-3">
                          @if (Auth::user()->hasRole('Alumno'))
                            <button type="button" class="btn btn-primary" onclick="window.location='{{ route('FormatoAnexo14.index') }}'">Anexo 14</button>
                           @endif
                           
                        </div>
                      </div>
                  </div>
              </div>
          </div>
      </div>
    </section>
    <style>
  
  .form-row {
    margin-bottom: 10px;
}

.form-control {
    font-size: 16px;
    border-radius: 10px;
    border: 2px solid #ccc;
    padding: 10px;
    transition: border-color 0.3s ease;
    font-family: Century Gothic, sans-serif;
}

.form-control:focus {
    outline: none;
    border-color: #6c63ff;
    font-family: Century Gothic, sans-serif;
}

.btn-primary {
    background-color: #6c63ff;
    border: none;
    border-radius: 20px;
    padding: 10px 20px;
    font-size: 16px;
    color: #fff;
    cursor: pointer;
    font-family: Century Gothic, sans-serif;
    transition: background-color 0.3s ease;
}

.btn-primary:hover {
    background-color: #524bd4;
}

/* Flexbox layout for responsive display */
@media (max-width: 991px) {
    .form-row.justify-content-center {
        flex-wrap: wrap;
    }

    .form-row.justify-content-center .col-lg-2 {
        flex-basis: 48%;
    }
}

@media (max-width: 767px) {
    .form-row.justify-content-center .col-lg-2 {
        flex-basis: 100%;
    }
}

</style>
@endsection
{{-- @endcan --}}