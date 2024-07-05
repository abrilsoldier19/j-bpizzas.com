@extends('layouts.app')
 
@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
    <head>
        
        <link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.0.1/css/bootstrap.min.css" rel="stylesheet">
        </head>
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>My postre</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><button class="btn btn-dark" onclick="window.location.href='{{ route('Pizzas.index') }}'">Home</button></li>
              <li class="breadcrumb-item active" style="color: white;"><button class="btn btn-dark" onclick="window.location.href='{{ route('Postres.mi') }}'">Mis postres</button></li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>
 
    <!-- Main content -->
    <section class="content">
  <div class="container-fluid">
    <div class="row">
      @if($postres->count() > 0)
        @foreach($postres as $postre)
          <div class="col-xl-3 col-sm-6 mb-4">
            <div class="card">
              <div class="card-header text-center">
              <img src="{{ asset('img/'.$postre->postre_imagen) }}" alt="Pizza Image" class="card-img-top" style="max-height: 200px; object-fit: cover;">
              </div>
              <div class="card-body p-3">
                <div class="row">
                  <div class="col-8">
                    <div class="numbers">
                      <p class="text-sm mb-0 text-capitalize font-weight-bold">{{ $postre->nombre_postre }}</p>
                      <h5 class="font-weight-bolder mb-0">
                        ${{ number_format($postre->postre_precio, 0, '.', '.') }}
                      </h5>
                    </div>
                  </div>
                  <div class="col-4 text-end">
                    @if($postre->vendido)
                      <span class="btn bg-danger">Vendido</span>
                    @else
                    <span class="btn bg-succes">Activo</span>
                    @endif
                  </div>
                </div>
              </div>
            </div>
          </div>
        @endforeach
        @else
        <div class="col-12">
          <div class="card"  style="background-color: black; color: white; border-radius: 20px;">
            <div class="card-body text-center p-3" >
              <h4>You don't have a postre yet</h4>
              <a href="{{ route('Postres.create') }}" class="btn bg-gradient-dark">Agregar postre</a>
            </div>
          </div>
        </div>
      @endif
    </div>
    
  </div>
    </section>
    <!-- /.content -->
@endsection