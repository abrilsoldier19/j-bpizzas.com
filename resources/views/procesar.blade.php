


<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="csrf-token" content="{{ csrf_token() }}"/>
    <title>J&B PIZZAGO</title>
    <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
    <!-- Bootstrap 4.1.1 -->
    <link href="{{ asset('assets/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css"/>
    <!-- Ionicons -->
    <link href="//fonts.googleapis.com/css?family=Lato&display=swap" rel="stylesheet">
    <link href="{{ asset('assets/css/@fortawesome/fontawesome-free/css/all.css') }}" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="{{ asset('assets/css/iziToast.min.css') }}">
    <link href="{{ asset('assets/css/sweetalert.css') }}" rel="stylesheet" type="text/css"/>
    <link href="{{ asset('assets/css/select2.min.css') }}" rel="stylesheet" type="text/css"/>
    <link rel="icon" href="{{asset('img/teclogo.ico')}}" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css"> 
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.7.0/dist/jquery.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    
   


@yield('page_css')
<!-- Template CSS -->
    <link rel="stylesheet" href="{{ asset('web/css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('web/css/components.css')}}">
    @yield('page_css')


    @yield('css')
</head>
<body>

<div id="app">
    <div class="main-wrapper main-wrapper-1" style="background-color: #FF6304; ">
        <div class="navbar-bg">
        
        </div>
        <nav class="navbar navbar-expand-lg main-navbar" style="background-color: black; ">
        <form class="form-inline mr-auto" action="#">
    <ul class="navbar-nav mr-3">
        <li><a href="#" data-toggle="sidebar" class="nav-link nav-link-lg"><i class="fas fa-bars"></i></a></li>
    </ul>
</form>
       

        </nav>
        <div class="main-sidebar main-sidebar-postion" style="background-color: orange; ">
            @include('layouts.sidebar')
            
        </div>
        
        <!-- Main Content -->
        <div class="main-content " style="background-color: #CC7B04; ">
         <button type="button" class="btn btn-danger" onclick="window.history.back();">Regresar</button>
            @yield('content')
            <div class="container text-center mb-5 mt-5">
    <h1 class="titulo">¡Bienvenido a Pizzería delicioso!</h1>
    <p style="color: white; font-family: 'Century Gothic', sans-serif; font-size: 20px;">Te ofrecemos las mejores pizzas recién salidas del horno.</p>
</div>

<div class="container text-center mb-5 mt-5">
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
        </div>
        <div class="col-md-4 right-box">
            <h2>Nuestra Misión</h2>
            <p>Ademas de pizzas, ofrecemos complementos, postres, promociones y bebidas para que disfrutes con amigos, pareja y familia.</p>
        </div>
    </div>
</div>
<div class="container mt-5">
<div class="col-md-12 text-center">
            
            <button class="btn btn-dark " onclick="showAllImages()">Mostrar Ambas Imágenes</button>
        </div>
    </div>

                            <div class="container mt-5">
    <div class="row">
        <div class="col-md-4">
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
        <div class="col-md-4 right-box" >
        <h2>Ingresar</h2>
            <form method="POST" action="{{ route('login') }}">
                @csrf
                @if ($errors->any())
                    <div class="alert alert-danger p-0">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                <div class="form-group">
                    <label for="email" style="color: white;">Correo electrónico:</label>
                    <input aria-describedby="emailHelpBlock" id="email" type="email"
                           class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email"
                           placeholder="Ej. I00000000@monclova.tecnm.mx" tabindex="1"
                           value="{{ (Cookie::get('email') !== null) ? Cookie::get('email') : old('email') }}" autofocus
                           required>
                    <div class="invalid-feedback">
                        {{ $errors->first('email') }}
                    </div>
                </div>

                <div class="form-group">
                    <div class="d-block">
                        <label for="password" class="control-label" style="color: white;">Contraseña:</label>
                        <div class="float-right">
                            <!-- <a href="{{ route('password.request') }}" class="text-small">
                            Has olvidado tu contraseña?
                            </a> -->
                        </div>
                    </div>
                    <input aria-describedby="passwordHelpBlock" id="password" type="password"
                           value="{{ (Cookie::get('password') !== null) ? Cookie::get('password') : null }}"
                           placeholder="Introducir la contraseña"
                           class="form-control{{ $errors->has('password') ? ' is-invalid': '' }}" name="password"
                           tabindex="2" required>
                    <div class="invalid-feedback">
                        {{ $errors->first('password') }}
                    </div>
                </div>
                <div class="form-group">
                    <button type="submit" class="btn-login btn-lg btn-block" tabindex="4">
                        Login
                    </button>
                </div>
                <div class="form-group">
                    <div class="custom-control custom-checkbox">
                        <input type="checkbox" name="remember" class="custom-control-input" tabindex="3"
                               id="remember"{{ (Cookie::get('remember') !== null) ? 'checked' : '' }}>
                        <label class="custom-control-label" for="remember">Recuérdame...</label>
                    </div>
                </div>
            </form>
        </div>
        <div class="col-md-4">
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
        <footer class="main-footer" style="background-color: black; color: white;">
            @include('layouts.footer')
        </footer>
    </div>
