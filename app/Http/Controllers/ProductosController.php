<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\Pedido;
use Illuminate\Support\Facades\DB;
use App\Models\ProductoBebida;
use App\Models\Postre;
use App\Models\Bebida;
use App\Models\ProductoPostre;
use App\Models\Usuario;
use App\Models\Pizzeria;
use App\Models\Carrito;
use App\Models\ProductoPizzas;

use Illuminate\Support\Facades\Auth;
use Spatie\Permission\Models\Permission;
use Illuminate\Pagination\LengthAwarePaginator;

class ProductosController extends Controller
{


    public function index(Request $request) {
        $user = Auth::user();
    
        $pizzas = Pizzeria::all();
        $bebidas = Bebida::all();
        $postres = Postre::all(); 
        $fechaActual = now();
    
        return view('Productos.index', compact('pizzas','bebidas', 'postres'));
    }





    public function carrito(Request $request)
{
    $carritoItems = Carrito::where('id_usuario', Auth::id())->get();
    $pizzas = Pizzeria::all();
    $bebidas = Bebida::all();
    $postres = Postre::all(); // Obtén el ID desde la solicitud, o de donde sea necesario
    return view('Pedidos.carrito', compact('pizzas','bebidas', 'postres', 'carritoItems'));
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




public function agregarCarrito(Request $request)
{
    $user = Auth::user();

    // Procesa los datos recibidos del formulario
    if ($request->has('check_pizza')) {
        foreach ($request->input('check_pizza') as $pizzaId) {
            $producto = Pizzeria::find($pizzaId);

            Carrito::create([
                'nombre_producto' => $producto->nombre_pizza,
                'precio_producto' => $producto->precio_pizza,
                'cantidad_producto' => $request->input('cantidad_comprada_pizza.' . $pizzaId, 1),
                'imagen_producto' => $producto->imagen_pizza,
                'id_usuario' => $user->id,
            ]);
        }
    }

    // Handle bebidas
    if ($request->has('check_bebida')) {
        foreach ($request->input('check_bebida') as $bebidaId) {
            $bebida = Bebida::find($bebidaId);

            Carrito::create([
                'nombre_producto' => $bebida->nombre_bebida,
                'precio_producto' => $bebida->bebida_precio,
                'cantidad_producto' => $request->input('cantidad_comprada_bebida.' . $bebidaId, 1),
                'imagen_producto' => $bebida->bebida_imagen,
                'id_usuario' => $user->id,
            ]);
        }
    }

    // Handle postres
    if ($request->has('check_postre')) {
        foreach ($request->input('check_postre') as $postreId) {
            $postre = Postre::find($postreId);

            Carrito::create([
                'nombre_producto' => $postre->nombre_postre,
                'precio_producto' => $postre->postre_precio,
                'cantidad_producto' => $request->input('cantidad_comprada_postre.' . $postreId, 1),
                'imagen_producto' => $postre->postre_imagen,
                'id_usuario' => $user->id,
            ]);
        }
    }

    return redirect()->route('Productos.index')->with('success', 'Producto añadido al carrito exitosamente!');
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
