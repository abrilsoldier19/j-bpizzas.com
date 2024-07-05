<!-- ICON pagina -->
<link rel="icon" href="{{asset('img/teclogo.ico')}}" />

<!-- barra de arriba botones derecha login y register -->
<nav class="navbar navbar-expand-md navbar-transparent navbar-light bg-white shadow-sm">
    <div class="container">
        
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <!-- Left Side Of Navbar -->
            <ul class="navbar-nav me-auto">
            </ul>

            <!-- Right Side Of Navbar -->
            <ul class="navbar-nav ms-auto">
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

@extends('layouts.auth_app')
@section('title')
    Login 
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
</style>


<br><br><br>
    <div class="card card-primary">
        <!-- <div class="card-header justify-content-center"><h4>Login</h4></div> -->

        <div class="card-body">
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
                    <label for="email">Correo electrónico:</label>
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
                        <label for="password" class="control-label">Contraseña:</label>
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
    </div>
@endsection
