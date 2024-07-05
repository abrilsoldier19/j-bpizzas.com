<aside id="sidebar-wrapper">
    <div class="sidebar-brand"> <!--Barra vertical izquierda -->
        <img class="navbar-brand-full app-header-logo" src="{{ asset('img/pizza_logo.png') }}" width="240"
             alt="Infyom Logo">
        <a href="{{ url('/') }}"></a>
    </div>
    <div class="sidebar-brand sidebar-brand-sm">
        <a href="{{ url('/') }}" class="small-sidebar-text">
            <img class="navbar-brand-full" src="{{ asset('img/pizza_logo.png') }}" width="45px" alt=""/>
        </a>
    </div>
    <ul class="sidebar-menu">
        @include('layouts.menu')
    </ul>
</aside>
<style>
    .sidebar-menu aside {
        background-color: #FFA500;
    /* Agrega otros estilos según tus necesidades */
}
    </style>