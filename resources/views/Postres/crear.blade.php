<title>Crear Postres | {{ config('app.name') }}</title>
@can('crear-rol')
@extends('layouts.app')
@section('content')
<section class="section">
    <div class="section-header text-center d-flex align-items-center justify-content-center " style="background-color: black; color: white; ">
        <h3 class="page__heading">Agregar postres</h3>
    </div>
    <div class="card-body">
            <h4>Bienvenido . {{ auth()->user()->name }} {{ auth()->user()->email }} </h4>
        </div>
  
    <div>
    <form action="{{route('Postres.store')}}" style="font-family: Century Gothic, sans-serif;" method="post" enctype="multipart/form-data">

        @csrf
        <div class="col-sm-12 col-lg-4 mr-auto ml-auto border p-4">
            <div class="form-group">
               
                <div class="custom-file container mt-3">
                    <label style="font-family: Century Gothic, sans-serif; font-size: 14px;">Nombre Postre</label>
                    <input type="text" class="form-control" id="nombre_postre" name="nombre_postre">
                </div>
                <div class="custom-file container mt-5">
                    <label style="font-family: Century Gothic, sans-serif; font-size: 14px;">Precio postre</label>
                    <input type="text" class="form-control" id="postre_precio" name="postre_precio"><br>
                </div>
                
                <div class="custom-file container mt-5">
                    <input type="file" name="file" multiple class="custom-file-input form-control" id="file" accept="image/*">
                    <label class="custom-file-label" for="customFile">Choose file</label><br>
                </div><br>
                <div class="custom-file container mt-2 text-center align-items-center justify-content-center">
                    <img id="imagenseleccionada" style="max-height: 100px;">
                </div>
            </div>
            <div class="form-group"><br>
            <button type="submit" class="upload-label"><i class="fa fa-solid fa-upload fa-beat-fade"></i> Guardar</button>
            </div>
        </div>
        </form>
    </div>
</section>
@section('scripts')
    <script>
    $(document).ready(function (e)
    {
        $('#file').change(function()
        {
            let reader = new FileReader();
            reader.onload = (e) =>
            {
                $('#imagenseleccionada').attr('src', e.target.result);
            }
            reader.readAsDataURL(this.files[0]);
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