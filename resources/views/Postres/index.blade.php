<title>Postres | {{ config('app.name') }}</title>
@extends('layouts.app')

@section('content')
<section class="section" >
<head>
    
    <link href="css/jquery-ui.css" rel="stylesheet">

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
                            
/* Estilo para etiquetas de precio */
#price_range_label_min,
#price_range_label_max {
    color: black; /* Cambia el color según tu preferencia */
    font-weight: bold; 
    font-family: 'Century Gothic', sans-serif;
}

.custom-range::-webkit-slider-thumb2 {
    -webkit-appearance: none;
    appearance: none;
    width: 25px;
    height: 25px;
    border-radius: 50%;
    background-color: blue; /* Cambiar color del thumb */
    cursor: pointer;
    z-index: 2; /* Asegurarse de que esté sobre el thumb original */
}




.custom-range:hover {
  opacity: 1;
}



.input-box {
    display: flex;
    position: relative; /* Asegurarse de que los thumbs estén posicionados correctamente */

}
#priceRangeSlider {
    margin-top: 20px;
}

#priceRangeSlider .noUi-handle {
    width: 30px; /* Adjust handle width */
    height: 30px; /* Adjust handle height */
    border: none; /* Remove handle border */
    background-color: black; /* Make handle transparent */
    border-radius: 50%; /* Make the handle circular */
    box-shadow: 0 0 20px rgba(255, 165, 0, 0.5); /* Add a glowing effect */
}

/* Animation for the handle */
@keyframes glowing {
    0% {
        box-shadow: 0 0 10px rgba(255, 165, 0, 0.5);
    }
    50% {
        box-shadow: 0 0 20px rgba(255, 165, 0, 0.8);
    }
    100% {
        box-shadow: 0 0 10px rgba(255, 165, 0, 0.5);
    }
}

#priceRangeSlider .noUi-handle:hover {
    animation: glowing 1.5s infinite alternate; /* Add glowing effect on hover */
}

/* Styles for the slider connect bar */
#priceRangeSlider .noUi-connect {
    background: black;
    
}


.input-box {
    display: flex;
    justify-content: space-between;
    margin-top: 10px;
}

.min-box,
.max-box {
    width: 50%;
    border: 1px solid #ccc;
    border-radius: 5px;
    padding: 5px;
    text-align: center;
}

.text-box {
    width: 15%;
    border: 1px solid #ccc;
    border-radius: 5px;
    padding: 3px;
    display: flex; 
    justify-content: center; 
    align-items: center;
}

.min-box {
    margin-right: 5px;
}

.max-box {
    margin-left: 5px;
}


</style>
<script src="https://cdnjs.cloudflare.com/ajax/libs/noUiSlider/14.6.4/nouislider.min.js"></script>
    <link href = "css/jquery-ui.css" rel = "stylesheet">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/5.3.2/css/bootstrap.min.css">

    <link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.0.1/css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/noUiSlider/14.6.4/nouislider.min.css">

</head>
    
    <div class="section-header" style="display: flex; justify-content: center; align-items: center; background-color: black;">
        <h3 style="font-weight: bold; font-size: 40px; font-family: Century Gothic, sans-serif; color:#FFA500;">Postres</h3>
    </div>
    

    <div class="card-body">
       <h4 align="center" style="font-family: Consolas, sans-serif;"> Bienvenido  {{ auth()->user()->name }} {{ auth()->user()->email }} </h4>
    </div>
    <div class="form-row justify-content-center" >
    <label class="text-box"  >Precios:</label>
    </div>
    


<div class="form-row justify-content-center" >
    <div class="col-lg-2">
        <label class="input-box" for="price_range">
        
            <div class="min-box" style="font-weight: bold; color: black;">
                $<span name="min_price" id="price_range_label_min">{{ $min_price }}</span>
            </div>
            <div class="max-box" style="font-weight: bold; color: black;">
                 $<span  name="max_price" id="price_range_label_max">{{ $max_price }}</span>
            </div>
            

        </label>
    </div>
    
