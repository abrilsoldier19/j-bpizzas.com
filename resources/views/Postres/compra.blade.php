@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-6">
                <div class="card"  style="width:750px;">
                    <div class="card-body " style="width:750px;">
                        <h5>Historial de compras</h5>
                        <hr>
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

                            @foreach ($postres as $postre)
                            @php
                                $subtotal = $postre->postre_precio * $postre->cantidad_comprada;
                                $total += $subtotal;
                            @endphp
                                <tr>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <img style="border-radius: 20px; width: 50px; height: 50px; object-fit: cover;" src="{{ asset('img/'.$postre->postre_imagen) }}" alt="postre Image">
                                        </div>
                                        <div class="ms-2">
                                            <h6 class="mb-0 text-sm text-primary">${{ number_format($postre->postre_precio, 0, '.', '.') }}</h6>
                                            <h6 class="mb-0 text-sm">{{ $postre->nombre_postre }}</h6>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="d-flex">
                                            <div class="d-flex flex-column justify-content-center">
                                                <h6 class="mb-0 text-sm">{{ $postre->name }}</h6>
                                                <p class="text-xs text-secondary mb-0">{{ $postre->email }}</p>
                                            </div>
                                        </div>
                                        <p>Cantidad Comprada: {{ $postre->cantidad_comprada }}</p>
                                        <p>Subtotal: ${{ number_format($postre->postre_precio * $postre->cantidad_comprada, 0, '.', '.') }}</p>
                                    </td>
                                    <td>
                                        {{ $postre->created_at }}
                                    </td>
                                    <td>
                                    @can('borrar-rol')
                                {!! Form::open(['method' => 'DELETE','route' => ['Postres.destroy', $postre->id],'style'=>'display:inline']) !!}
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
                    {!! $postres->links() !!}
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
