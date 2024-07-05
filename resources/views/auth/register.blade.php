<link rel="icon" href="{{asset('img/teclogo.ico')}}" />
@extends('layouts.auth_app')
@section('title')
    Registro
@endsection
@section('content')

<style>
    .navbar.navbar-transparent { /*transparencia de nav login*/
        background-color: transparent !important;
        box-shadow: none;
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

    <div class="card card-primary">
        <div class="card-header"><h4 style = "color: #FF3300;" >Registrarse</h4></div>

        <div class="card-body pt-1">
            <form method="POST" action="{{ route('register') }}" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <div class="col-md-6">
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
                    </div>
                    <div class="col-md-6">
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
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
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
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
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
                    </div>
                    <div class="col-xs-12 col-sm-12 col-md-12">
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
                    <div class="col-md-12 mt-4">
                        <div class="form-group">
                            <button type="submit" class="btn-login btn-lg btn-block" tabindex="4">
                                Registro
                            </button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <div class="mt-5 text-muted text-center">
        Ya tienes una cuenta? <a style = "color: #FF3300;"
                href="{{ route('login') }}">Iniciar sesión</a>
    </div>
@endsection


