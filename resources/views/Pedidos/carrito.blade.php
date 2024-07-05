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
    @if($carritoItems)
        @foreach($carritoItems as $producto)
            @php 
                $subtotal = $producto->precio_producto * $producto->cantidad_producto; 
                $total += $subtotal;
            @endphp
            <tr data-id="{{ $producto->id }}">
                <td data-th="Producto">
                    <div class="row">
                        <div class="col-sm-6 hidden-xs">
                            <img src="{{ asset('img') }}/{{ $producto->imagen_producto }}" style="max-height: 100px;" width="100" height="100" class="img-responsive"/>
                        </div>
                        <div class="col-sm-6 hidden-xs">
                            <h4 class="nomargin">{{ $producto->nombre_producto }}</h4>
                        </div>
                    </div>
                </td>
                <td data-th="Precio">${{ $producto->precio_producto }}</td>
                <td data-th="Cantidad">
                <input type="number" data-id="{{ $producto->id }}" value="{{ $producto->cantidad_producto }}" class="form-control cantidad_producto update-cart" />
                </td>
                <td data-th="Subtotal" class="text-center">${{ $subtotal }}</td>
                
                <td class="actions" data-th="">
                @can('borrar-rol')
    {!! Form::open(['method' => 'DELETE', 'route' => ['Pedidos.deleteFromCart', $producto->id], 'style' => 'display:inline']) !!}
        {!! Form::button('<i class="fa fa-trash-o"></i> Borrar', ['type' => 'submit', 'class' => 'btn btn-danger']) !!}
    {!! Form::close() !!}
@endcan
                </td>
            </tr>
        @endforeach
    @endif
</tbody>
<tr>

</tr>
    <tfoot>
    <tr><td class="text-left">
    @if($carritoItems->isNotEmpty())
    <a href="{{ route('Pedidos.checkout', ['productos' => $carritoItems]) }}" class="btn btn-primary btn-block">Checkout</a>
@endif

</td>
            <td colspan="5" class="text-right"><h3><strong>Total ${{ $total }}</strong></h3></td>
            
        </tr>
        
        <tr>
            <td colspan="5" class="text-right">
            @can('Usuario-rol')
                                    @endcan
                <form action="/session" method="post">
                    <a href="{{ route('home.index') }}" class="btn btn-primary"><i class="fa fa-angle-left"></i> Continuar comprando</a>
                    
                </form>
                
            </td>
        </tr>
    </tfoot>
</table>

@endsection
   
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
    
   
</script>
@endsection
{{-- @endcan --}}