</div>


    <form action="{{ route('Postres.index') }}" method="GET">
    <div id="priceRangeSlider"></div>
        <div class="form-row justify-content-center">
        <div class="col-lg-2">
            <div class="form-group">
                <input type="hidden" name="min_price" id="minPrice" value="{{ $min_price }}" min="{{ $min_price }}" max="{{ $max_price }}" step="1" />
                <input type="hidden" name="max_price" id="maxPrice" value="{{ $max_price }}" min="{{ $min_price }}" max="{{ $max_price }}" step="1" />
            </div>
        </div>
            
        </div>
        <div class="form-row justify-content-center">
        
            <div class="col-lg-2">
                <select class="form-control custom-select no-print select2" style="font-family: Century Gothic, sans-serif;"  name="nombre_postre" id="nombre_postre">
                    <option value="">Postres</option>
                    <?php
                $mysqli = new mysqli('localhost', 'root', '', 'pizzeria');
                $query = $mysqli->query("SELECT * FROM postres");

                while ($postre = mysqli_fetch_array($query)) {
                    echo '<option value="'.$postre['nombre_postre'].'">'.$postre['nombre_postre'].'</option>';
                }
            ?>
                </select>
            </div>
        </div>
        <div class="form-row justify-content-center">
            <div class="col-lg-1.5">
                <button type="submit" class="button-pizza btn-block">Buscar</button>
            </div>
        </div>
    </form>
    @can('Administrador-rol')
    <div class="form-row justify-content-center">
            <div class="col-lg-1.5">
                <a class="gradient-button btn-block" href="{{route ('Postres.create')}}" role="button" data-bs-toggle="button">
                    <i class=" fa fa-plus-square"></i><span >Agregar Postres</span>
                </a>
            </div>
        </div>
    @endcan
    <div class="section-body" id="productos">
        <div class="row product-list">
        @if($postres->count() > 0)
            @foreach ($postres as $postre)
                <div class="col-lg-4 mb-4 product-box">
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

            @endforeach
        @endif
        
        </div>
        
        <div class="form-row justify-content-center">
        @if($postres->count() < $totalProductos)
    <p class="text-center mt-4 mb-5">
        <button class="index btn btn-dark" data-totalResult="{{ $totalProductos }}">Load More</button>
    </p>
@endif
</div>
    </div>
    
</div>

</section>
    
@endsection
{{-- @endcan --}}
<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
<script type="text/javascript">
    var main_site="{{ url('/') }}";
</script>
<script>
        $(document).ready(function() {
  $(".js-select2").select2({
    closeOnSelect: false
  });
  $(".js-select2-multi").select2({
    closeOnSelect: false
  });
 
});

