
@extends('layouts.app')

@section('content') 
<section class="section" >
<head>
<link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.0.1/css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/noUiSlider/14.6.4/nouislider.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/noUiSlider/14.6.4/nouislider.min.js"></script>
    <link href = "css/jquery-ui.css" rel = "stylesheet">

</head>
<div class="card-body">
       <h4 align="center" style="font-family: Consolas, sans-serif;"> Bienvenido  {{ auth()->user()->name }} {{ auth()->user()->email }} </h4>
    </div>
    <div class="form-row justify-content-center">
    <div class="col-lg-2">
        <label class="input-box" for="price_range">
        <label class="text-box" >Precios:</label>
            <div class="min-box">
                $<span id="price_range_label_min">{{ $min_price }}</span>
            </div>
            <div class="max-box">
                 $<span id="price_range_label_max">{{ $max_price }}</span>
            </div>
        </label>

    </div>
</div>


    <form action="{{ route('Postres.index') }}" method="GET">
        <div class="form-row justify-content-center">
        <div class="col-lg-2">
                <select class="form-control custom-select no-print select2" style="font-family: Century Gothic, sans-serif;"  name="postre_precio" id="postre_precio">
                    <option value="">Todos los precios</option>
                    <option value="below_70">Menor a $70</option>
                    <option value="above_70">Mayor o igual a $70</option>
                </select>
            </div>
            <div class="col-lg-2">
                <select class="form-control custom-select no-print select2" style="font-family: Century Gothic, sans-serif;"  name="nombre_postre" id="nombre_postre">
                    <option value="">Postres</option>
                    @foreach ($postres as $postre)
                        <option value="{{ $postre->nombre_postre }}">{{ $postre->nombre_postre }}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="form-row justify-content-center">
            <div class="col-lg-1.5">
                <button type="submit" class="button-pizza btn-block">Buscar</button>
            </div>
        </div>
    </form>
    <div class="form-row justify-content-center">
            <div class="col-lg-1.5">
                <a class="gradient-button btn-block" href="{{route ('Postres.create')}}" role="button" data-bs-toggle="button">
                    <i class=" fa fa-plus-square"></i><span >Agregar Postres</span>
                </a>
            </div>
        </div>
    
    <div class="section-body" id="productos">
        <div class="row">
        @if($postres->count() > 0)
            @foreach ($postres as $postre)
                <div class="col-lg-4 mb-4">
                    <div class="card" >
                    <img src="{{ asset('img/'.$postre->postre_imagen) }}" alt="Pizza Image" class="card-img-top" style="max-height: 200px; object-fit: cover;">
                        <div class="card-body">
                        <h6 class="mb-0 text-sm">{{ optional($postre->vendedor)->name }}</h6>
                            <h5 class="card-title">{{$postre->nombre_postre}}</h5>
                            <p class="card-text" >Precio: ${{ number_format($postre->postre_precio, 0, '.', '.') }}</p>
                            @if (Auth::user()->hasRole('Usuario') )
                                <form action="{{ route('Postres.agregarCarrito', $postre->id) }}" method="post">
                                    @csrf
                                    <div class="form-group">
                                        <label for="quantity">Cantidad:</label>
                                        <input name="quantity" type="number"
                                       class="text-sm sm:text-base px-2 pr-2 rounded-lg border border-gray-400 py-1 focus:outline-none focus:border-blue-400"
                                       style="width: 50px" value="1" min="1" />
                                    </div>
                                    <p class="btn-holder">
                                        <button type="submit"  class="btn btn-success" role="button">Agregar al carrito</button> 
                                    </p>
                                </form>
                            @endif
                            @can('Administrador-rol')
                                <a href="{{ route('Postres.edit', $postre->id) }}" class="btn btn-info">Editar</a>
                            @endcan
                            @if (Auth::user()->hasRole('Usuario') )
                                @if(!$postre->vendido)
                                    <form method="POST" action="{{ route('Postres.comprar', $postre->id) }}">
                                        @csrf
                                        @method('PUT')
                                        <button type="submit" class="btn btn-success">Comprar</button>
                                    </form>
                                @else
                                    <span class="btn bg-danger">Sold</span>
                                @endif
                            @endif
                            @can('Administrador-rol')
                                {!! Form::open(['method' => 'DELETE','route' => ['Postres.destroy', $postre->id],'style'=>'display:inline']) !!}
                                {!! Form::submit('Borrar', ['class' => 'btn btn-danger']) !!}
                                {!! Form::close() !!}
                            @endcan
                        </div>
                    </div>
                </div>

                <!-- Add a clearfix after every third card to start a new row -->
                @if($loop->iteration % 3 == 0)
                    <div class="clearfix"></div>
                @endif
            @endforeach
        @endif
        {!! $postres->links() !!}
        </div>
    </div>
    
