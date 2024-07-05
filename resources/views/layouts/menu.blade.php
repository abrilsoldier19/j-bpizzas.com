<head>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <!--<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" integrity="sha512-wr0TGooDE2KpmzEHVIEyvLKRBdgbmLQMpI9IXXybceNEea6jPjL1FOmmEKpdWc+F4yLRA3+eqF7EdQk1UNGr0Zw==" crossorigin="anonymous" referrerpolicy="no-referrer" />-->

</head>

<li class="side-menus {{ Request::is('*') ? 'active' : '' }}" style="background-color: #FFA500;">
    <br>

    @if (Auth::user()->hasRole('Usuario') )
        <!-- User-specific menu items -->
        <a class="nav-link" href="/home" style="background-color: #FFA500;">
            <i class="fas fa-home"></i><span>Inicio</span>
        </a>
        
    @endif

    @can('Administrador-rol')
        <!-- Admin-specific menu items -->
        <a class="nav-link" href="/homeAdmin" style="background-color: #FFA500;">
            <i class="fas fa-home"></i><span>Inicio</span>
        </a>
        <a class="nav-link" href="/usuarios" style="background-color: #FFA500;">
            <i class=" fas fa-users"></i><span>Usuarios</span>
        </a>
        <a class="nav-link" href="/roles" style="background-color: #FFA500;">
            <i class=" fas fa-users"></i><span>Roles</span>
        </a>
    @endcan

        <!-- Admin and User common menu items -->
        <a class="nav-link" href="/Pizzas" style="background-color: #FFA500;">
            <i class="fas fa-pizza-slice"></i><span>Pizzas</span>
        </a>
        <a class="nav-link" href="/Pizzas" style="background-color: #FFA500;">
            <i class=" fas fa-cheese"></i><span>Complementos</span>
        </a>
        <a class="nav-link" href="/Productos" style="background-color: #FFA500;">
            <i class=" fas fa-search-dollar"></i><span>Promociones</span>
        </a>
        <a class="nav-link" href="/Postres" style="background-color: #FFA500;">
            <i class=" fas fa-ice-cream"></i><span>Postres</span>
        </a>
        <a class="nav-link" href="/Bebidas" style="background-color: #FFA500;">
            <i class=" fas fa-glass-whiskey"></i><span>Bebidas</span>
        </a>
        @can('Administrador-rol')
       
        <a class="nav-link" href="{{route ('Pizzas.misProductos')}}" style="background-color: #FFA500;">
            <i class=" fas fa-glass-whiskey"></i><span>Mis productos</span>
        </a>
        <a class="nav-link" href="{{route ('Pedidos.pizzas')}}" style="background-color: #FFA500;">
            <i class=" fas fa-shopping-cart"></i><span>Compras del cliente pizzas</span>
        </a>
        <a class="nav-link" href="{{route ('Pedidos.compra')}}" style="background-color: #FFA500;">
            <i class=" fas fa-shopping-cart"></i><span>Compras del cliente</span>
        </a>
        <a class="nav-link" href="{{route ('Pedidos.bebidas')}}" style="background-color: #FFA500;">
            <i class=" fas fa-shopping-cart"></i><span>Compras del cliente bebidas</span>
        </a>
        <a class="nav-link" href="{{route ('Pedidos.postres')}}" style="background-color: #FFA500;">
            <i class=" fas fa-shopping-cart"></i><span>Compras del cliente postres</span>
        </a>
        @endcan
        @if (Auth::user()->hasRole('Usuario') )
        <a class="nav-link" href="{{route ('Pedidos.compra')}}" style="background-color: #FFA500;">
            <i class=" fas fa-shopping-cart"></i><span>Mis compras</span>
        </a>
        @endif
        <a class="nav-link" href="{{route ('perfil.index')}}" style="background-color: #FFA500;">
            <i class="fa fa-user-circle	"></i><span>Mis perfil</span>
        </a>
        
</li>




<style>
        .side-menus {
            list-style-type: none;
            margin: 0;
            padding: 0;
            font-family: 'Century Gothic', sans-serif;
            color: black;
            background-color: #FFA500;
        }
        .side-menus span{
            
            font-family: 'Century Gothic', sans-serif;
            color: black;
            background-color: #FFA500;
        }

        .side-menus a {
            display: block;
            padding: 10px;
            text-decoration: none;
            background-color: #FFA500;
            color: black; /* Cambia el color del texto aquí */
        }

        .side-menus i {
            margin-right: 10px;
            color: black; /* Espaciado entre el ícono y el texto */
            background-color: #FFA500;
        }

        .side-menus a:hover {
            background-color: #FFA500; /* Cambia el color de fondo al pasar el ratón */
            color: #007bff; /* Cambia el color del texto al pasar el ratón */
        }

        .side-menus li{
            background-color: #FFA500;
        }
    </style>