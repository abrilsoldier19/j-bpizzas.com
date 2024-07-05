@can('crear-rol')

@extends('layouts.app')

@section('content')
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    
</head>
<section class="section">
    <div class="section-header">
        <h3 class="page__heading">Agregar pedido</h3>
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
        <form action="{{route('Archivos.store')}}" style="font-family: Century Gothic, sans-serif;" method="post" enctype="multipart/form-data">
        @csrf
        <div class="col-sm-12 col-lg-4 mr-auto ml-auto border p-4">
            <div class="form-group">
                <label style="font-family: Century Gothic, sans-serif; font-size: 14px;">Nombre Alumno</label>
                    <select class="form-control " id="id_usuario" name="id_usuario">
                    @foreach($usuarios as $usuario)
                        @if($usuario)
                            <option value="{{ $usuario->id }}">{{ $usuario->name }}</option>
                        @endif
                    @endforeach
                    </select>
                    <div class="custom-file container mt-2">
                        <input type="file" name="file" multiple class="custom-file-input form-control" id="customFile">
                        <label class="custom-file-label" for="customFile">Choose file</label>
                    </div>
            </div>
            <div class="form-group">
                <button class="upload-label"><i class="fa fa-solid fa-upload fa-beat-fade"></i> Guardar</button>
            </div>
        </div>
        </form>
    </div>
</section>
@section('scripts')
      <script>
                                                function updateFileName() {
  const input = document.getElementById('file');
  const fileNameSpan = document.getElementById('file-name');
  
  if (input.files.length > 0) {
    fileNameSpan.textContent = input.files[0].name;
  } else {
    fileNameSpan.textContent = '';
  }
}
$(document).ready(function() {
  $('input[type="file"]').on("change", function() {
    let filenames = [];
    let files = this.files;
    if (files.length > 1) {
      filenames.push("Total Files (" + files.length + ")");
    } else {
      for (let i in files) {
        if (files.hasOwnProperty(i)) {
          filenames.push(files[i].name);
        }
      }
    }
    $(this)
      .next(".custom-file-label")
      .html(filenames.join(","));
  });
});



                                            </script>
                                            @endsection
<style>
 .upload-container {
  position: relative;
  overflow: hidden;
  display: inline-block;
}

.upload-label {
  display: inline-block;
  border-radius: 5px;
  transition: background-color 0.3s ease;
  background-color: MediumSlateBlue;
    border: none;
    border-radius: 20px;
    padding: 10px 20px;
    font-size: 16px;
    color: #fff;
    cursor: pointer;
    font-family: Century Gothic, sans-serif;
    transition: background-color 0.3s ease;
}

.upload-label:hover {
  background-color: black;
}

.upload-label i {
  margin-right: 5px;
}

#file {
  position: absolute;
  left: 0;
  top: 0;
  opacity: 0;
  width: 100%;
  height: 100%;
  cursor: pointer;
}


  </style>
@endsection
@endcan
