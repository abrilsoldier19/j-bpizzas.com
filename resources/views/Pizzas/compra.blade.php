

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

                            @foreach ($pizzas as $pizza)
                            @php
                                $subtotal = $pizza->precio_pizza * $pizza->cantidad_comprada;
                                $total += $subtotal;
                            @endphp
                                <tr>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <img style="border-radius: 20px; width: 50px; height: 50px; object-fit: cover;" src="{{ asset('img/'.$pizza->imagen_pizza) }}" alt="Pizza Image">
                                        </div>
                                        <div class="ms-2">
                                            <h6 class="mb-0 text-sm text-primary">${{ number_format($pizza->precio_pizza, 0, '.', '.') }}</h6>
                                            <h6 class="mb-0 text-sm">{{ $pizza->nombre_pizza }}</h6>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="d-flex">
                                            <div class="d-flex flex-column justify-content-center">
                                                <h6 class="mb-0 text-sm">{{ $pizza->name }}</h6>
                                                <p class="text-xs text-secondary mb-0">{{ $pizza->email }}</p>
                                            </div>
                                        </div>
                                        <p>Cantidad Comprada: {{ $pizza->cantidad_comprada }}</p>
                                        <p>Subtotal: ${{ number_format($pizza->precio_pizza * $pizza->cantidad_comprada, 0, '.', '.') }}</p>
                                    </td>
                                    <td>
                                        {{ $pizza->created_at }}
                                    </td>
                                    <td>
                                    @can('borrar-rol')
                                {!! Form::open(['method' => 'DELETE','route' => ['Pedidos.destroy', $pizza->id],'style'=>'display:inline']) !!}
                                {!! Form::submit('Borrar', ['class' => 'btn btn-danger']) !!}
                                {!! Form::close() !!}
                            @endcan
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                        <tr>
                            <p>Total: ${{ number_format($total) }}</p>
                        </tr>
                        </div class="pagination">
                    {!! $pizzas->links() !!}
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
