@extends('layouts.app')

@section('content')
<table id="carrito" class="table table-hover table-condensed">
    <thead>
        <tr>
            <th style="width:50%">Bebida</th>
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
            @php $total += $details['bebida_precio'] * $details['quantity'] @endphp
                <tr data-id="{{ $id }}">
                    <td data-th="Product">
                        <div class="row">
                            <div class="col-sm-6 hidden-xs"><img src="{{ asset('img') }}/{{ $details['bebida_imagen'] }}" style="max-height: 100px;" width="100" height="100" class="img-responsive"/></div>
                            <div class="col-sm-9">
                                <h4 class="nomargin">{{ $details['nombre_bebida'] }}</h4>
                            </div>
                        </div>
                    </td>
                    <td data-th="Price">${{ $details['bebida_precio'] }}</td>
                    <td data-th="Quantity">
                        <input type="number" value="{{ $details['quantity'] }}" class="form-control quantity cart_update" min="1" />
                    </td>
                    <td data-th="Subtotal" class="text-center">${{ $details['bebida_precio'] * $details['quantity'] }}</td>
                    <td class="actions" data-th="">
                        <button class="btn btn-danger btn-sm delete-product"><i class="fa fa-trash-o"></i> Eliminar</button>
                    </td>
                </tr>
               
            @endforeach
        @endif
    </tbody>
    <tfoot>
    <tr>
            <td colspan="5" class="text-right"><h3><strong>Total ${{ $total }}</strong></h3></td>
        </tr>
        <tr>
            <td colspan="5" class="text-right">
                <form action="/session" method="post">
                    <a href="{{ route('Bebidas.index') }}" class="btn btn-primary"><i class="fa fa-angle-left"></i> Continuar comprando</a>
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