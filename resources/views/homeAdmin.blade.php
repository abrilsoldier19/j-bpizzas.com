@extends('layouts.app')

@section('content')
<head>
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
</head>

    <section class="section fondo_pantalla">
        <div class="section-header text-center d-flex align-items-center justify-content-center " style="background-color: black; color: white; ">
            <h3 class="page__heading">¡Bienvenido {{ auth()->user()->name }} a Pizzería delicioso!</h3>
        </div>
        <div class="section-body" >
            <div class="row">
                <div class="col-lg-12">
                    <div class="card-body">                          
                        <div class="row justify-content-center">
                            <!-- Modify your cards as needed -->
                            <div class="container text-center ">
                                <label class="transparent-textbox" for="hora" style="color: white; font-size: 19px;"><b>Hora</b>
                                <b id="display-time" >
                                    <script>
                                        function myFunc() 
                                        {
                                            var now = new Date();
                                            var hours = now.getHours();
                                            var ampm = hours >= 12 ? 'PM' : 'AM';
                                            hours = hours % 12;
                                            hours = hours ? hours : 12; // Si es 0, entonces es medianoche
                                            var time = hours + ":" + (now.getMinutes() < 10 ? '0' : '') + now.getMinutes() + ":" + (now.getSeconds() < 10 ? '0' : '') + now.getSeconds() + " " + ampm;
                                            document.getElementById('display-time').innerHTML = time;
                                        }
                                        setInterval(myFunc, 1000);
                                    </script>
                                </b>
                                </label>
                            
                                <p style="color: white; font-family: 'Century Gothic', sans-serif; font-size: 20px;">
                                <b>Te ofrecemos las mejores pizzas recién salidas del horno.</b></p>
                            </div>
                            <div class="container text-center ">
                                <div class="row">
                                    <div class="col-md-4 right-box">
                                        <h2>Nuestra Historia</h2>
                                        <p>Somos un negocio de pizzas fundada en 2021, un negocio petfriendly y amigable. 
                                        Esperamos que disfrutes de nuestros productos. </p>
                                    </div>
                                    <div class="col-md-4 right-box">
                                        <h2>Nuestro Menú</h2>
                                        <p> 
                                            <button type="button" class="btn btn-danger" onclick="window.location='{{ route('Pizzas.index') }}'">Pizzas</button>
                                        </p>
                                        <p>
                                            <button type="button" class="btn btn-danger" onclick="window.location='{{ route('Pizzas.index') }}'">Pizzas</button>
                                        </p>
                                    </div>
                                    <div class="col-md-4 right-box">
                                        <h2>Nuestra Misión</h2>
                                        <p>Ademas de pizzas, ofrecemos complementos, postres, promociones y bebidas para que disfrutes con amigos, pareja y familia.</p>
                                    </div>
                                </div>
                            </div>
                            <div class="row mt-3">
        <div class="col-md-12 text-center">
            
            <button class="btn btn-dark " onclick="showAllImages()">Mostrar Ambas Imágenes</button>
        </div>
    </div>

                            <div class="container mt-5">
    <div class="row">
        <div class="col-md-6">
            <h2 class="transparent-box">Pizzas con carne</h2>
            <button class="btn btn-dark" onclick="showImages('column-1')">Mostrar imagen columna 1</button>
            <?php
            $conn = mysqli_connect("localhost", "root", "", "pizzeria");
            $tablas = mysqli_query($conn, "SELECT imagen_pizza FROM pizzeria ORDER BY id DESC LIMIT 3");
            ?>
            <div class="image-container">
                <?php foreach ($tablas as $key => $tabla) : ?>
                    <div class="box box-column-1" data-value="<?php echo $key; ?>" style="display: none;">
                        <img src="img/<?php echo $tabla["imagen_pizza"]; ?>" width="200" title="<?php echo $tabla['imagen_pizza']; ?>">
                    </div>
                <?php endforeach; ?>
                
            </div>
        </div>

        <div class="col-md-6">
            <h2 class="transparent-box">Pizzas con verdura</h2>
            <button class="btn btn-dark" onclick="showImages('column-2')">Mostrar imagen columna 2</button>
            <?php
            $tablas = mysqli_query($conn, "SELECT imagen_pizza FROM pizzeria ORDER BY id DESC LIMIT 3 OFFSET 3");
            ?>
            <div class="image-container">
                <?php foreach ($tablas as $key => $tabla) : ?>
                    <div class="box box-column-2" data-value="<?php echo $key; ?>" style="display: none;">
                        <img src="img/<?php echo $tabla["imagen_pizza"]; ?>" width="200" title="<?php echo $tabla['imagen_pizza']; ?>">
                    </div>
                <?php endforeach; ?>
                
            </div>
        </div>
    </div>

    
</div>
    </section>

    <style>

.fondo_pantalla { 
    background-image: url("{{ asset('img/pizza_fondo.jpg') }}"); /*fondo de pantalla login*/
  background-color: transparent;
  background-size: cover;
  min-height: 100vh;
  background-position: center center;
  background-size: cover;
}
        /* Add or modify styles as needed */
        .btn-login
{
    font-family: 'Century Gothic', sans-serif;
    background-color: #FF3300;
    border: none;
    color: black;
    font-weight: bold;
    padding: 10px 20px;
    cursor: pointer;
    transition: background-color 0.3s ease;   
}
.btn-login:hover 
{
 background-color: black;
 color: white;
}

.right-box {
    background-color: rgba(0, 0, 0, 0.7); /* Color de fondo del cuadro */
    padding: 20px; /* Espaciado interno del cuadro */
    border-radius: 10px; /* Bordes redondeados */
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1); /* Sombra ligera */
    margin-top: 20px; /* Espacio superior del cuadro */
    color: white;
}

.titulo
{
 background-color: black;
 color: white;
}
.transparent-textbox {
    background-color: rgba(0, 0, 0, 0.7);
            
            font-size: 19px;
            border-radius: 10px;
            width: 200px;
        }
        #columna1Image img {
        display: none;
    }

    .transparent-box {
    background-color: rgba(0, 0, 0, 0.7);
            
            font-size: 19px;
            border-radius: 10px;
            width: 200px;
            height: 50px;
            color: white;
            text-align: center;
            padding: 10px;
        }
    </style>

<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
<script type="text/javascript">
    function showImages(column) {
        $(".box-" + column).show();
    }

    function showAllImages() {
        $(".box").show();
    }

    $(document).ready(function () {
        // Initially hide all images
        $(".box").hide();

        $('input[type="radio"]').click(function () {
            var selectedValue = $(this).val();
            $(".box").hide();
            $(".box[data-value='" + selectedValue + "']").show();
        });
    });
</script>
@endsection
