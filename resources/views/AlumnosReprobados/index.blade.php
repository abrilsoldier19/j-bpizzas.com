
@can('crear-rol')

@extends('layouts.app')

@section('content')

<section class="section">
<div class="section-header" style="display: flex; justify-content: center; align-items: center; ">
        <h3 style="font-weight: bold; font-size: 40px; font-family: Century Gothic, sans-serif; color: #012EBF;">Alumnos Reprobados</h3>
    </div>

    <div class="card-body">
       <h4 align="center" style="font-family: Consolas, sans-serif;"> Bienvenido  {{ auth()->user()->name }} {{ auth()->user()->email }} </h4>
    </div>
    <head>
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/css/bootstrap-select.min.css">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/js/bootstrap-select.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/js/i18n/defaults-*.min.js"></script>
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.1.0/css/select2.min.css" />
        <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.1.0/js/select2.min.js"></script>
    </head>
    <form method="GET" action="{{ route('AlumnosReprobados.index') }}">
    <div class="container">
        <div class="form-row justify-content-center">
            <div class="col-lg-2">
                <select class="form-control custom-select no-print select2" style="font-family: Century Gothic, sans-serif;" name="carrera" id="carrera">
                    <option value="">Carreras</option>
                    @foreach ($carreras as $carrera)
                        <option value="{{ $carrera->IdCarreras }}" {{ $filtroCarrera == $carrera->IdCarreras ? 'selected' : '' }}>{{ $carrera->NombreCarrera }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-lg-2">
                <select class="form-control custom-select no-print select2" style="font-family: Century Gothic, sans-serif;" name="Semestre_id">
                    <option value="">Semestres</option>
                    <option value="1er Semestre">1er Semestre</option>
                    <option value="2do Semestre">2do Semestre</option>
                    <option value="3er Semestre">3er Semestre</option>
                    <option value="4to Semestre">4to Semestre</option>
                    <option value="5to Semestre">5to Semestre</option>
                    <option value="6to Semestre">6to Semestre</option>

                    <!--@foreach ($semestres as $semestre)-->
                        <!--<option value="{{ $semestre->IdSemestres }}">{{ $semestre->Semestre}}</option>-->
                    <!--@endforeach-->
                </select>
            </div>
            <div class="col-lg-2">
                <select class="form-control custom-select no-print select2" style="font-family: Century Gothic, sans-serif;" name="turno">
                    <option value="">Turnos</option>
                    <option value="Matutino">Matutino</option>
                    <option value="Vespertino">Vespertino</option>
                 </select>
            </div>
            <div class="col-lg-2">
                <select class="form-control custom-select no-print select2" style="font-family: Century Gothic, sans-serif;" name="salon">
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
        </div>  
        <div class="form-row justify-content-center">
            <div class="col-lg-1.5">
            <button type="submit" class="button-blue">Mostrar</button>
            <button id="btnPrint" style="border-radius: 25px;" value="Print" onclick="printTable()" class="artistic-btn">Imprimir tabla</button>
            </div>
        </div>
    </div>
    </form>
        <div class="section-body">
          <div class="row">
              <div class="col-lg-12">
                  <div class="card">
                      <div class="card-body">
                            <table id="tabla_datos" class="table table-striped mt-2" style="border-collapse: collapse; font-family: Century Gothic, sans-serif; width: 100%; min-width: 700px; max-width: 1000px; margin: 0 auto; ">
                                <tr style="border: 1px solid #000033;  border-collapse: collapse; background-color:#003399"> 
                                     <th style="color:#fff;">Alumno</th> <!--Nombre de columnas -->
                                     <th style="color:#fff;">Materia</th>
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
                                     <th style="color:#fff;">Maestro</th>
                                     <th style="color:#fff;">Semestre</th>
                                     <th style="color:#fff;">Año Semestre</th>
                                     <th style="color:#fff;">Carrera</th>
                                     <th style="color:#fff;">Turno</th>
                                     <th style="color:#fff;">Salon</th>
                                </tr>
                                <tbody>
                                    @foreach ($alumnoReprobados as $alumnoReprobado) {{--foreach a nivel de vista  --}}
                                    
                                    <tr style="border-collapse: collapse; border: 1px solid #BABBC2;">
                                        <td style="border: 1px solid #BABBC2;" >{{ $alumnoReprobado->nombre_alumno }}</td>
                                        <td style="border: 1px solid #BABBC2;" >{{ $alumnoReprobado->nombre_materia }}</td>
                                            <td style="border: 1px solid #BABBC2;" >{{ $alumnoReprobado->U1 }}</td>
                                            <td style="border: 1px solid #BABBC2;" >{{ $alumnoReprobado->U2 }}</td>
                                            <td style="border: 1px solid #BABBC2;" >{{ $alumnoReprobado->U3 }}</td>
                                            <td style="border: 1px solid #BABBC2;" >{{ $alumnoReprobado->U4 }}</td>
                                            <td style="border: 1px solid #BABBC2;" >{{ $alumnoReprobado->U5 }}</td>
                                            <td style="border: 1px solid #BABBC2;" >{{ $alumnoReprobado->U6 }}</td>
                                            <td style="border: 1px solid #BABBC2;" >{{ $alumnoReprobado->U7 }}</td>
                                            <td style="border: 1px solid #BABBC2;" >{{ $alumnoReprobado->U8 }}</td>
                                            <td style="border: 1px solid #BABBC2;" >{{ $alumnoReprobado->U9 }}</td>
                                            <td style="border: 1px solid #BABBC2;" >{{ $alumnoReprobado->U10}}</td>
                                            <td style="border: 1px solid #BABBC2;" >{{ $alumnoReprobado->U11 }}</td>
                                            <td style="border: 1px solid #BABBC2;" >{{ $alumnoReprobado->U12 }}</td>
                                        
                                        <td style="border: 1px solid #BABBC2;" >{{ $alumnoReprobado->Maestro}}</td>
                                        <td style="border: 1px solid #BABBC2;" >{{ $alumnoReprobado->Semester  }}</td>
                                        <td style="border: 1px solid #BABBC2;" >{{ $alumnoReprobado->Añosemestre }}</td>
                                        <td style="border: 1px solid #BABBC2;" >{{ $alumnoReprobado->nombre_carrera }}</td>
                                        <td style="border: 1px solid #BABBC2;" >{{ $alumnoReprobado->turno }}</td>
                                        <td style="border: 1px solid #BABBC2;" >{{ $alumnoReprobado->salon }}</td>
                                        
                                    </tr>{{-- y las tr son para las filas --}}
                                    
                                    @endforeach
                                </tbody>
                            </table> 
                            
                            <script>
                                function printTable()
                                {
                                    var printWindow = window.open('', '', 'height=600,width=800');
    
    printWindow.document.write('<html><head><title>Tabla para imprimir</title>');
    printWindow.document.write('<style type="text/css">');
    printWindow.document.write(document.getElementById("table_style").innerHTML); // Agregar estilos
    printWindow.document.write('</style></head><body>');

    var table = document.getElementById("tabla_datos").outerHTML; // Obtener el HTML de la tabla
    printWindow.document.write(table);

    printWindow.document.write('</body></html>');
    printWindow.document.close();
    printWindow.print();
                                }
                                $(document).ready(function() {
  $(".js-select2").select2({
    closeOnSelect: false
  });
  $(".js-select2-multi").select2({
    closeOnSelect: false
  });
});
                            </script>
                            <style id="table_style">
                            .form-row {
                                margin-bottom: 10px;
                            }

                             .artistic-btn 
                            {
                                font-family: 'Century Gothic', sans-serif;
                                background-color: black;
                                border: none;
                                color: white;
                                font-weight: bold;
                                padding: 10px 20px;
                                cursor: pointer;
                                transition: background-color 0.3s ease;
                            }

                            .artistic-btn:hover 
                            {
                                 background-color: #ABA3A8;
                                 color: black;
                            }
                            
                            
                            
                            .button-blue {
                                background-color: #0087E2;
                                border: none;
                                border-radius: 20px;
                                padding: 10px 20px;
                                font-size: 16px;
                                color: #fff;
                                cursor: pointer;
                                font-family: 'Century Gothic', sans-serif;
                                transition: background-color 0.3s ease;
                            }
                            
                            .button-blue:hover {
                                background-color: #4FB8FF;
                                color: black;
                                font-family: 'Century Gothic', sans-serif;
                            }
                            
                            .select2-container .select2-selection--single {
                                font-family: 'Century Gothic', sans-serif;
                                background-color: lightgray; 
                                color: black;
                                font-size: 14px;
                            }

                            .select2.select2-container .select2-selection .select2-selection__arrow {
                                background: #f8f8f8;
                                border-left: 1px solid #ccc;
                                -webkit-border-radius: 0 3px 3px 0;
                                -moz-border-radius: 0 3px 3px 0;
                                border-radius: 0 3px 3px 0;
                                height: 22px;
                                width: 23px;
                            }

                            .select2.select2-container.select2-container--open .select2-selection.select2-selection--single {
  background: white;
  color: black;
}


                            .select2-container .select2-selection--single:hover {
                                font-family: 'Century Gothic', sans-serif;
                                background-color: white; 
                                color: blue;
                                font-size: 14px;
                            }


                            .select2-container {
                                width: 100% !important; 
                            }

                            .select2-search__field {
                                font-family: Century Gothic, sans-serif; 
                                font-size: 14px;
                            }

                            .select2-results__option {
                                background-color: black; 
                                color: white; 
                                font-family: Century Gothic, sans-serif; 
                                padding: 8px;
                                font-size: 14px;
                            }

                            .select2-results__option:hover {
                                background-color: white; 
                                font-size: 14px;
                            }


                            .centered-select {
                                display: block;
                                margin: 0 auto;
                                text-align: center;
                            }

                            </style>
                            <div class="pagination justify-content-end">
                            {!! $alumnoReprobados->links() !!}
                          </div>  
                          
                      </div>
                  </div>
              </div>
          </div>
      </div>
      <div class="mt-3">
         <button type="button" class="button-blue" onclick="window.location='{{ route('Formatos.index') }}'">Anexo 15 Casos Especiales 2021</button>
         <button type="button" class="button-blue" onclick="window.location='{{ route('FormatoAnexo19.index') }}'">Anexo 19 Reporte semestral</button>
         <button type="button" class="button-blue" onclick="window.location='{{ route('FormatoAnexo19Mensual.index') }}'">Anexo 19 Reporte mensual</button>
         <button type="button" class="button-blue" onclick="window.location='{{ route('Archivos.index') }}'">Reportes alumnos Anexo 14</button>
      </div>
      
    </section>
@endsection
@endcan