@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Procesar Compra') }}</div>

                <div class="card-body">
                    <form method="POST" >
                        @csrf

                        <div class="form-group row">
                            <label for="nombre_usuario" class="col-md-4 col-form-label text-md-right">{{ __('Nombre') }}</label>

                            <div class="col-md-6">
                                <input id="nombre_usuario" type="text" class="form-control" name="nombre_usuario" required autofocus>
                            </div>
                        </div>

                        <!-- Repite este patrón para los otros campos como email, teléfono, dirección, etc. -->

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-success">Comprar</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    @if(isset($pedidos))
        <div>
            <h2>Pedidos:</h2>
            <ul>
                @foreach ($pedidos as $pizza)
                    <li>{{ $pizza->nombre_producto }}</li>
                @endforeach
            </ul>
        </div>
    @endif
</div>
@endsection



<style>
  /* Agrega estos estilos en tu archivo de estilos CSS */
.table-futuristic {
    border-collapse: separate;
    border-spacing: 0;
    width: 100%;
}

.table-futuristic th,
.table-futuristic td {
    border: 1px solid #ddd;
    padding: 12px;
    text-align: left;
}

.table-futuristic th {
    background-color: #f2f2f2;
}

.table-futuristic tbody tr:hover {
    background-color: #f5f5f5;
}

  </style>
