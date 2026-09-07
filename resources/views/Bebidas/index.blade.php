<title>Bebidas | {{ config('app.name') }}</title>
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

.card-walmart {
            border: 1px solid #e0e0e0 !important;
            border-radius: 15px !important;
            overflow: hidden;
            background-color: #ffffff !important; /* Fuerza a que la tarjeta sea blanca sobre el fondo */
            box-shadow: 0 4px 6px rgba(0,0,0,0.05) !important;
            transition: transform 0.2s, box-shadow 0.2s;
        }
        .card-walmart:hover {
            transform: translateY(-4px);
            box-shadow: 0 10px 20px rgba(0,0,0,0.1) !important;
        }
        .product-image-container {
    background-color: #f8f9fa; /* Fondo gris claro neutral para resaltar el blanco */
    border-radius: 16px;       /* Bordes redondeados de la tarjeta de foto */
    height: 200px;             /* Altura fija uniforme para todas las latas/botellas */
    display: flex;
    align-items: center;
    justify-content: center;
    padding: 12px;
    overflow: hidden;
}

/* Ajuste de la botella/lata */
.product-image {
    max-height: 100%;
    max-width: 100%;
    width: auto;
    height: auto;
    object-fit: contain;       /* Evita recortes o deformaciones en botellas delgadas */
    filter: drop-shadow(0px 4px 6px rgba(0,0,0,0.12)); /* Sombra suave para dar efecto 3D */
    transition: transform 0.3s ease;
}

