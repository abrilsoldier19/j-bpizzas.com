@can('crear-rol')
@extends('layouts.app')
@section('content')
<section class="section">
  <div class="section-header">
      <h3 class="page__heading">Crear Calificaciones</h3>
  </div>
      <div class="section-body">
          <div class="row">
              <div class="col-lg-12">
                  <div class="card">
                      <div class="card-body">
                      @if (session('success'))
                         <div class="alert alert-success">
                             {{ session('success') }}
                         </div>
                      @endif
                      @if (session('error'))
                         <div class="alert alert-danger">
                             {{ session('error') }}
                         </div>
                      @endif
                      
                      <form method="POST" action="{{ route('Calificaciones.store') }}">
                      @if ($errors->any())
                          <div class="alert alert-danger">
                              <ul>
                                  @foreach ($errors->all() as $error)
                                      <li>{{ $error }}</li>
                                  @endforeach
                              </ul>
                          </div>
                      @endif
                              @csrf
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
                                  <label for="U1">U1:</label>
                                  <input type="text" class="form-control" id="U1" name="U1">
                              </div>
                              <div class="form-group">
                                  <label for="U2">U2:</label>
                                  <input type="text" class="form-control" id="U2" name="U2">
                              </div>
                              <div class="form-group">
                                  <label for="U3">U3:</label>
                                  <input type="text" class="form-control" id="U3" name="U3">
                              </div>
                              <div class="form-group">
                                  <label for="U4">U4:</label>
                                  <input type="text" class="form-control" id="U4" name="U4">
                              </div>
                              <div class="form-group">
                                  <label for="U5">U5:</label>
                                  <input type="text" class="form-control" id="U5" name="U5">
                              </div>
                              <div class="form-group">
                                  <label for="U6">U6:</label>
                                  <input type="text" class="form-control" id="U6" name="U6">
                              </div>
                              <div class="form-group">
                                  <label for="U7">U7:</label>
                                  <input type="text" class="form-control" id="U7" name="U7">
                              </div>
                              <div class="form-group">
                                  <label for="U8">U8:</label>
                                  <input type="text" class="form-control" id="U8" name="U8">
                              </div>
                              <div class="form-group">
                                  <label for="U9">U9:</label>
                                  <input type="text" class="form-control" id="U9" name="U9">
                              </div>
                              <div class="form-group">
                                  <label for="U10">U10:</label>
                                  <input type="text" class="form-control" id="U10" name="U10">
                              </div>
                              <div class="form-group">
                                  <label for="U11">U11:</label>
                                  <input type="text" class="form-control" id="U11" name="U11">
                              </div>
                              <div class="form-group">
                                  <label for="U12">U12:</label>
                                  <input type="text" class="form-control" id="U12" name="U12">
                              </div>
                              
                              <div class="form-group">
                                  <label for="Semester">Semester:</label>
                                  <select class="form-control" id="Semester" name="Semester">
                                      <option value="1er Semestre">1er Semestre</option>
                                      <option value="2do Semestre">2do Semestre</option>
                                      <option value="3er Semestre">3er Semestre</option>
                                      <option value="4to Semestre">4to Semestre</option>
                                      <option value="5to Semestre">5to Semestre</option>
                                      <option value="6to Semestre">6to Semestre</option>
                                      <option value="7mo Semestre">7mo Semestre</option>
                                      <option value="8vo Semestre">8vo Semestre</option>
                                  </select>
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
                                  <label for="turno">Turno:</label>
                                  <select class="form-control" id="turno" name="turno">
                                      <option value="Matutino">Matutino</option>
                                      <option value="Vespertino">Vespertino</option>
                                  </select>
                              </div>
                              <div class="form-group">
                                  <label for="salon">Salon:</label>
                                  <select class="form-control" id="salon" name="salon">
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
                              <button type="submit" class="btn btn-primary">Guardar</button>
                        </form>             
                      </div>
                  </div>
              </div>
          </div>
      </div>
    </section>
@endsection
@endcan