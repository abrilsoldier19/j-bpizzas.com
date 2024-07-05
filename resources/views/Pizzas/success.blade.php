
@extends('layouts.app')

@section('content')

    <head>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/jquery@4.19.1/dist/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.19.1/dist/js/bootstrap.bundle.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/mdbootstrap@4.19.1/dist/css/mdb.min.css" rel="stylesheet">
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css">
    </head>
    
    <div class="section-header" style="display: flex; justify-content: center; align-items: center; background-color: black;">
        <h3 style="font-weight: bold; font-size: 40px; font-family: Century Gothic, sans-serif; color:#FFA500;">J&B PIZZAGO</h3>
    </div>
    
    <body>
    <div class="card-body">
       <h4 align="center" style="font-family: Consolas, sans-serif;"> Bienvenido  {{ auth()->user()->name }} {{ auth()->user()->email }} </h4>
    </div>
    <div class="d-flex justify-content-center align-items-center" style="background-color: #CC7B04;min-height: 50vh; margin-top: 5vh; margin-bottom: 5vh;">
    <div class="card" style="background-color: black; width: 900px;">
    <div class="card-header bg-danger text-white">
        Confirmación de compra
    </div>
    <div class="card-body" style="background-color: black;">
        <p class="lead" style="font-size: 20px; font-family: Century Gothic, sans-serif; color:white;">Gracias por tu compra. Has completado tu pago. El vendedor se pondrá en contacto contigo.</p>
        <a href="{{ route('Pizzas.index') }}" class="btn btn-primary"><i class="fa fa-angle-left"></i> Continuar comprando</a>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th style="width: 30%;">Pizza</th>
                    <th style="width: 20%;">Precio</th>
                    <th style="width: 10%;">Cantidad</th>
                    <th style="width: 20%;">Subtotal</th>
                </tr>
            </thead>
            <tbody>
                @php $total = 0 @endphp
                @if(session('carrito'))
                    @foreach(session('carrito') as $id => $details)
                        @php $total += $details['precio_pizza'] * $details['quantity'] @endphp
                        <tr data-id="{{ $id }}">
                            <td data-th="Product">
                                <div class="row">
                                    <div class="col-sm-6">
                                        <img src="{{ asset('img') }}/{{ $details['imagen_pizza'] }}" style="max-height: 100px;" width="50" height="50" class="img-responsive" />
                                    </div>
                                    <div class="col-sm-6">
                                        <p class="nomargin">{{ $details['nombre_pizza'] }}</p>
                                    </div>
                                </div>
                            </td>
                            <td data-th="Precio">${{ $details['precio_pizza'] }}</td>
                            <td data-th="Cantidad">{{ $details['quantity'] }}</td>
                            <td data-th="Subtotal" class="text-center">${{ $details['precio_pizza'] * $details['quantity'] }}</td>
                        </tr>
                    @endforeach
                @endif
            </tbody>
            <tfoot>
                <tr>
                    <td colspan="4" class="text-right"><h3><strong>Total ${{ $total }}</strong></h3></td>
                </tr>
            </tfoot>
        </table>
    </div>
</div>

</div>

</div>

        
    
    @yield('content')
</div>
</body>
    <style>
  
  .form-row {
    margin-bottom: 10px;
}

.form-control {
    font-size: 16px;
    border-radius: 10px;
    border: 2px solid #ccc;
    padding: 10px;
    transition: border-color 0.3s ease;
    font-family: Century Gothic, sans-serif;
}

.form-control:focus {
    outline: none;
    border-color: #6c63ff;
    font-family: Century Gothic, sans-serif;
}

.btn-pizza {
    background-color: #623F00;
    border: none;
    border-radius: 20px;
    padding: 10px 20px;
    font-size: 16px;
    color: #fff;
    cursor: pointer;
    font-family: Century Gothic, sans-serif;
    transition: background-color 0.3s ease;
}

.btn-pizza:hover {
    background-color: black;
}

.container {
            margin-top: 50px;
        }

.gradient-button {
    margin: 6px;
    font-family: "Arial Black", Gadget, sans-serif;
    font-size: 16px;
    padding: 10px;
    border: none;
    text-align: center;
    text-transform: uppercase;
    transition: 0.5s;
    background-size: 200% auto;
    color: #FFF;
    box-shadow: 0 0 20px #eee;
    width: 120px;
    box-shadow: 0 1px 3px rgba(0,0,0,0.12), 0 1px 2px rgba(0,0,0,0.24);
    transition: all 0.3s cubic-bezier(.25,.8,.25,1);
    cursor: pointer;
    display: inline-block;
    border-radius: 25px;
}
.gradient-button:hover{
    box-shadow: 0 10px 20px rgba(0,0,0,0.19), 0 6px 6px rgba(0,0,0,0.23);
    margin: 8px 10px 12px;
}
.btn-gradient {
    background-image: linear-gradient(to right, #FF3701 0%, black 51%, #FF3701 100%)
}
.btn-gradient:hover { 
    background-position: right center; 
}

/* Flexbox layout for responsive display */
@media (max-width: 991px) {
    .form-row.justify-content-center {
        flex-wrap: wrap;
    }

    .form-row.justify-content-center .col-lg-2 {
        flex-basis: 48%;
    }
}

@media (max-width: 767px) {
    .form-row.justify-content-center .col-lg-2 {
        flex-basis: 100%;
    }
}
.card {
        /* Add some styling to the cards */
        border: 1px solid #ccc;
        border-radius: 10px;
        margin: 10px;
        padding: 10px;
    }

    clearfix {
        clear: both;
    }

    /* Ensure three cards per row */
    .row {
        display: flex;
        flex-wrap: wrap;
        margin: -15px; /* Adjust margin to compensate for column spacing */
    }

    .col-lg-4 {
        flex: 0 0 33.3333%;
        max-width: 33.3333%;
        padding: 15px; /* Adjust padding to create space between cards */
    }

    @media (max-width: 991px) {
        .col-lg-4 {
            flex-basis: 48%;
        }
    }

    @media (max-width: 767px) {
        .col-lg-4 {
            flex-basis: 100%;
        }
    }

</style>
@endsection
{{-- @endcan --}}