/* Efecto Hover para destacar el producto */
.card-walmart:hover .product-image {
    transform: scale(1.06);   /* Ligero zoom al pasar el cursor */
}
        .product-title-walmart {
            font-family: 'Century Gothic', sans-serif;
            font-weight: bold;
            font-size: 16px;
            color: #212529;
            height: 44px;
            overflow: hidden;
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
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
        <h3 style="font-weight: bold; font-size: 40px; font-family: Century Gothic, sans-serif; color:#FFA500;">Bebidas</h3>
    </div>
    

    <div class="card-body">
       <h4 align="center" style="font-family: Consolas, sans-serif;"> Bienvenido  {{ auth()->user()->name }} {{ auth()->user()->email }} </h4>
    </div>
    <div class="form-row justify-content-center" >
    <label class="text-box"  >Precios:</label>
    </div>


<div class="form-row justify-content-center">
        <div class="col-lg-2">
            <label class="input-box" for="price_range">
                <div class="min-box">
                    $<span id="price_range_label_min">{{ request('min_price') ?? 0 }}</span>
                </div>
                <div class="max-box">
                    $<span id="price_range_label_max">{{ request('max_price') ?? 1000 }}</span>
                </div>
            </label>
        </div>
    </div>


    <form action="{{ route('Bebidas.index') }}" method="GET">
    <div class="form-row justify-content-center">
            <div class="col-lg-3">
                <div id="priceRangeSlider"></div>
            </div>
        </div>
        
        <div class="form-row justify-content-center">
            <div class="col-lg-2">
                <div class="form-group">
                    <input type="hidden" name="min_price" id="minPrice" value="{{ request('min_price') ?? 0 }}" />
                    <input type="hidden" name="max_price" id="maxPrice" value="{{ request('max_price') ?? 1000 }}" />
                </div>
            </div>
        </div>
        <div class="form-row justify-content-center">
        
            <div class="col-lg-2">
                <select class="form-control custom-select no-print select2" style="font-family: Century Gothic, sans-serif;"  name="nombre_bebida" id="nombre_bebida">
                    <option value="">Bebidas</option>
                    <?php
                $mysqli = new mysqli('localhost', 'root', '', 'pizzeria');
                $query = $mysqli->query("SELECT * FROM bebidas");

                while ($bebida = mysqli_fetch_array($query)) {
                    echo '<option value="'.$bebida['nombre_bebida'].'">'.$bebida['nombre_bebida'].'</option>';
                }
            ?>
                <?php
                    $mysqli = new mysqli('localhost', 'root', '', 'pizzeria');
                    $querySelect = $mysqli->query("SELECT DISTINCT nombre_bebida FROM bebidas");
                    while ($bebidaSelect = mysqli_fetch_array($querySelect)) {
                        $selected = (request('nombre_bebida') == $bebidaSelect['nombre_bebida']) ? 'selected' : '';
                        echo '<option value="'.$bebidaSelect['nombre_bebida'].'" '.$selected.'>'.$bebidaSelect['nombre_bebida'].'</option>';
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
                <a class="gradient-button btn-block" href="{{route ('Bebidas.create')}}" role="button" data-bs-toggle="button">
                    <i class=" fa fa-plus-square"></i><span >Agregar bebidas</span>
                </a>
            </div>
        </div>
    @endcan

    <div class="section-body" id="productos">
        <div class="row product-list">
        @if($bebidas->count() > 0)
            @foreach ($bebidas as $bebida)
                <div class="col-lg-4 mb-4 product-box">
                    <div class="card h-100 shadow-sm card-walmart">
                        <div class="product-image-container">
                            <img src="{{ asset('img/'.$bebida->bebida_imagen) }}" alt="{{ $bebida->nombre_bebida }}" class="product-image">
                        </div>
                        
                        <div class="card-body d-flex flex-column p-3">
                            <h6 class="mb-0 text-sm text-muted" style="font-family: 'Century Gothic', sans-serif; font-weight: bold; color: #757575;">
                               {{ $bebida->marca ?? 'Genérico' }}
                            </h6>
                            <!-- Agregada la clase de corte automático para helados con nombres largos -->
                            <h5 class="product-title-walmart mt-1 mb-1" title="{{ $bebida->nombre_bebida }}">{{ $bebida->nombre_bebida }}</h5>
                            <p class="card-text text-primary font-weight-bold mb-3">Precio: ${{ number_format($bebida->bebida_precio, 0, '.', '.') }}</p>
                            
                            <!-- El contenedor mt-auto empuja los botones abajo manteniendo simetría recta -->
                            <div class="mt-auto">
                                <!-- ACCIONES EXCLUSIVAS DEL CLIENTE (USUARIO) -->
                                @if (Auth::user()->hasRole('Usuario'))
                                    @if($bebida->stock <= 0 || $bebida->vendido == 1)
                                        <div class="text-danger small font-weight-bold mb-2">
                                            <i class="fas fa-times-circle"></i> No disponible - Agotado
                                        </div>
                                        <button class="btn btn-secondary w-100 disabled" style="border-radius: 20px; font-weight: bold;" disabled>Agotado</button>
                                    @else 
                                        <div class="text-success small font-weight-bold mb-2">
                                            <i class="fas fa-check-circle"></i> Quedan: <span class="badge bg-success text-white">{{ $bebida->stock ?? 50 }} pzas</span>
                                        </div>
                                        
                                        <form action="{{ route('Bebidas.agregarCarrito', $bebida->id) }}" method="POST" class="mb-2">
                                            @csrf
                                            <div class="d-flex gap-2 align-items-center mb-3 justify-content-between">
                                                <small class="text-muted">Cantidad:</small>
                                                <!-- CORRECCIÓN: name="quantity" mapeado exactamente como lo espera tu controlador -->
                                                <input type="number" id="cantidad_{{ $bebida->id }}" name="quantity" value="1" min="1" max="{{ $bebida->stock ?? 50 }}" class="form-control form-control-sm text-center" style="width: 65px; border-radius: 8px;">
                                            </div>
                                            <button type="submit" class="btn btn-success text-white w-100 font-weight-bold" style="border-radius: 20px; background-color: #0e6b02; border: none; font-size: 14px;">
                                                <i class="fas fa-shopping-cart"></i> Agregar al carrito
                                            </button>
                                        </form>
                                    @endif
                                @endif
                                
                                <!-- ACCIONES EXCLUSIVAS DEL ADMINISTRADOR -->
                                @can('Administrador-rol')
                                    <div class="d-flex justify-content-between align-items-center pt-2 border-top mt-2">
                                        <a href="{{ route('Bebidas.edit', $bebida->id) }}" class="btn btn-sm btn-info text-white" style="border-radius: 10px;">Editar</a>
                                        {!! Form::open(['method' => 'DELETE','route' => ['Bebidas.destroy', $bebida->id],'style'=>'display:inline', 'onsubmit' => "return confirm('¿Seguro que deseas eliminar esta bebida?');"]) !!}
                                            {!! Form::submit('Borrar', ['class' => 'btn btn-danger btn-sm', 'style' => 'border-radius: 10px;']) !!}
                                        {!! Form::close() !!}
                                    </div>
                                @endcan
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        @endif
    </div>
    
    <!-- Botón de paginación asíncrona Load More -->
    <div class="form-row justify-content-center">
        @if($bebidas->count() < $totalProductos)
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

<script>
    var main_site = "{{ url('/') }}";
    
    $(document).ready(function() {
        if ($.fn.select2) {
            $(".js-select2").select2({ closeOnSelect: false });
            $(".js-select2-multi").select2({ closeOnSelect: false });
        }
    });

    document.addEventListener('DOMContentLoaded', function() {
        var limiteAbsolutoMin = 0;
        var limiteAbsolutoMax = 1000;
        var initialMin = {{ request('min_price') ?? 0 }};
        var initialMax = {{ request('max_price') ?? 1000 }};
        var minPriceInput = document.getElementById('minPrice');
        var maxPriceInput = document.getElementById('maxPrice');
        var priceRangeSlider = document.getElementById('priceRangeSlider');
        
        if (priceRangeSlider) {
            noUiSlider.create(priceRangeSlider, {
                start: [initialMin, initialMax],
                connect: true,
                range: {
                    'min': limiteAbsolutoMin,
                    'max': limiteAbsolutoMax
                }
            });
           
            priceRangeSlider.noUiSlider.on('update', function(values, handle) {
                var value = Math.round(values[handle]);
                if (handle) {
                    $('#price_range_label_max').text(value);
                    maxPriceInput.value = value;
                } else {
                    $('#price_range_label_min').text(value);
                    minPriceInput.value = value;
                }
            });
        }
    });


    $(document).ready(function(){
    // Alerta de seguridad antes de borrar registros del menú
    $(document).on('submit', 'form[action*="destroy"]', function() {
        return confirm('¿Estás completamente seguro de que deseas eliminar esta bebida del menú?');
    });

    $(".index").on('click', function(){
        var _totalCurrentResult = $(".product-box").length;

        $.ajax({
            url: "{{ route('Bebidas.more_data') }}",
            type: 'get',
            dataType: 'json',
            data: {
                skip: _totalCurrentResult,
                nombre_bebida: $('#nombre_bebida').val(),
                min_price: $('#minPrice').val(),
                max_price: $('#maxPrice').val()
            },
            beforeSend: function(){
                $(".index").html('Loading...');
            },
            success: function(response){
                var _html = '';
                var image = "{{ asset('img') }}/";
                var isUsuario = @json(Auth::user()->hasRole('Usuario'));
                var isAdministrador = @can('Administrador-rol') true @else false @endcan;
                
                // Ruta unificada a agregarCarrito en POST directo
                var addToCartRoute = "{{ route('Bebidas.agregarCarrito', ':bebida_id') }}";
                var editRoute = "{{ route('Bebidas.edit', ':bebida_id') }}";
                var deleteRoute = "{{ route('Bebidas.destroy', ':bebida_id') }}";
                
                $.each(response, function(index, value) {
                    var precioFormateado = parseFloat(value.bebida_precio).toLocaleString('es-MX', { minimumFractionDigits: 0 });

                    _html += '<div class="col-lg-4 mb-4 product-box">';
                    // CORRECCIÓN: Inyectamos la clase card-walmart exacta para que las tarjetas de abajo salgan blancas
                    _html += '<div class="card h-100 shadow-sm card-walmart">';
                    _html += '<div class="product-image-container">';
                    _html += '<img src="' + image + value.bebida_imagen + '" class="product-image" alt="' + value.nombre_bebida + '">';
                    _html += '</div>';
                    _html += '<div class="card-body d-flex flex-column p-3">';
                    var marcaProducto = value.marca ? value.marca : 'Genérico';
                    _html += '<h6 class="mb-0 text-sm text-muted" style="font-family: \'Century Gothic\', sans-serif; font-weight: bold; color: #757575;">' + marcaProducto + '</h6>';
                    _html += '<h5 class="product-title-walmart mt-1 mb-1" title="' + value.nombre_bebida + '">' + value.nombre_bebida + '</h5>';
                    _html += '<p class="card-text text-primary font-weight-bold mb-3">Precio: $' + precioFormateado + '</p>';
                    
                    _html += '<div class="mt-auto">';
                    
                    if (isUsuario) {
                        var stockReal = value.stock !== null ? value.stock : 50;

                        if (stockReal <= 0 || value.vendido == 1) {
                            _html += '<div class="text-danger small font-weight-bold mb-2"><i class="fas fa-times-circle"></i> No disponible - Agotado</div>';
                            _html += '<button class="btn btn-secondary w-100 disabled" style="border-radius: 20px; font-weight: bold;" disabled>Agotado</button>';
                        } else {
                            _html += '<div class="text-success small font-weight-bold mb-2"><i class="fas fa-check-circle"></i> Quedan: <span class="badge bg-success text-white">' + stockReal + ' pzas</span></div>';
                            
                            // Formulario en JS corregido a POST nativo con variable quantity para el controlador
                            _html += '<form action="' + addToCartRoute.replace(':bebida_id', value.id) + '" method="POST" class="mb-2">';
                            _html += '<input type="hidden" name="_token" value="{{ csrf_token() }}">';
                            _html += '<div class="d-flex gap-2 align-items-center mb-3 justify-content-between"><small class="text-muted">Cantidad:</small>';
                            _html += '<input name="quantity" type="number" class="form-control form-control-sm text-center" style="width: 65px; border-radius: 8px;" value="1" min="1" max="' + stockReal + '" /></div>';
                            _html += '<button type="submit" class="btn btn-success text-white w-100 font-weight-bold" style="border-radius: 20px; background-color: #0e6b02; border: none; font-size: 14px;"><i class="fas fa-shopping-cart"></i> Agregar al carrito</button>';
                            _html += '</form>';
                        }
                    }
        
                    if (isAdministrador) {
                        _html += '<div class="d-flex justify-content-between align-items-center pt-2 border-top mt-2">';
                        _html += '<a href="' + editRoute.replace(':bebida_id', value.id) + '" class="btn btn-sm btn-info text-white" style="border-radius: 10px;">Editar</a>';
                        _html += '<form method="POST" action="' + deleteRoute.replace(':bebida_id', value.id) + '" style="display:inline" onsubmit="return confirm(\'¿Seguro que deseas eliminar esta bebida del menú?\');">';
                        _html += '<input type="hidden" name="_token" value="{{ csrf_token() }}">';
                        _html += '<input type="hidden" name="_method" value="DELETE">';
                        _html += '<button type="submit" class="btn btn-danger btn-sm" style="border-radius: 10px;">Borrar</button></form>';
                        _html += '</div>';
                    }

                    _html += '</div>'; 
                    _html += '</div>'; 
                    _html += '</div>'; 
                    _html += '</div>'; 
                });

                $(".product-list").append(_html);
                
                var _totalCurrentResult = $(".product-box").length;
                var _totalResult = parseInt($(".index").attr('data-totalResult'));
                
                if(_totalCurrentResult >= _totalResult){
                    $(".index").remove();
                } else {
                    $(".index").html('Load More');
                }
            },
            error: function() {
                $(".index").html('Load More');
                alert('Ocurrió un error al cargar más bebidas. Inténtalo nuevamente.');
            }
        });
    });
});
  </script>