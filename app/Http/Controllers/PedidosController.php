<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\Pedido;
use App\Models\ProductoBebida;
use App\Models\Postre;
use App\Models\Bebida;
use App\Models\ProductoPostre;
use App\Models\Usuario;
use App\Models\Pizzeria;
use App\Models\Carrito;
use App\Models\Order;
use App\Models\ProductoPizzas;

use Illuminate\Support\Facades\Auth;
use Spatie\Permission\Models\Permission;
use Illuminate\Pagination\LengthAwarePaginator;

class PedidosController extends Controller
{


    public function compra(Request $request) {
        $user = Auth::user();
        $pedidos = Order::query();
        $permission = Permission::get();
    
        if ($user->hasRole('Administrador')) {
            // If the user is a regular user, show only their orders
            $pedidos = Order::paginate(5);
        } else {
            $pedidos = Order::where('id_usuario', auth()->user()->id)->paginate(5);          
        }
        $orders = Pedido::all();

    
        $vendedor = Usuario::all();
        $detalle = Pizzeria::all();
        $fechaActual = now();
        
    
        return view('Pedidos.compra', compact('orders','pedidos', 'vendedor', 'detalle', 'fechaActual'));
    }

    public function pizzas(Request $request) {
        $user = Auth::user();
    
        if ($user->hasRole('Usuario')) {
            // If the user is a regular user, show only their orders
            $pizzas = ProductoPizzas::where('id_comprador', $user->id)
                ->join('pizzeria', 'producto_pizzas.id_producto', '=', 'pizzeria.id')
                ->join('usuarios', 'producto_pizzas.id_comprador', '=', 'usuarios.id')
                ->paginate(5, ['producto_pizzas.*', 'pizzeria.nombre_pizza', 'pizzeria.precio_pizza', 'pizzeria.imagen_pizza', 'usuarios.name', 'usuarios.email']);
        } else {
            // If the user is an administrator, show all orders
            $pizzas = ProductoPizzas::join('pizzeria', 'producto_pizzas.id_producto', '=', 'pizzeria.id')
                ->join('usuarios', 'producto_pizzas.id_comprador', '=', 'usuarios.id')
                ->paginate(5, ['producto_pizzas.*', 'pizzeria.nombre_pizza', 'pizzeria.precio_pizza', 'pizzeria.imagen_pizza', 'usuarios.name', 'usuarios.email']);
        }
    
        $vendedor = Usuario::all();
        $detalle = Pizzeria::all();
        $fechaActual = now();
    
        return view('Pedidos.pizzas', compact('pizzas', 'vendedor', 'detalle', 'fechaActual'));
    }

    public function postres(Request $request) {
        $user = Auth::user();
    
        if ($user->hasRole('Usuario')) {
            // If the user is a regular user, show only their orders
            $postres = ProductoPostre::where('id_comprador', $user->id)
                ->join('postres', 'producto_postres.id_postre', '=', 'postres.id')
                ->join('usuarios', 'producto_postres.id_comprador', '=', 'usuarios.id')
                ->paginate(5, ['producto_postres.*', 'postres.nombre_postre', 'postres.postre_precio', 'postres.postre_imagen', 'usuarios.name', 'usuarios.email']);
        } else {
            // If the user is an administrator, show all orders
            $postres = ProductoPostre::join('postres', 'producto_postres.id_postre', '=', 'postres.id')
                ->join('usuarios', 'producto_postres.id_comprador', '=', 'usuarios.id')
                ->paginate(5, ['producto_postres.*', 'postres.nombre_postre', 'postres.postre_precio', 'postres.postre_imagen', 'usuarios.name', 'usuarios.email']);
        }
    
        $vendedor = Usuario::all();
        $detalle =Postre::all();
        $fechaActual = now();
    
        return view('Pedidos.postres', compact('postres', 'vendedor', 'detalle', 'fechaActual'));
    }

    public function bebidas(Request $request) {
        $user = Auth::user();
    
        if ($user->hasRole('Usuario')) {
            // If the user is a regular user, show only their orders
            $bebidas = ProductoBebida::where('id_comprador', $user->id)
                ->join('bebidas', 'producto_bebidas.id_bebida', '=', 'bebidas.id')
                ->join('usuarios', 'producto_bebidas.id_comprador', '=', 'usuarios.id')
                ->paginate(7, ['producto_bebidas.*', 'bebidas.nombre_bebida', 'bebidas.bebida_precio', 'bebidas.bebida_imagen', 'usuarios.name', 'usuarios.email']);
        } else {
            // If the user is an administrator, show all orders
            $bebidas = ProductoBebida::join('bebidas', 'producto_bebidas.id_bebida', '=', 'bebidas.id')
                ->join('usuarios', 'producto_bebidas.id_comprador', '=', 'usuarios.id')
                ->paginate(5, ['producto_bebidas.*', 'bebidas.nombre_bebida', 'bebidas.bebida_precio', 'bebidas.bebida_imagen', 'usuarios.name', 'usuarios.email']);
        }
    
        $vendedor = Usuario::all();
        $detalle =Bebida::all();
        $fechaActual = now();
    
        return view('Pedidos.bebidas', compact('bebidas', 'vendedor', 'detalle', 'fechaActual'));
    }
    