</div>

</section>
@endsection
    <style>
   @import url('https://fonts.googleapis.com/css2?family=Poppins&display=swap');
   .form-row {
    margin-bottom: 10px;
}

.button-pizza {
    background-color: #623F00;
    border: none;
    border-radius: 20px;
    padding: 10px 20px;
    font-size: 16px;
    color: #fff;
    cursor: pointer;
    font-family: Century Gothic, sans-serif;
    transition: background-color 0.3s ease;
    text-decoration: none;
}

.button-pizza:hover {
    background-color: black;
    color: white;
    text-decoration: none;
}

.gradient-button {
    background-color: #623F00;
    border: none;
    border-radius: 20px;
    padding: 10px 20px;
    font-size: 16px;
    color: white;
    cursor: pointer;
    font-family: Century Gothic, sans-serif;
    text-align: center;
    transition: 0.5s;
    background-size: 200% auto;
    color: #FFF;
    box-shadow: 0 0 20px #eee;
    box-shadow: 0 1px 3px rgba(0,0,0,0.12), 0 1px 2px rgba(0,0,0,0.24);
    transition: all 0.3s cubic-bezier(.25,.8,.25,1);
    cursor: pointer;
    display: inline-block;
    border-radius: 25px;
    text-decoration: none;
}
.gradient-button:hover{
    background-color: black;
    color: white;
    text-decoration: none;
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

    .select2-container .select2-selection--single {
                                font-family: 'Century Gothic', sans-serif;
                                background-color: lightgray; 
                                color: black;
                                font-size: 14px;
                            }

                            .select2.select2-container .select2-selection .select2-selection__arrow {
                                background: #f8f8f8;
                                border-left: 1px solid #ccc;
                                -webkit-border-radius: 0 3px 3px 0;
                                -moz-border-radius: 0 3px 3px 0;
                                border-radius: 0 3px 3px 0;
                                height: 22px;
                                width: 23px;
                            }

                            .select2.select2-container.select2-container--open .select2-selection.select2-selection--single {
  background: white;
  color: black;
}


                            .select2-container .select2-selection--single:hover {
                                font-family: 'Century Gothic', sans-serif;
                                background-color: white; 
                                color: blue;
                                font-size: 14px;
                            }


                            .select2-container {
                                width: 100% !important; 
                            }

                            .select2-search__field {
                                font-family: Century Gothic, sans-serif; 
                                font-size: 14px;
                            }

                            .select2-results__option {
                                background-color: black; 
                                color: white; 
                                font-family: Century Gothic, sans-serif; 
                                padding: 8px;
                                font-size: 14px;
                            }

                            .select2-results__option:hover {
                                background-color: white; 
                                font-size: 14px;
                            }


                            .centered-select {
                                display: block;
                                margin: 0 auto;
                                text-align: center;
                            }
                            
/* Estilo para los valores de precio */
#minPriceValue,
#maxPriceValue {
    color: black; /* Cambia el color según tu preferencia */
    font-weight: bold;
    font-family: 'Century Gothic', sans-serif;
}


.input-box {
    display: flex;
    justify-content: center;
    margin-top: 10px;
}

.min-box,
.max-box {
    border: 1px solid #ccc;
    border-radius: 5px;
    padding: 5px;
    text-align: center;
    width:70px;
    height:35px;
}

.text-box {
    width: 50%;
    border: 1px solid #ccc;
    border-radius: 5px;
    padding: 5px;
    text-align: center;
    width:70px;
    color: black;
    font-weight: bold;
    font-family: 'Century Gothic', sans-serif;
    margin-right: 5px;
}

.min-box {
    margin-right: 5px;
}

.max-box {
    margin-left: 5px;
}

</style>
{{-- @endcan --}}
<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
<script>
    $(document).ready(function() {
  $(".js-select2").select2({
    closeOnSelect: false
  });
  $(".js-select2-multi").select2({
    closeOnSelect: false
  });
});
    
  </script>