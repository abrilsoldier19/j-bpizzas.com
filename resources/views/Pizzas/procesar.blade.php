<!-- ICON pagina -->
<link rel="icon" href="{{asset('img/teclogo.ico')}}" />

<!-- barra de arriba botones derecha login y register -->
<nav class="navbar navbar-expand-md navbar-transparent navbar-light bg-white shadow-sm">
    <div class="container">
        
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent" >
            <!-- Left Side Of Navbar -->
            <ul class="navbar-nav me-auto">
            </ul>

            <!-- Right Side Of Navbar -->
            <ul class="navbar-nav ms-auto" >
                <!-- Authentication Links -->
                @guest
                    @if (Route::has('login'))
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('login') }}" style="color: white;">{{ __('Login') }}</a>
                        </li>
                    @endif

                    @if (Route::has('register'))
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('register') }}" style="color: white;">{{ __('Registrarse') }}</a>
                        </li>
                    @endif
                @else
                    <li class="nav-item dropdown">
                        <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                            {{ Auth::user()->name }}
                        </a>

                        <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item" href="{{ route('logout') }}"
                               onclick="event.preventDefault();
                                             document.getElementById('logout-form').submit();">
                                {{ __('Cerrar sesión') }}
                            </a>

                            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                @csrf
                            </form>
                        </div>
                    </li>
                @endguest
            </ul>
        </div>
    </div>
</nav><br><br>

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
                Para ver nuestro menu, tienes que registrarte primero
            </p>
            <p> 
                @guest
                <button type="button" class="btn btn-danger" onclick="window.location='{{ route('Pizzas.index') }}'">Pizzas</button>
                @endguest
            </p>
            <p> 
                @guest
                <button type="button" class="btn btn-danger" onclick="window.location='{{ route('Pizzas.index') }}'">Pizzas</button>
                @endguest
            </p>
        </div>
        <div class="col-md-4 right-box">
            <h2>Nuestra Misión</h2>
            <p>Duis porttitor, nisl ac blandit porta, purus lacus feugiat justo, id semper libero dolor vel quam. Donec quis pharetra elit, at fringilla dolor. Etiam non finibus orci. Morbi sagittis tincidunt erat, at finibus mi tristique non. Nullam molestie ipsum vitae velit volutpat luctus. Nam sed dapibus ante, eu laoreet eros. Ut sed dui sed massa semper rutrum eu ut augue.</p>
        </div>
    </div>
</div>
<div class="container text-center mb-5 mt-5">
    <div class="row">
        <div class="col-md-6 right-box text-center" style="">
            <h2>Registrarse</h2>
            <form method="POST" action="{{ route('register') }}" enctype="multipart/form-data">
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
                <label for="first_name">Nombre Completo:</label><span
                                    class="text-danger">*</span>
                            <input id="firstName" type="text"
                                   class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}"
                                   name="name"
                                   tabindex="1" placeholder="Ingrese el name completo" value="{{ old('name') }}"
                                   autofocus required>
                            <div class="invalid-feedback">
                                {{ $errors->first('name') }}
                            </div>
                </div>
                <div class="form-group">
                <label for="email">Email:</label><span
                                    class="text-danger">*</span>
                            <input id="email" type="email"
                                   class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}"
                                   placeholder="Ej. I00000000@monclova.tecnm.mx" name="email" tabindex="1"
                                   value="{{ old('email') }}"
                                   required autofocus>
                            <div class="invalid-feedback">
                                {{ $errors->first('email') }}
                            </div>
                </div>

                <div class="form-group">
                    <div class="d-block">
                    <label for="password" class="control-label">Contraseña
                                :</label><span
                                    class="text-danger">*</span>
                            <input id="password" type="password"
                                   class="form-control{{ $errors->has('password') ? ' is-invalid': '' }}"
                                   placeholder="Ingresar contraseña" name="password" tabindex="2" required>
                            <div class="invalid-feedback">
                                {{ $errors->first('password') }}
                            </div>
                    </div>
                    <label for="password_confirmation"
                                   class="control-label">Confirmar_Contraseña:<span
                                    class="text-danger">*</span></label>
                            <input id="password_confirmation" type="password" placeholder="Confirmar contraseña"
                                   class="form-control{{ $errors->has('password_confirmation') ? ' is-invalid': '' }}"
                                   name="password_confirmation" tabindex="2">
                            <div class="invalid-feedback">
                                {{ $errors->first('password_confirmation') }}
                            </div>
                </div>
                <div class="form-group">
                <label for="roles">Roles</label>
                         <select name="roles[]" id="roles" class="form-control{{ $errors->has('roles') ? ' is-invalid' : '' }}" required>
                            <option value="" disabled selected>Select your role</option>
                            <option value="Administrador" {{ old('roles') && in_array('Administrador', old('roles')) ? 'selected' : '' }}>Administrador</option>
                            <option value="Usuario" {{ old('roles') && in_array('Usuario', old('roles')) ? 'selected' : '' }}>Usuario</option>
                        </select>
                        <div class="invalid-feedback">
                            {{ $errors->first('roles') }}
                        </div>
                </div>
                
                <div class="form-group">
                <button type="submit" class="btn-login btn-lg btn-block" tabindex="4">
                                Registro
                            </button>
                </div>
                
            </form>
        </div>
        
    </div>
</div>

<div class="container mt-5">
    <div class="row">
        <div class="col-md-6">
            <h2>Columna 1</h2>
            <div id="columna1Image"></div>
            <button class="btn btn-primary" onclick="loadImage('columna1')">Mostrar Imagen</button>
        </div>
        <div class="col-md-6">
            <h2>Columna 2</h2>
            <div id="columna2Image"></div>
            <button class="btn btn-primary" onclick="loadImage('columna2')">Mostrar Imagen</button>
        </div>
    </div>
    <div class="row mt-3">
        <div class="col-md-12">
            <button class="btn btn-primary" onclick="loadImages()">Mostrar Ambas Imágenes</button>
        </div>
    </div>
</div>


@extends('layouts.auth_app')
@section('title')
    Inicio 
@endsection
@section('content')

<style>
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

.fondo_pantalla { 
    background-image: url("{{ asset('img/pizza_fondo.jpg') }}"); /*fondo de pantalla login*/
  background-color: transparent;
  background-size: cover;
  min-height: 100vh;
  background-position: center center;
  background-size: cover;
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
</style>

@endsection
