@can('editar-rol')
@extends('layouts.app')

@section('content')
<section class="section">
  <div class="section-header">
      <h3 class="page__heading">Editar Calificaciones</h3>
  </div>
      <div class="section-body">
          <div class="row">
              <div class="col-lg-12">
                  <div class="card">
                      <div class="card-body"> 
                        <form method="POST" action="{{ route('Calificaciones.update', $calificacion->IdCalificacions) }}"> 
                            @csrf
                            @method('PUT')
                            <input type="hidden" name="_method" value="PUT">
                            <div class="form-group">
                                  <label for="Alumno_id">Alumno:</label>
                                  <select class="form-control" id="Alumno_id" name="Alumno_id">
                                      @foreach($alumnos as $alumno)
                                          @if($alumno)
                                              <option value="{{ $alumno->id }}">{{ $alumno->name }}</option>
                                          @endif
                                      @endforeach
                                </select>
                            </div> 
                            <div class="form-group">
                                <label for="Materia_id">Materia:</label>
                                <select class="form-control" id="Materia_id" name="Materia_id">
                                      @foreach($materias as $materia)
                                            <option value="{{ $materia->IdMaterias }}">{{ $materia->NombreMateria }}</option>
                                      @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="U1">U1</label>
                                <input type="text" class="form-control" id="U1" name="U1" value="{{ $calificacion->U1 }}" step="0.01">
                            </div> 
                            <div class="form-group">
                                <label for="U2">U2</label>
                                <input type="text" class="form-control" id="U2" name="U2" value="{{ $calificacion->U2 }}" step="0.01">
                            </div>
                            <div class="form-group">
                                <label for="U3">U3</label>
                                <input type="text" class="form-control" id="U3" name="U3" value="{{ $calificacion->U3 }}" step="0.01">
                            </div>
                            <div class="form-group">
                                <label for="U4">U4</label>
                                <input type="text" class="form-control" id="U4" name="U4" value="{{ $calificacion->U4 }}" step="0.01">
                            </div>
                            <div class="form-group">
                                <label for="U5">U5</label>
                                <input type="text" class="form-control" id="U5" name="U5" value="{{ $calificacion->U5 }}" step="0.01">
                            </div>
                            <div class="form-group">
                                <label for="U6">U6</label>
                                <input type="text" class="form-control" id="U6" name="U6" value="{{ $calificacion->U6 }}" step="0.01">
                            </div>
                            <div class="form-group">
                                <label for="U7">U7</label>
                                <input type="text" class="form-control" id="U7" name="U7" value="{{ $calificacion->U7 }}" step="0.01">
                            </div>
                            <div class="form-group">
                                <label for="U8">U8</label>
                                <input type="text" class="form-control" id="U8" name="U8" value="{{ $calificacion->U8 }}" step="0.01">
                            </div>
                            <div class="form-group">
                                <label for="U9">U9</label>
                                <input type="text" class="form-control" id="U9" name="U9" value="{{ $calificacion->U9 }}" step="0.01">
                            </div>
                            <div class="form-group">
                                <label for="U10">U10</label>
                                <input type="text" class="form-control" id="U10" name="U10" value="{{ $calificacion->U10 }}" step="0.01">
                            </div>
                            <div class="form-group">
                                <label for="U11">U11</label>
                                <input type="text" class="form-control" id="U11" name="U11" value="{{ $calificacion->U11 }}" step="0.01">
                            </div>
                            <div class="form-group">
                                <label for="U12">U12</label>
                                <input type="text" class="form-control" id="U12" name="U12" value="{{ $calificacion->U12 }}" step="0.01">
                            </div>
                            
                            <div class="form-group">
                                <label for="Semester">Semestre:</label>
                                <select class="form-control @error('Semester') is-invalid @enderror" id="Semester" name="Semester">
                                    <option value="1er Semestre" {{ $calificacion->Semester == '1er Semestre' ? 'selected' : '' }}>1er Semestre</option>
                                    <option value="2do Semestre" {{ $calificacion->Semester == '2do Semestre' ? 'selected' : '' }}>2do Semestre</option>
                                    <option value="3er Semestre" {{ $calificacion->Semester == '3er Semestre' ? 'selected' : '' }}>3er Semestre</option>
                                    <option value="4er Semestre" {{ $calificacion->Semester == '4er Semestre' ? 'selected' : '' }}>4er Semestre</option>
                                    <option value="5er Semestre" {{ $calificacion->Semester == '5er Semestre' ? 'selected' : '' }}>5er Semestre</option>
                                    <option value="6er Semestre" {{ $calificacion->Semester == '6er Semestre' ? 'selected' : '' }}>6er Semestre</option>
                                    <option value="7er Semestre" {{ $calificacion->Semester == '7er Semestre' ? 'selected' : '' }}>7er Semestre</option>
                                    <option value="8er Semestre" {{ $calificacion->Semester == '8er Semestre' ? 'selected' : '' }}>8er Semestre</option>
                                </select>
                                @error('Semester')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group">
                                  <label for="Maestro">Maestro:</label>
                                    <select class="form-control" id="Maestro" name="Maestro">
                                        @foreach($maestros as $maestro)
                                              <option value="{{ $maestro->NombreMaestro }}">{{ $maestro->NombreMaestro }}</option>
                                        @endforeach
                                    </select>
                              </div>
                            <div class="form-group">
                                <label for="Añosemestre">Año semestre:</label>
                                <select class="form-control" id="Añosemestre" name="Añosemestre">
                                        @foreach($añosemestres as $añosemestre)
                                              <option value="{{ $añosemestre->Año }}">{{ $añosemestre->Año }}</option>
                                        @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                  <label for="Carrera_id">Carrera:</label>
                                  <select class="form-control" id="Carrera_id" name="Carrera_id">
                                     @foreach($carreras as $carrera)
                                              <option value="{{ $carrera->IdCarreras }}">{{ $carrera->NombreCarrera }}</option>
                                    @endforeach
                                    </select>
                              </div>
                            <div class="form-group">
                                <label for="turno">Horario:</label>
                                <select class="form-control @error('turno') is-invalid @enderror" id="turno" name="turno">
                                    <option value="Matutino" {{ $calificacion->turno == 'Matutino' ? 'selected' : '' }}>Matutino</option>
                                    <option value="Vespertino" {{ $calificacion->turno == 'Vespertino' ? 'selected' : '' }}>Vespertino</option>
                                    <!-- Agrega más opciones de horarios aquí -->
                                </select>
                                @error('turno')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="salon">Salon:</label>
                                <select class="form-control @error('salon') is-invalid @enderror" id="salon" name="salon">
                                    <option value="Salon A" {{ $calificacion->salon == 'Salon A' ? 'selected' : '' }}>Salon A</option>
                                    <option value="Salon B" {{ $calificacion->salon == 'Salon B' ? 'selected' : '' }}>Salon B</option>
                                    <option value="Salon C" {{ $calificacion->salon == 'Salon C' ? 'selected' : '' }}>Salon C</option>
                                    <option value="Salon D" {{ $calificacion->salon == 'Salon D' ? 'selected' : '' }}>Salon D</option>
                                    <option value="Salon E" {{ $calificacion->salon == 'Salon E' ? 'selected' : '' }}>Salon E</option>
                                    <option value="Salon F" {{ $calificacion->salon == 'Salon F' ? 'selected' : '' }}>Salon F</option>
                                    <option value="Salon G" {{ $calificacion->salon == 'Salon G' ? 'selected' : '' }}>Salon G</option>
                                    <option value="Salon H" {{ $calificacion->salon == 'Salon H' ? 'selected' : '' }}>Salon H</option>
                                    <!-- Agrega más opciones de salones aquí -->
                                </select>
                                @error('salon')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <button type="submit" class="btn btn-primary">Actualizar</button>
                        </form>         
                      </div>
                  </div>
              </div>
          </div>
      </div>
    </section>
@endsection
@endcan