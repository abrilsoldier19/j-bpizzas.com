@can('crear-rol')

@extends('layouts.app')

@section('content')
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
    
</head>
<section class="section">
  <div class="section-header">
      <h3 class="page__heading">Actualizar datos para descargar formato anexo 14</h3>
      <div class="card-body">
        <h4>Bienvenido . {{ auth()->user()->nombre }} {{ auth()->user()->email }} </h4>
     </div>
  </div>
  
  <div>
    <p style="color: black; text-align: center; font-family: Century Gothic, sans-serif; font-size: 17px; text-align: justify; font-weight: bold;">
    Querido usuario/a, ingrese sus datos y eliga el producto:
    </p>
    <p style="color: #0000B0; text-align: center; font-family: Century Gothic, sans-serif; font-size: 17px; text-align: justify; font-weight: bold;">
      Nombre_Apellido_Matricula.pdf
    </p>
    <form method="POST" action="{{ route('Archivos.update', $archivos->id) }}"> 
        @csrf
        @method('PUT')
        <input type="hidden" name="_method" value="PUT">
         <label>Nombre usuario</label></br>
         <select class="form-control" id="id_usuario" name="id_usuario">
            @foreach($usuarios as $usuario)
                @if($usuario)
                    <option value="{{ $usuario->id }}">{{ $usuario->name }}</option>
                @endif
            @endforeach
        </select>
        <input type="text" name="name" id="name" class="form-control"></br> 
        <input type="file" name="file">
        
        <button type="submit" class="btn btn-primary">Actualizar</button>
     </form> 
    </div>   
</section>
@endsection
@endcan
