<title>Productos | {{ config('app.name') }}</title>

@extends('layouts.app')
<!-- Add these lines to include jQuery and Bootstrap -->

<head>
<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
    </head>
@section('content')

<div class="section-header" style="display: flex; justify-content: center; align-items: center; background-color: black;">
        <h3 style="font-weight: bold; font-size: 40px; font-family: Century Gothic, sans-serif; color:#FFA500;">Productos</h3>
    </div>
    

    <div class="card-body">
       <h4 align="center" style="font-family: Consolas, sans-serif;"> Bienvenido  {{ auth()->user()->name }} {{ auth()->user()->email }} </h4>
    </div>
            @can('Usuario-rol')
            
            <form method="POST" action="{{ route('Productos.agregarCarrito') }}">
    @csrf
    
    <div class="tabbable">
        <div class="form-group">
            <ul class="nav nav-tabs custom-tabs" id="myTab" role="tablist">
                <li class="nav-item">
                    <a class="nav-link active" id="pizza-tab" data-toggle="tab" href="#pizza" role="tab" aria-controls="pizza" aria-selected="true">Pizzas</a>
                </li>
                <li class="nav-item">
                <a class="nav-link custom-nav-link" id="bebida-tab" data-toggle="tab" href="#bebida" role="tab" aria-controls="bebida" aria-selected="false">Bebidas</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="postre-tab" data-toggle="tab" href="#postre" role="tab" aria-controls="postre" aria-selected="false">Postres</a>
                </li>
            </ul>
            <div class="tab-content" id="myTabContent">
                <div class="tab-pane fade show active" id="pizza" role="tabpanel" aria-labelledby="pizza-tab">
                    <div class="row">
                        @foreach($pizzas as $producto)
                            <div class="col-md-4">
                                <div class="card">
                                    <img src="{{ asset('img') }}/{{ $producto->imagen_pizza }}" class="card-img-top" alt="{{ $producto->nombre_pizza }}" style="max-height: 200px; object-fit: cover;" width="100" height="100" class="img-responsive">
                                    <div class="card-body">
                                        <h5 class="card-title">{{ $producto->nombre_pizza }}</h5>
                                        <p class="card-text">Precio: ${{ $producto->precio_pizza }}</p>
                                        @if (Auth::user()->hasRole('Usuario') )
                                        <input type="checkbox" class="form-check-input"  name="check_pizza[]" value="{{ $producto->id }}">Seleccionar
                                        <input type="text" class="form-control" name="cantidad_comprada_pizza[{{ $producto->id }}]" >
                                        @endif
                                        @can('Administrador-rol')
                                        <a href="{{ route('Pizzas.edit', ['id' => $producto->id]) }}" data-mdb-ripple-init class="btn btn-secondary btn-rounded" >Editar</a>
                                        @endcan
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
                
                <div class="tab-pane fade" id="bebida" role="tabpanel" aria-labelledby="bebida-tab">
                    <div class="row">
                    

                        @foreach($bebidas as $bebida)
                            <div class="col-md-4">
                                <div class="card">
                                    <img src="{{ asset('img') }}/{{ $bebida->bebida_imagen }}" class="card-img-top" alt="{{ $bebida->nombre_bebida }}" style="max-height: 200px; object-fit: cover;" class="img-responsive">
                                    <div class="card-body">
                                        <h5 class="card-title">{{ $bebida->nombre_bebida }}</h5>
                                        <p class="card-text">Precio: ${{ $bebida->bebida_precio }}</p>
                                        @if (Auth::user()->hasRole('Usuario') )
                                        <input type="checkbox" class="form-check-input" name="check_bebida[]" value="{{ $bebida->id }}">Seleccionar
                                        <input type="text" class="form-control"  name="cantidad_comprada_bebida[{{ $bebida->id }}]" >
                                        @endif
                                        @can('Administrador-rol')
                                        <a href="{{ route('Bebidas.edit', ['id' => $bebida->id]) }}" class="btn btn-secondary btn-rounded">Editar</a>
                                        @endcan
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
                <div class="tab-pane fade" id="postre" role="tabpanel" aria-labelledby="postre-tab">
                    <div class="row">
                        @foreach($postres as $postre)
                            <div class="col-md-4">
                                <div class="card">
                                    <img src="{{ asset('img') }}/{{ $postre->postre_imagen}}" class="card-img-top" alt="{{ $postre->nombre_postre }}" style="max-height: 200px; object-fit: cover;"class="img-responsive">
                                    <div class="card-body">
                                        <h5 class="card-title">{{ $postre->nombre_postre }}</h5>
                                        <p class="card-text">Precio: ${{ $postre->postre_precio }}</p>
                                        @if (Auth::user()->hasRole('Usuario') )
                                        <input type="checkbox" class="form-check-input" name="check_postre[]" value="{{ $postre->id }}">Seleccionar
                                        
                                        <input type="text" class="form-control"  name="cantidad_comprada_postre[{{ $postre->id }}]" >
                                        @endif
                                        @can('Administrador-rol')
                                        <a href="{{ route('Postres.edit', ['id' => $postre->id]) }}" class="btn btn-secondary btn-rounded">Editar</a>
                                        @endcan
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
        @if (Auth::user()->hasRole('Usuario') )
        <button type="submit" class="btn btn-primary">Agregar al carrito</button>
        @endif
        
    </div>
</form>


                                    @endcan
                
            </td>
        </tr>
    </tfoot>
</table>

@endsection

<style>
.custom-tabs .nav-link {
    color: #333; /* Color del texto */
    font-weight: bold;
    color:black !important;
    background-color: #f8f9fa; /* Color de fondo */
    border-color: #dee2e6; /* Color del borde */
}

.custom-tabs .nav-link.active {
    color:#FFA500 !important;
    font-weight: bold;
    background-color: black!important; /* Color de fondo activo */
    border-color: #007bff; /* Color del borde activo */
}



  </style>
   
@section('scripts')
<script type="text/javascript">
   
   $(document).on('change', '.update-cart', function (e) {
    e.preventDefault();
    var ele = $(this);
    $.ajax({
        url: '{{ url('update-cart') }}',
        method: "patch",
        data: {
            _token: '{{ csrf_token() }}',
            id: ele.attr("data-id"),
            cantidad_producto: ele.val() // Use .val() to get the input value
        },
        success: function (response) {
            window.location.reload();
        }
    });
});

   
    $(".delete-product").click(function (e) {
        e.preventDefault();
   
        var ele = $(this);
   
        if(confirm("Do you really want to delete?")) {
            $.ajax({
                url: '{{ route('delete.cart.product') }}',
                method: "DELETE",
                data: {
                    _token: '{{ csrf_token() }}', 
                    id: ele.parents("tr").attr("data-id")
                },
                success: function (response) {
                    window.location.reload();
                }
            });
        }
    });
    
    import { Ripple, initMDB } from "mdb-ui-kit";

initMDB({ Ripple });
</script>
@endsection
{{-- @endcan --}}