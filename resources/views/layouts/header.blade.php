<form class="form-inline mr-auto" action="#">
    <ul class="navbar-nav mr-3">
        <li><a href="#" data-toggle="sidebar" class="nav-link nav-link-lg"><i class="fas fa-bars"></i></a></li>
    </ul>
</form>
@if (Auth::user()->hasRole('Usuario') )
        
       <div class="dropdown">
    <button type="button" class="btn btn-primary" data-toggle="dropdown">
        <i class="fa fa-shopping-cart" aria-hidden="true"></i> Carrito de compras
        <span class="badge badge-pill badge-danger">{{ count((array) session('carrito')) }}</span>
    </button>

    <div class="dropdown-menu cart-dropdown" style="width:300px;">
    
    @php
                $carritoItems = \DB::table('carrito')->where('id_usuario', Auth::user()->id)->get();
                $total = 0;
            @endphp

            @if($carritoItems->count() > 0)
                <div class="row total-header-section mt-3" style="padding: 6px;">
                    @foreach($carritoItems as $item)
                        @php
                            $subtotal = $item->precio_producto * $item->cantidad_producto;
                            $total += $subtotal;
                        @endphp

                        <div class="row cart-detail ">
                            <div class="col-lg-4 col-sm-4 col-4 cart-detail-img">
                                <img src="{{ asset('img') }}/{{ $item->imagen_producto }}" style="max-height: 50px;"/>
                            </div>
                            <div class="col-lg-8 col-sm-8 col-8 cart-detail-product">
                                <div class="d-flex align-items-center">
                                    <span style="margin-bottom: 10px;">{{ $item->nombre_producto }}</span><br><br>
                                    <span class="price text-info ml-2"> ${{ $item->precio_producto }}</span>
                                    <span data-th="Cantidad" class="ml-2">
                                        <input type="number" data-id="{{ $item->id }}" value="{{ $item->cantidad_producto }}" class="form-control cantidad_producto update-cart" min="1" style="width: 58px;"/>
                                    </span>
                                    
                                </div>
                            </div>
                        </div>
                    @endforeach
                    <div class="col-lg-12 col-sm-12 col-12 total-section text-center">
                        <p>Total: <span class="text-info">$ {{ $total }}</span></p>
                    </div>
                </div>
            @else
    <p>No hay artículos en el carrito.</p>
@endif

        <div class="row">
            <div class="col-lg-12 col-sm-12 col-12 text-center checkout">
                <a href="{{ route('Pedidos.carrito') }}" class="btn btn-primary btn-block">Ver todo</a>
            </div>
        </div>
    </div>
</div>
@if(session('success'))
        <div class="alert alert-success">
          {{ session('success') }}
        </div> 
    @endif
 @endif
 
<ul class="navbar-nav navbar-right">

    @if(\Illuminate\Support\Facades\Auth::user())
        <li class="dropdown">
            <a href="#" data-toggle="dropdown"
               class="nav-link dropdown-toggle nav-link-lg nav-link-user">
                 <img alt="image" src="{{ asset('img/agregar-usuario.png') }}" {{-- Menu bar --}}
                     class="rounded-circle mr-1 thumbnail-rounded user-thumbnail ">
                <div class="d-sm-none d-lg-inline-block">
                     Perfil.. {{\Illuminate\Support\Facades\Auth::user()->first_name}}</div>
            </a>

            <div class="dropdown-menu dropdown-menu-right">
                <div class="dropdown-title">
                    Bienvenido, {{\Illuminate\Support\Facades\Auth::user()->name}}</div>
                <a class="dropdown-item has-icon edit-profile" data-toggle="modal" data-target="#EditProfileModal" >
                    <i class="fa fa-user"></i>Editar Perfil de Usuario</a>

                @if(Auth::user() && (Auth::user()->hasRole('Maestro') || Auth::user()->hasRole('Alumno')))
                    <a class="dropdown-item has-icon"  data-toggle="modal" data-target="#changePasswordModal" ><i
                            class="fa fa-lock"> </i>Cambiar contraseña</a>
                @endif
                <a href="{{ url('logout') }}" class="dropdown-item has-icon text-danger"
                   onclick="event.preventDefault(); localStorage.clear();  document.getElementById('logout-form').submit();">
                    <i class="fas fa-sign-out-alt"></i> Cerrar sesión...
                </a>
                <form id="logout-form" action="{{ url('/logout') }}" method="POST" class="d-none">
                    {{ csrf_field() }}
                </form>
            </div>
        </li>
    @else
        <li class="dropdown"><a href="#" data-toggle="dropdown"
                                class="nav-link dropdown-toggle nav-link-lg nav-link-user">
                {{--                <img alt="image" src="#" class="rounded-circle mr-1">--}}
                <div class="d-sm-none d-lg-inline-block">{{ __('messages.common.hello') }}</div>
            </a>
            <div class="dropdown-menu dropdown-menu-right">
                <div class="dropdown-title">{{ __('messages.common.login') }}
                    / {{ __('messages.common.register') }}</div>
                <a href="{{ route('login') }}" class="dropdown-item has-icon">
                    <i class="fas fa-sign-in-alt"></i> {{ __('messages.common.login') }}
                </a>
                <div class="dropdown-divider"></div>
                <a href="{{ route('register') }}" class="dropdown-item has-icon">
                    <i class="fas fa-user-plus"></i> {{ __('messages.common.register') }}
                </a>
            </div>
        </li>
    @endif
</ul>

<style>
    .cart-dropdown {
        max-width: 500px; /* Set a maximum width for the dropdown */
        background-color: #fff; /* Set a background color */
        padding: 10px; /* Add some padding */
        border: 1px solid #ddd; /* Add a border */
        border-radius: 5px; /* Add border-radius for rounded corners */
    }

    .cart-detail {
        margin-bottom: 10px; /* Add some margin between cart details */
    }

    /* Add more styles as needed */
</style>
@section('scripts')
<script type="text/javascript">
    $(".cart_update").change(function (e) {
        e.preventDefault();
        var ele = $(this);
        var pizzaId = ele.data("data-pizza-id");

        $.ajax({
            url: '{{ route('update_cart') }}',
            method: "patch",
            data: {
                _token: '{{ csrf_token() }}',
                id: pizzaId,
                quantity: ele.val()
            },
            success: function (response) {
                console.log(response);
                window.location.reload();
            }
        });
    });

    $(document).on('change', '.update-cart', function (e) {
    e.preventDefault();
    var ele = $(this);
    $.ajax({
        url: '{{ url('update-cart') }}',
        method: "patch",
        data: {
            _token: '{{ csrf_token() }}',
            id: ele.attr("data-id"),
            cantidad_producto: ele.val() // Use .val() to get the input value
        },
        success: function (response) {
            window.location.reload();
        }
    });
});
</script>
@endsection

