<title>Historial compras postres | {{ config('app.name') }}</title>

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
                                    <th>Imagen</th>
                                    <th>Cantidad</th>
                                    <th>Compradores</th>
                                    <th>Fecha</th>
                                </tr>
                            </thead>
                            <tbody>
                            @php
                                $total = 0;
                            @endphp

                            @foreach ($pedidos as $orden)
                            @php
                                $subtotal = $orden->total_pago;
                                $total += $subtotal;
                            @endphp
                                <tr>
                                    <td>{{ $orden->productos }}</td>
                                    <td>
                                        @php
                                            $imagenes = explode(',', $orden->imagen_producto);
                                        @endphp
                                        @foreach($imagenes as $imagen)
                                            <img src="{{ asset('img/' . trim($imagen)) }}" style="max-height: 100px;" width="100" height="100" class="img-responsive"/>
                                        @endforeach
                                    </td>
                                    <td>{{ $orden->cantidad_productos }}<p>Subtotal: ${{ number_format($orden->total_pago, 0, '.', '.') }}</p></td>
                                    <td>{{ $orden->nombre_usuario }}</td>
                                    <td>{{ $orden->created_at }}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <tr>
                            <p>Total: ${{ number_format($total) }}</p>
                        </tr>
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
