
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
    
    
   


@yield('page_css')
<!-- Template CSS -->
    <link rel="stylesheet" href="{{ asset('web/css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('web/css/components.css')}}">
    @yield('page_css')


    @yield('css')
</head>
<body>

<div id="app">
    <div class="main-wrapper main-wrapper-1" style="background-color: #CC7B04;">
        <div class="navbar-bg"></div>
        <nav class="navbar navbar-expand-lg main-navbar" style="background-color: black;">
            @include('layouts.header')
        </nav>
        <div class="main-sidebar main-sidebar-postion" style="background-color: orange;">
            @include('layouts.sidebar')
        </div>
        <!-- Main Content -->
        <div class="main-content " style="background-color: #CC7B04;">
            @if(session('success'))
                <div class="container mt-2">
                    <div class="alert alert-success" style="color: white; background-color: green; border-color: #4CAF50;">
                        {{ session('success') }}
                    </div>
                </div>
            @endif
            @yield('content')
        </div>
        <div style="background-color: #CC7B04;">
            <footer class="main-footer" style="background-color: black; color: white;">
                @include('layouts.footer')
            </footer>
        </div>
    </div>
</div>



@include('profile.change_password')
@include('profile.edit_profile')

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
</script>
</html>
<style>
    body {
            background-color: #CC7B04; /* Cambia a tu color deseado */
            margin: 0; /* Elimina los márgenes predeterminados del body */
            padding: 0; /* Elimina el relleno predeterminado del body */
        }
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
</style>