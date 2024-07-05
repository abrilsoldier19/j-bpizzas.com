@extends('layouts.app')

@section('content')
<section class="section">
<head>
    <title>Carrito</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js"></script>
   
    
</head>
<body>
<div class="container">
    <div class="row">
        <div class="col-lg-12 col-sm-12 col-12">
            <div class="dropdown">
                <button type="button" class="btn btn-primary" data-toggle="dropdown">
                    <i class="fa fa-shopping-cart" aria-hidden="true"></i> Carrito de compras <span class="badge badge-pill badge-danger">{{ count((array) session('carrito')) }}</span>
                </button>
 
                <div class="dropdown-menu">
                    <div class="row total-header-section">
                    @php $total = 0 @endphp
                        @foreach((array) session('carrito') as $id => $details)
                            @php $total += $details['bebida_precio	'] * $details['quantity'] @endphp
                        @endforeach
                        <div class="col-lg-12 col-sm-12 col-12 total-section text-right">
                            <p>Total: <span class="text-info">$ {{ $total }}</span></p>
                        </div>
                    </div>
                    @if(session('carrito'))
                        @foreach(session('carrito') as $id => $details)
                            <div class="row cart-detail">
                                <div class="col-lg-4 col-sm-4 col-4 cart-detail-img">
                                    <img src="{{ asset('img') }}/{{ $details['bebida_imagen'] }}" />
                                </div>
                                <div class="col-lg-8 col-sm-8 col-8 cart-detail-product">
                                    <p>{{ $details['nombre_bebida'] }}</p>
                                    <span class="price text-info"> ${{ $details['bebida_precio	'] }}</span> <span class="count"> Cantidad:{{ $details['quantity'] }}</span>
                                </div>
                            </div>
                        @endforeach
                    @endif
                    <div class="row">
                        <div class="col-lg-12 col-sm-12 col-12 text-center checkout">
                            <a href="{{ route('Bebidas.carrito') }}" class="btn btn-primary btn-block">Ver todo</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
   
<br/>
<div class="container">
   
    @if(session('success'))
        <div class="alert alert-success">
          {{ session('success') }}
        </div> 
    @endif
   
    @yield('content')
</div>
   
@yield('scripts')
</body>
</section>
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