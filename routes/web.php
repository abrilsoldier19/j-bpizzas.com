<?php

use App\Http\Controllers\procesarController;
use Illuminate\Support\Facades\Route;

//agregamos los siguientes controladores
use App\Http\Controllers\HomeController;
use App\Http\Controllers\StripeController;
use App\Http\Controllers\RolController;
use App\Http\Controllers\UsuarioController;
use App\Http\Controllers\BebidasController;
use App\Http\Controllers\PostresController;
use App\Http\Controllers\PedidosController;
use App\Http\Controllers\ProductosController;
use App\Http\Controllers\PizzasController;
use App\Http\Controllers\PerfilController;
use App\Http\Controllers\auth\RegisterController;
use App\Http\Controllers\Auth\LoginController;

/*
|--------------------------------------------------------------------------
<?php

use App\Http\Controllers\AlumnoReprobadoController;
use Illuminate\Support\Facades\Route;

//agregamos los siguientes controladores
use App\Http\Controllers\HomeController;
use App\Http\Controllers\homeAlumnoController;
use App\Http\Controllers\homeAdminController;
use App\Http\Controllers\RolController;
use App\Http\Controllers\UsuarioController;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\CalificacionController;
use App\Http\Controllers\CarreraController;
use App\Http\Controllers\MateriaController;
use App\Http\Controllers\SemestreController;
use App\Http\Controllers\MaestroController;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () 
{
    $user = Auth::user();
    if (Auth::check())
        if ($user->esAdmin())
            echo "Eres usuario administrador.";
        else
            echo "Eres estudiante.";
        
    return view('/auth/vista');
});



Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/procesar', [App\Http\Controllers\procesarController::class, 'index'])->name('procesar');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home.index');

//Vista de home alumnos
Route::get('/homeAlumno', [App\Http\Controllers\homeAlumnoController::class, 'index'])->name('homeAlumno.index');

Route::get('/homeAdmin', [App\Http\Controllers\homeAdminController::class, 'index'])->name('homeAdmin.index');

//y creamos un grupo de rutas protegidas para los controladores
Route::group(['middleware' => ['auth']], function() {

    Route::resource('usuarios', UsuarioController::class);
    //Route::get('/usuarios/{id}/edit', [UsuarioController::class, 'cambiarPassword'])->name('usuarios.cambiarPassword');
    //Route::put('/usuarios/{id}/update', [UsuarioController::class, 'actualizarPassword'])->name('usuarios.actualizarPassword');
    Route::get('usuarios/editarPassword/{usuario}', [UsuarioController::class, 'editarPassword'])->name('usuarios.editarPassword');
    Route::put('usuarios/actualizarPassword/{usuario}', [UsuarioController::class, 'actualizarPassword'])->name('usuarios.actualizarPassword');


    //ruta register
    Route::resource('auth',RegisterController::class);
    Route::get('/auth/create',[ RegisterController::class, 'create'])->name('auth.create');
    Route::post('/auth/procesar',[ RegisterController::class, 'procesar'])->name('auth.procesar');
    


         //ruta de productos
     Route::resource('Pedidos', PedidosController::class);
     //Route::post('/Pedidos/upload', [PedidosController::class, 'upload'])->name('Pedidos.upload');
     Route::post('/Pedidos/create', [PedidosController::class, 'create'])->name('Pedidos.create');
     Route::post('/Pedidos/store',[ PedidosController::class, 'store'])->name('Pedidos.store');
     Route::get('/Pedidos/{id}/show', [PedidosController::class, 'show'])->name('Pedidos.show');
    // Route::get('/Pedidos/edit', [PedidosController::class, 'edit'])->name('Pedidos.edit');
    Route::put('/Pedidos/update', [PedidosController::class, 'update'])->name('Pedidos.update');
     Route::get('/Pedidos/{id}/descargar', [PedidosController::class, 'descargar'])->name('Pedidos.descargar');
     Route::delete('/Pedidos/{id}', [PedidosController::class, 'destroy'])->name('Pedidos.destroy');
     Route::patch('/update-cart', [PedidosController::class, 'updateCart'])->name('update_cart');
     Route::delete('/Pedidos/{id}/deleteFromCart', [PedidosController::class, 'deleteFromCart'])->name('Pedidos.deleteFromCart');
     Route::delete('/Pedidos/{id}/eliminarPostres', [PedidosController::class, 'eliminarPostres'])->name('Pedidos.eliminarPostres');
     Route::delete('/Pedidos/{id}/eliminarBebidas', [PedidosController::class, 'eliminarBebidas'])->name('Pedidos.eliminarBebidas');
     Route::get('/Pedido-carrito', [PedidosController::class, 'carrito'])->name('Pedidos.carrito');
     Route::get('compra', [PedidosController::class, 'compra'])->name('Pedidos.compra');
     Route::get('/checkout', [PedidosController::class, 'checkout'])->name('Pedidos.checkout');
     Route::post('/Pedidos/comprar', [PedidosController::class, 'comprar'])->name('Pedidos.comprar');
     Route::post('/Pedidos/procesarCompra', [PedidosController::class, 'procesarCompra'])->name('Pedidos.procesarCompra');
     Route::get('pizzas', [PedidosController::class, 'pizzas'])->name('Pedidos.pizzas');
     Route::get('postres', [PedidosController::class, 'postres'])->name('Pedidos.postres');
     Route::get('bebidas', [PedidosController::class, 'bebidas'])->name('Pedidos.bebidas');
   


     //ruta de pedidos
     Route::resource('Productos', ProductosController::class);
     Route::post('/Productos/agregar-Carrito', [ProductosController::class, 'agregarCarrito'])->name('Productos.agregarCarrito');
    



//ruta de pizzas
     Route::resource('Pizzas', PizzasController::class);
     //Route::get('/index', [PizzasController::class, 'index'])->name('Pizzas.index');
     Route::get('/more_data', [PizzasController::class, 'more_data'])->name('Pizzas.more_data');
     Route::get('/Pizzas/{id}/edit', [PizzasController::class, 'edit'])->name('Pizzas.edit');
     Route::post('/Pizzas/create', [PizzasController::class, 'create'])->name('Pizzas.create');
     Route::post('/Pizzas/procesar', [PizzasController::class, 'procesar'])->name('Pizzas.procesar');
     Route::post('/Pizzas/store',[ PizzasController::class, 'store'])->name('Pizzas.store');
     Route::get('/Pizzas/{id}/show', [PizzasController::class, 'show'])->name('Pizzas.show');
    Route::put('/Pizzas/{id}/update', [PizzasController::class, 'update'])->name('Pizzas.update');
     Route::get('/Pizzas/{id}/descargar', [PizzasController::class, 'descargar'])->name('Pizzas.descargar');
     Route::delete('/Pizzas/{id}', [PizzasController::class, 'destroy'])->name('Pizzas.destroy');
     Route::patch('/update-shopping-cart', [PizzasController::class, 'updateCart'])->name('update_cart');
     Route::get('/Pizza-carrito', [PizzasController::class, 'carrito'])->name('Pizzas.carrito');
     Route::post('/Pizzas/agregar-Carrito/{id}', [PizzasController::class, 'agregarCarrito'])->name('Pizzas.agregarCarrito');  
    Route::delete('delete-from-cart', [PizzasController::class, 'remove'])->name('delete.cart.product');
    Route::put('/Pizzas/comprar/{id}', [PizzasController::class, 'comprar'])->name('Pizzas.comprar');
    Route::get('misProductos', [PizzasController::class, 'misProductos'])->name('Pizzas.misProductos');
    Route::put('/Pizzas/{id}/activate', [PizzasController::class, 'activate'])->name('Pizzas.activate');

    //ruta de bebidas
    Route::resource('Bebidas', BebidasController::class);
    Route::get('Bebidas', [BebidasController::class, 'index'])->name('Bebidas.index');
    Route::get('/Bebidas/{id}/edit', [BebidasController::class, 'edit'])->name('Bebidas.edit');
    Route::get('/more-data', [BebidasController::class, 'more_data'])->name('Bebidas.more_data');
    Route::post('/Bebidas/create', [BebidasController::class, 'create'])->name('Bebidas.create');
    Route::post('/Bebidas/procesar', [BebidasController::class, 'procesar'])->name('Bebidas.procesar');
    Route::post('/Bebidas/store',[ BebidasController::class, 'store'])->name('Bebidas.store');
    Route::get('/Bebidas/{id}/show', [BebidasController::class, 'show'])->name('Bebidas.show');
   Route::put('/Bebidas/{id}/update', [BebidasController::class, 'update'])->name('Bebidas.update');
    Route::get('/Bebidas/{id}/descargar', [BebidasController::class, 'descargar'])->name('Bebidas.descargar');
    Route::delete('/Bebidas/{id}', [BebidasController::class, 'destroy'])->name('Bebidas.destroy');
    Route::patch('/update-shopping-cart', [BebidasController::class, 'updateCart'])->name('update_cart');
    Route::get('/Bebida-carrito', [BebidasController::class, 'carrito'])->name('Bebida.carrito');
    Route::post('/Bebidas/agregar-Carrito/{id}', [BebidasController::class, 'agregarCarrito'])->name('Bebidas.agregarCarrito');  
   Route::delete('delete-from-cart', [BebidasController::class, 'remove'])->name('delete.cart.product');
   Route::put('/Bebidas/comprar/{id}', [BebidasController::class, 'comprar'])->name('Bebidas.comprar');
   
   Route::put('/Bebidas/{id}/activate', [BebidasController::class, 'activate'])->name('Bebidas.activate');
   Route::delete('delete-from-cart', [BebidasController::class, 'remove'])->name('delete.cart.product');



   //ruta de postres
   Route::resource('Postres', PostresController::class);
   //Route::get('Postres', [PostresController::class, 'index'])->name('Postres.index');
   Route::get('/Postres/{id}/edit', [PostresController::class, 'edit'])->name('Postres.edit');
   Route::get('/load-more-data', [PostresController::class, 'more_data'])->name('Postres.more_data');
   Route::get('/Postres/{id}/edit', [PostresController::class, 'edit'])->name('Postres.edit');
   Route::post('/Postres/create', [PostresController::class, 'create'])->name('Postres.create');
   Route::post('/Postres/procesar', [PostresController::class, 'procesar'])->name('Postres.procesar');
   Route::post('/Postres/store',[ PostresController::class, 'store'])->name('Postres.store');
   Route::get('/Postres/{id}/show', [PostresController::class, 'show'])->name('Postres.show');
  Route::put('/Postres/{id}/update', [PostresController::class, 'update'])->name('Postres.update');
   Route::get('/Postres/{id}/descargar', [PostresController::class, 'descargar'])->name('Postres.descargar');
   Route::delete('/Postres/{id}', [PostresController::class, 'destroy'])->name('Postres.destroy');
   Route::patch('/update-shopping-cart', [PostresController::class, 'updateCart'])->name('update_cart');
   Route::get('/Postre-carrito', [PostresController::class, 'carrito'])->name('Postre.carrito');
   Route::post('/Postres/agregar-Carrito/{id}', [PostresController::class, 'agregarCarrito'])->name('Postres.agregarCarrito');  
  Route::delete('delete-from-cart', [PostresController::class, 'remove'])->name('delete.cart.product');
  Route::put('/comprar/{id}', [PostresController::class, 'comprar'])->name('Postres.comprar');
  Route::get('/mi', [PostresController::class, 'mi'])->name('Postres.mi');
  Route::put('/Postres/{id}/activate', [PostresController::class, 'activate'])->name('Postres.activate');
  Route::delete('delete-from-cart', [PostresController::class, 'remove'])->name('delete.cart.product');


    // ruta de roles
     Route::resource('roles', RolController::class);
     Route::get('roles', [RolController::class, 'index'])->name('roles.index');
     Route::get('/roles/{id}/show', [RolController::class, 'show'])->name('roles.show');

     Route::resource('Pizzas', StripeController::class);

     Route::post('/session', [StripeController::class, 'session'])->name('session');
     Route::get('/index', [StripeController::class, 'index'])->name('index');
Route::get('/success', [StripeController::class, 'success'])->name('success');
Route::get('/cancel', [StripeController::class, 'cancel'])->name('cancel');
Route::get('/{id}/show', [StripeController::class, 'show'])->name('show');


Route::group(['prefix' => 'perfil', 'as' => 'perfil.'], function(){
    Route::get('/', [PerfilController::class, 'index'])->name('index');
    Route::get('/compra', [PerfilController::class, 'compra'])->name('compra');
});
     

});