document.addEventListener('DOMContentLoaded', function() {
    var minPrice = {{ $min_price }};
        var maxPrice = {{ $max_price }};
        var initialMin = {{ request('min_price') ?? $min_price }};
        var initialMax = {{ request('max_price') ?? $max_price }};
        var minPriceInput = document.getElementById('minPrice');
        var maxPriceInput = document.getElementById('maxPrice');


        var priceRangeSlider = document.getElementById('priceRangeSlider');
        


    noUiSlider.create(priceRangeSlider, {
        start: [initialMin, initialMax],
            connect: true,
            range: {
                'min': minPrice,
                'max': maxPrice
            }
    });

        priceRangeSlider.noUiSlider.on('update', function(values, handle) {
        var minPrice = Math.round(values[0]);
            var maxPrice = Math.round(values[1]);
            var value = Math.round(values[handle]);

        $('#price_range_label_min').text(minPrice);
            $('#price_range_label_max').text(maxPrice);
            $('#minPrice').val(minPrice);
    $('#maxPrice').val(maxPrice);

    if (handle) {
                maxPriceInput.value = value;
            } else {
                minPriceInput.value = value;
            }
    });

});
$(document).ready(function(){
        $(".index").on('click',function(){
            var _totalCurrentResult=$(".product-box").length;
            // Ajax Reuqest
            $.ajax({
                url: "{{ route('Postres.more_data') }}",
                type:'get',
                dataType:'json',
                data:{
                    skip:_totalCurrentResult
                },
                beforeSend:function(){
                    $(".index").html('Loading...');
                },
                success:function(response){
                    var _html='';
                    var image="{{ asset('img') }}/";
                    var isUsuario = {{ Auth::user()->hasRole('Usuario') ? 'true' : 'false' }};
                    var isAdministrador = {{ Auth::user()->hasRole('Administrador') ? 'true' : 'false' }};
                    var addToCartRoute = "{{ route('Postres.agregarCarrito', ':postre_id') }}";
                    var buyRoute = "{{ route('Postres.comprar', ':postre_id') }}";
                    var editRoute = "{{ route('Postres.edit', ':postre_id') }}";
                    var deleteRoute = "{{ route('Postres.destroy', ':postre_id') }}";
                    
                    $.each(response, function(index, value) {
                        _html += '<div class="col-lg-4 mb-4 product-box">';
                        _html += '<div class="card">';
                        _html += '<img src="' + image + value.postre_imagen + '" class="card-img-top" alt="' + value.nombre_postre + '" style="max-height: 200px; object-fit: cover;">';
                        _html += '<div class="card-body">';
                        _html += '<h6 class="mb-0 text-sm">' + (value.vendedor ? value.vendedor.name : '') + '</h6>';
                        _html += '<h5 class="card-title">' + value.nombre_postre + '</h5>';
                        _html += '<p class="card-text">Precio: $' + value.postre_precio + '</p>';
                        
                        if (isUsuario) {
                            _html += '<form action="' + addToCartRoute.replace(':postre_id', value.id) + '" method="post">';
                            _html += '<input type="hidden" name="_token" value="{{ csrf_token() }}">';
                            _html += '<div class="form-group">';
                            _html += '<label for="quantity">Cantidad:</label>';
                            _html += '<input name="quantity" type="number" class="text-sm sm:text-base px-2 pr-2 rounded-lg border border-gray-400 py-1 focus:outline-none focus:border-blue-400" style="width: 50px" value="1" min="1" />';
                            _html += '</div>';
                            _html += '<p class="btn-holder">';
                            _html += '<button type="submit" class="btn btn-success" role="button">Agregar al carrito</button>';
                            _html += '</p>';
                            _html += '</form>';
                            
                        if (!value.vendido) {
                            _html += '<form method="POST" action="' + buyRoute.replace(':postre_id', value.id) + '">';
                             _html += '<input type="hidden" name="_token" value="{{ csrf_token() }}">';
                            _html += '<input type="hidden" name="_method" value="PUT">';
                            _html += '<button type="submit" class="btn btn-success">Comprar</button>';
                            _html += '</form>';
                        } else {
                            _html += '<span class="btn bg-danger">Sold</span>';
                        }
                    }
        
                    if (isAdministrador) {
                        _html += '<a href="' + editRoute.replace(':postre_id', value.id) + '" class="btn btn-info">Editar</a>';
                         _html += '<form method="POST" action="' + deleteRoute.replace(':postre_id', value.id) + '" style="display:inline">';
                         _html += '<input type="hidden" name="_token" value="{{ csrf_token() }}">';
                        _html += '<input type="hidden" name="_method" value="DELETE">';
                        _html += '<button type="submit" class="btn btn-danger">Borrar</button></form>';
                    }

                    _html += '</div>'
                    _html += '</div>'
                    _html += '</div>';
                });

                    $(".product-list").append(_html);
                    // Change Load More When No Further result
                    var _totalCurrentResult=$(".product-box").length;
                    var _totalResult=parseInt($(".index").attr('data-totalResult'));
                    console.log(_totalCurrentResult);
                    console.log(_totalResult);
                    if(_totalCurrentResult==_totalResult){
                        $(".index").remove();
                    }else{
                        $(".index").html('Load More');
                    }
                }
            });
        });
    });
  </script>