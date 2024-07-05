@extends('layouts.app')

@section('content')
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/css/bootstrap.min.css' />
  <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.9.0/css/all.min.css' />
</head>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Procesar Compra') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('Pedidos.procesarCompra') }}">
                        @csrf

                        <div class="form-group row">
                        <div class="jumbotron p-3 mb-2 text-center">
                        
                        <tbody>
                            @php $total = 0; @endphp
                            <thead>
                            <tr>
                            <h6 class="lead"><b>Producto(s) : </b></h6>
@forelse ($pedidos  as $producto)
@php
                                    $subtotal = $producto->precio_producto * $producto->cantidad_producto;
                                    $total += $subtotal;
                                @endphp
    <ul>
        <td><img src="{{ asset('img') }}/{{ $producto->imagen_producto }}" style="max-height: 100px; border-radius: 20px;" width="100" height="100" class="img-responsive"/>
        -{{ $producto->nombre_producto }} - Cantidad: {{ $producto->cantidad_producto }} </td>
        <br>
        <tr>Precio: ${{ $producto->precio_producto }} - Subtotal: ${{ $subtotal }}</tr>
    </ul>
@empty
    <p>No hay productos en el carrito</p>
@endforelse
<tfoot>
                            <tr>
                                <td colspan="3" class="text-right"><strong>Total</strong></td>
                                <td>${{ $total }}</td>
                            </tr>
                        </tfoot>

                               
        </div>
                            <label for="nombre_usuario" class="col-md-4 col-form-label text-md-right">{{ __('Nombre') }}</label>

                            <div class="col-md-6">
                                <input id="nombre_usuario" type="text" class="form-control" name="nombre_usuario" required autofocus>
                            </div>
                            <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('Correo') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="text" class="form-control" name="email" required autofocus>
                            </div>
                            <label for="telefono" class="col-md-4 col-form-label text-md-right">{{ __('Telefono') }}</label>

                            <div class="col-md-6">
                                <input id="telefono" type="text" class="form-control" name="telefono" required autofocus>
                            </div>
                            <label for="direccion" class="col-md-4 col-form-label text-md-right">{{ __('Direccion') }}</label>

                            <div class="col-md-6">
                                <input id="direccion" type="text" class="form-control" name="direccion" required autofocus>
                            </div>
                            <h6 class="text-center lead">Select Payment Mode</h6>
          <div class="form-group">
            <select name="metodo_pago" class="form-control">
              <option value="" selected disabled>-Select Payment Mode-</option>
              <option value="cod">Cash On Delivery</option>
              <option value="netbanking">Net Banking</option>
              <option value="cards">Debit/Credit Card</option>
            </select>
          </div>
          <input type="hidden" name="total_pago" value="{{ $total }}">

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