    public function destroy($id)
{
    $pedido = ProductoPizzas::findOrFail($id);
    // Eliminar el pedido
    $pedido->delete();

    return redirect()->route('Pedidos.compra')->with('success', 'Pedido eliminado exitosamente.');
}

public function deleteFromCart($id)
{
    $pedido = Carrito::findOrFail($id);
    // Eliminar el pedido
    $pedido->delete();

    return redirect()->route('Pedidos.carrito')->with('success', 'Pedido eliminado exitosamente.');
}



public function eliminarPostres($id)
{
    $postre = ProductoPostre::findOrFail($id);
    // Eliminar el postre
    $postre->delete();

    return redirect()->route('Pedidos.compra')->with('success', 'postre eliminado exitosamente.');
}

public function eliminarBebidas($id)
{
    $bebida = ProductoBebida::findOrFail($id);
    // Eliminar el bebida
    $bebida->delete();

    return redirect()->route('Pedidos.compra')->with('success', 'bebida eliminado exitosamente.');
}

    public function show($id)
    {
        $pedidos = Pedido::find($id);
        return view('Pedidos.compra', compact('pedidos'));
    }

    public function carrito(Request $request)
{
    $carritoItems = Carrito::where('id_usuario', Auth::id())->get();
    $productos = Pizzeria::all();
    $bebidas = Bebida::all();
    $postres = Postre::all(); // Obtén el ID desde la solicitud, o de donde sea necesario
    return view('Pedidos.carrito', compact('productos','bebidas', 'postres', 'carritoItems'));
}


public function comprar(Request $request) {
    $request->validate([
        'check_pizza' => 'required|array',
        'cantidad_comprada_pizza' => 'required',
        'check_bebida' => 'required|array',
        'cantidad_comprada_bebida' => 'required',
        'check_postre' => 'required|array',
        'cantidad_comprada_postre' => 'required',
    ]);

    $id_comprador = Auth::user()->id;

    foreach ($request->check_pizza as $key => $value) {
        $pedido = new Pedido;
    $pedido->id_producto = $value;
    $pedido->id_bebida = $request->check_bebida[$key];
    $pedido->id_postre = $request->check_postre[$key];
    $pedido->id_comprador = $id_comprador;
    $pedido->cantidad_comprada_pizza = $request->cantidad_comprada_pizza[$value];
    $pedido->cantidad_comprada_bebida = $request->cantidad_comprada_bebida[$request->check_bebida[$key]];
    $pedido->cantidad_comprada_postre = $request->cantidad_comprada_postre[$request->check_postre[$key]];
    $pedido->save();
    }

    session()->forget('carrito');


    return redirect()->back()->with('success', 'Pedidos realizados con éxito');
}


public function checkout(Request $request) {
    $carritoItems = $request->productos;
    $pedidos = Carrito::where('id_usuario', auth()->user()->id)->get();
    return view('Pedidos.checkout', compact('pedidos','carritoItems'));
}

public function procesarCompra(Request $request) {
    $name = $request->input('nombre_usuario');
    $email = $request->input('email');
    $phone = $request->input('telefono');
    $address = $request->input('direccion');
    $pmode = $request->input('metodo_pago');
    $amount_paid = $request->input('total_pago');
    
    // Crear un nuevo registro en la tabla de pedidos
    $order = new Order;
    $order->id_usuario = Auth::id();
    $order->nombre_usuario = $name;
    $order->email = $email;
    $order->telefono = $phone;
    $order->direccion = $address;
    $order->metodo_pago = $pmode;
    $order->total_pago = $amount_paid;

    // Obtener los productos del carrito
    $carritoItems = Carrito::where('id_usuario', Auth::id())->get();

    // Construir la cadena de productos para almacenar en la orden
    $productos = '';
    $cantidad_productos = 0;
    foreach ($carritoItems as $producto) {
        // Concatenar el nombre del producto
        $productos .= $producto->nombre_producto . ', ';
        // Concatenar la cantidad del producto
        $cantidad_productos += $producto->cantidad_producto . ', ';
        // Concatenar la imagen del producto
        $order->imagen_producto .= $producto->imagen_producto . ', ';
    }
    $order->productos = rtrim($productos, ', '); // Eliminar la última coma y espacio
    $order->cantidad_productos = rtrim($cantidad_productos, ', ');

    // Guardar la orden
    $order->save();

    // Eliminar los productos del carrito
    Carrito::where('id_usuario', Auth::id())->delete();

    // Redireccionar a la página de confirmación u otra página
    return redirect()->route('Pedidos.checkout')->with('success', 'Compra realizada correctamente.');
}



public function updateCart(Request $request)
{

    if($request->id and $request->cantidad_producto)
        {
            $carrito = session()->get('carrito');
            $carrito[$request->id]["cantidad_producto"] = $request->cantidad_producto;
            session()->put('carrito', $carrito);

            $producto = Carrito::findOrFail($request->id);
        $producto->cantidad_producto = $request->cantidad_producto;
        $producto->save();
            session()->flash('success', 'carrito updated successfully');
        }
}
}
