@extends('layouts.app')
<!-- Add these lines to include jQuery and Bootstrap -->

<head>
<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
    </head>
@section('content')
<table id="carrito" class="table table-hover table-condensed">
    <thead>
        <tr>
            <th style="width:50%">Pizza</th>
            <th style="width:10%">Precio</th>
            <th style="width:8%">Cantidad</th>
            <th style="width:22%" class="text-center">Subtotal</th>
            <th style="width:10%"></th>
        </tr>
    </thead>
    <tbody>
    @php $total = 0 @endphp
    @if(session('carrito'))
        @foreach(session('carrito') as $id => $details)
            @php $subtotal = 0 @endphp
            <tr data-id="{{ $id }}">
                <td data-th="Product">
                    <div class="row">
                        @if(isset($details['nombre_pizza']))
                            <div class="col-sm-6 hidden-xs">
                                <img src="{{ asset('img') }}/{{ $details['imagen_pizza'] }}" style="max-height: 100px;" width="100" height="100" class="img-responsive"/>
                            </div>
                            <div class="col-sm-6 hidden-xs">
                                <h4 class="nomargin">{{ $details['nombre_pizza'] }}</h4>
                            </div>
                        @elseif(isset($details['nombre_bebida']))
                            <div class="col-sm-6 hidden-xs">
                                <img src="{{ asset('img') }}/{{ $details['bebida_imagen'] }}" style="max-height: 100px;" width="100" height="100" class="img-responsive"/>
                            </div>
                            <div class="col-sm-6 hidden-xs">
                                 <h4 class="nomargin">{{ $details['nombre_bebida'] }}</h4>
                            </div>
                        @elseif(isset($details['nombre_postre']))
                            <div class="col-sm-6 hidden-xs">
                                <img src="{{ asset('img') }}/{{ $details['postre_imagen'] }}" style="max-height: 100px;" width="100" height="100" class="img-responsive"/>
                            </div>
                            <div class="col-sm-6 hidden-xs">
                                 <h4 class="nomargin">{{ $details['nombre_postre'] }}</h4>
                            </div>
                        @endif
                    </div>
                </td>
                <td data-th="Price">
                    @if(isset($details['precio_pizza']))
                        ${{ $details['precio_pizza'] }}
                    @elseif(isset($details['bebida_precio']))
                        ${{ $details['bebida_precio'] }}
                    @elseif(isset($details['postre_precio']))
                        ${{ $details['postre_precio'] }}
                    @endif
                </td>
                <td data-th="Quantity">
                    <input type="number" value="{{ $details['quantity'] }}" class="form-control quantity cart_update" min="1" />
                </td>
                <td data-th="Subtotal" class="text-center">
                    @if(isset($details['precio_pizza']))
                        ${{ $details['precio_pizza'] * $details['quantity'] }}
                        @php $subtotal += $details['precio_pizza'] * $details['quantity'] @endphp
                    @elseif(isset($details['bebida_precio']))
                        ${{ $details['bebida_precio'] * $details['quantity'] }}
                        @php $subtotal += $details['bebida_precio'] * $details['quantity'] @endphp
                    @elseif(isset($details['postre_precio']))
                        ${{ $details['postre_precio'] * $details['quantity'] }}
                        @php $subtotal += $details['postre_precio'] * $details['quantity'] @endphp
                    @endif
                </td>
                <td class="actions" data-th="">
                    <button class="btn btn-danger btn-sm delete-product"><i class="fa fa-trash-o"></i> Eliminar</button>
                </td>
            </tr>
            @php $total += $subtotal @endphp
        @endforeach
    @endif
</tbody>

    <tfoot>
    <tr>
            <td colspan="5" class="text-right"><h3><strong>Total ${{ $total }}</strong></h3></td>
        </tr>
        <tr>
            <td colspan="5" class="text-right">
            @can('Usuario-rol')
            
            <form method="POST" action="{{ route('Pizzas.comprar') }}">
    @csrf
    
    <div class="tabbable">
        <div class="form-group">
            <ul class="nav nav-tabs" id="myTab" role="tablist">
                <li class="nav-item">
                    <a class="nav-link active" id="pizza-tab" data-toggle="tab" href="#pizza" role="tab" aria-controls="pizza" aria-selected="true">Pizzas</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="bebida-tab" data-toggle="tab" href="#bebida" role="tab" aria-controls="bebida" aria-selected="false">Bebidas</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="postre-tab" data-toggle="tab" href="#postre" role="tab" aria-controls="postre" aria-selected="false">Postres</a>
                </li>
            </ul>
            <div class="tab-content" id="myTabContent">
                <div class="tab-pane fade show active" id="pizza" role="tabpanel" aria-labelledby="pizza-tab">
                    <div class="row">
                        @foreach($productos as $producto)
                            <div class="col-md-4">
                                <div class="card">
                                    <img src="{{ asset('img') }}/{{ $producto->imagen_pizza }}" class="card-img-top" alt="{{ $producto->nombre_pizza }}" style="max-height: 100px;" width="100" height="100" class="img-responsive">
                                    <div class="card-body">
                                        <h5 class="card-title">{{ $producto->nombre_pizza }}</h5>
                                        <p class="card-text">Precio: ${{ $producto->precio_pizza }}</p>
                                        <input type="checkbox" class="form-check-input"  name="check_pizza[]" value="{{ $producto->id }}">Seleccionar
                                        <input type="text" class="form-control" name="cantidad_comprada_pizza[{{ $producto->id }}]" >
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
                                        <input type="checkbox" class="form-check-input" name="check_bebida[]" value="{{ $bebida->id }}">Seleccionar
                                        <input type="text" class="form-control"  name="cantidad_comprada_bebida[{{ $bebida->id }}]" >
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
                                        <input type="checkbox" class="form-check-input" name="check_postre[]" value="{{ $postre->id }}">Seleccionar
                                        
                                        <input type="text" class="form-control"  name="cantidad_comprada_postre[{{ $postre->id }}]" >
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
        
        <button type="submit" class="btn btn-primary">Comprar</button>
    </div>
</form>


                                    @endcan
                <form action="/session" method="post">
                    <a href="{{ route('Pizzas.index') }}" class="btn btn-primary"><i class="fa fa-angle-left"></i> Continuar comprando</a>
                    <input type="hidden" name="_token" value="{{csrf_token()}}">
                    <button class="btn btn-danger" type="submit" id="checkout-live-button"><i class="fa fa-money"></i> Checkout</button>
                </form>
                
            </td>
        </tr>
    </tfoot>
</table>

@endsection
   
@section('scripts')
<script type="text/javascript">
   
    $(".cart_update").change(function (e) {
        e.preventDefault();
        var ele = $(this);
        $.ajax({
            url: '{{ route('update_cart') }}',
            method: "patch",
            data: {
                _token: '{{ csrf_token() }}', 
                id: ele.parents("tr").attr("data-id"), 
                quantity: ele.parents("tr").find(".quantity").val()
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
    
   
</script>
@endsection
{{-- @endcan --}}