
<title>Historial compras bebidas | {{ config('app.name') }}</title>

@extends('layouts.app')

@section('content')
<head>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.0.1/css/bootstrap.min.css" rel="stylesheet">
</head>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-lg-9">
            <div class="card" >
                <div class="card-body" >
                    <h5>Historial de compras</h5>
                    <hr>
                    
                    <div class="table-responsive"> <!-- Agregamos esta clase para hacer la tabla responsive -->
                    <table class="table-futuristic">
                            <thead>
                                <tr>
                                    <th>Producto</th>
                                    <th>Compradores</th>
                                    <th>Fecha</th>
                                </tr>
                            </thead>
                            <tbody>
                            @php
                                $total = 0;
                            @endphp

                            @if($bebidas)
                            @foreach ($bebidas as $bebida)
                            @php
                                $subtotal = $bebida->bebida_precio * $bebida->cantidad_comprada;
                                $total += $subtotal;
                            @endphp
                                <tr>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <img style="border-radius: 20px; width: 50px; height: 50px; object-fit: cover;" src="{{ asset('img/'.$bebida->bebida_imagen) }}" alt="Pizza Image">
                                        </div>
                                        <div class="ms-2">
                                            <h6 class="mb-0 text-sm text-primary">${{ number_format($bebida->bebida_precio, 0, '.', '.') }}</h6>
                                            <h6 class="mb-0 text-sm">{{ $bebida->nombre_bebida }}</h6>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="d-flex">
                                            <div class="d-flex flex-column justify-content-center">
                                                <h6 class="mb-0 text-sm">{{ $bebida->name }}</h6>
                                                <p class="text-xs text-secondary mb-0">{{ $bebida->email }}</p>
                                            </div>
                                        </div>
                                        <p>Cantidad Comprada: {{ $bebida->cantidad_comprada }}</p>
                                        <p>Subtotal: ${{ number_format($bebida->bebida_precio * $bebida->cantidad_comprada, 0, '.', '.') }}</p>
                                    </td>
                                    <td>
                                        {{ $bebida->created_at }}
                                    </td>
                                    <td>
                                    @can('borrar-rol')
                                {!! Form::open(['method' => 'DELETE','route' => ['Pedidos.destroy', $bebida->id],'style'=>'display:inline']) !!}
                                {!! Form::submit('Borrar', ['class' => 'btn btn-danger']) !!}
                                {!! Form::close() !!}
                            @endcan
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                        @else
        <tr>
            <td colspan="3">No hay pedidos disponibles.</td>
        </tr>
    @endif
                        <tr>
                            <p>Total: ${{ number_format($total) }}</p>
                        </tr>
                    </div class="pagination">
                    {!! $bebidas->links() !!}
                </div>
                    </div>
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