</div>
<div class="container mt-4">
    @if(session('success'))
        <div class="alert alert-success">
          {{ session('success') }}
        </div> 
    @endif
    
</div>


</body>
<script src="{{ asset('assets/js/jquery.min.js') }}"></script>
<script src="{{ asset('assets/js/popper.min.js') }}"></script>
<script src="{{ asset('assets/js/bootstrap.min.js') }}"></script>
<script src="{{ asset('assets/js/sweetalert.min.js') }}"></script>
<script src="{{ asset('assets/js/iziToast.min.js') }}"></script>
<script src="{{ asset('assets/js/select2.min.js') }}"></script>
<script src="{{ asset('assets/js/jquery.nicescroll.js') }}"></script>

<!-- Template JS File -->
<script src="{{ asset('web/js/stisla.js') }}"></script>
<script src="{{ asset('web/js/scripts.js') }}"></script>
<script src="{{ mix('assets/js/profile.js') }}"></script>
<script src="{{ mix('assets/js/custom/custom.js') }}"></script>
@yield('page_js')
@yield('scripts')
<script>
    let loggedInUser =@json(\Illuminate\Support\Facades\Auth::user());
    let loginUrl = '{{ route('login') }}';
    // Loading button plugin (removed from BS4)
    (function ($) {
        $.fn.button = function (action) {
            if (action === 'loading' && this.data('loading-text')) {
                this.data('original-text', this.html()).html(this.data('loading-text')).prop('disabled', true);
            }
            if (action === 'reset' && this.data('original-text')) {
                this.html(this.data('original-text')).prop('disabled', false);
            }
        };
    }(jQuery));

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
</html>



@section('title')
    Inicio 
@endsection
@section('content')

<style>
    .navbar-bg {
        background-color: #FF6304; /* Change this to your desired color */
    }
    
    .fondo_pantalla { 
    background-image: url("{{ asset('img/pizza_fondo.jpg') }}"); /*fondo de pantalla login*/
  background-color: transparent;
  background-size: cover;
  min-height: 100vh;
  background-position: center center;
  background-size: cover;
}
.navbar.navbar-transparent {
  background-color: #ffcc00; /* Yellow or any color that suits your pizza theme */
  box-shadow: none;
}

.navbar-nav li.nav-item a.nav-link {
  color: #fff; /* White text */
}

.navbar-nav li.nav-item a.nav-link {
  color: #fff; /* White text */
  background-color: #e74c3c; /* Red or any color that suits your pizza theme */
  padding: 10px 15px;
  border-radius: 5px;
  font-size: 20px;
}
.navbar-collapse{
    flex-basis: 100%;
    flex-grow: 1;
    align-items: center;
}
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
.sidebar-menu aside {
        background-color: #FFA500;
    /* Agrega otros estilos según tus necesidades */
}
</style>
