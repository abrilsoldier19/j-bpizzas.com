<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Storage;
use App\Models\Pizzeria;
use App\Models\Usuario;
use App\Models\ProductoPizzas;
use App\Models\Bebida;
use App\Models\Postre;
use App\Models\Pedido;
use App\Models\Carrito;

use Illuminate\Support\Facades\Auth;
use Spatie\Permission\Models\Permission;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\DB;
class PizzasController extends Controller
{

    public function create(Request $request)
    {
        $currentUser = $request->user();
        $permission = Permission::get();

        // Obtén los alumnos según el tipo de usuario
        if ($currentUser->hasRole('Administrador')) {
        $usuarios = Usuario::whereHas('roles', function ($query) {
            $query->where('name', 'id');
        })->get();
        } elseif ($currentUser->hasRole('Usuario')) {
            $usuarios = Usuario::whereHas('roles', function ($query) {
                $query->where('name', 'id');
            })->get();
        } else {
            $usuarios = collect([$currentUser]);
        }


    return view('Pizzas.crear', compact('permission', 'currentUser', 'usuarios'));
    }


    public function store(Request $request)
{
     
    $request->validate([
        'file' => 'required|image|mimes:jpeg,png,jpg|max:2048',
        'nombre_pizza' => 'required|string|max:255',
        'marca' => 'required|string|max:255',
        'precio_pizza' => 'required|numeric|min:0',
        'stock' => 'required|integer|min:0',
        'descripcion_pizza' => 'nullable|string|max:500',
    ]);

    $file = $request->file('file');
    $fileName = $file->getClientOriginalName();
    $filePath = $file->storeAs('', $fileName, 'public');

    Pizzeria::create([
        'nombre_pizza' => $request->nombre_pizza,
        'marca' => $request->marca,
        'imagen_pizza' => $filePath ,
        'precio_pizza' => $request->precio_pizza,
        'descripcion_pizza' => $request->descripcion_pizza,
        'vendido' => "0",
        'stock' => $request->stock,
        'id_usuario' => Auth::user()->id,
    ]);

    return redirect()->route('Pizzas.index')->with('success', 'Pizzas publicado exitosamente.');
}



    public function show($id)
    {
    }

    public function index(Request $request)
{
    $user = Auth::user();
    $query = Pizzeria::query();
    $precio_pizza = $request->input('precio_pizza');
    $min_price = 100;
    $max_price = 300;

    if ($request->filled('nombre_pizza')) {
        $query->where('nombre_pizza', 'LIKE', '%' . $request->input('nombre_pizza') . '%');
    }

     

    $precio_pizza = $request->input('precio_pizza');
    if ($precio_pizza) {
        if ($precio_pizza == 'below_200') {
            $query->where('precio_pizza', '<', 200);
        } elseif ($precio_pizza == 'above_200') {
            $query->where('precio_pizza', '>=', 200);
        }
    }


    if ($request->filled('min_price') && $request->filled('max_price')) {
        $minPrice = $request->input('min_price');
        $maxPrice = $request->input('max_price');
        $query->whereBetween('precio_pizza', [$minPrice, $maxPrice]);
    }

    if ($request->ajax()) {
        return response()->json([
            $pizzas= view('Pizzas.index', compact('pizzas'))->render(),
            'pagination' => $pizzas->links()->toHtml(),
        ]);
    }



    // Obtener las pizzas según la consulta construida
    $pizzas =  $query->simplePaginate(6);

    $vendedor = Usuario::all();
    $detalle = Pizzeria::all();
    $totalProductos = $query->count();

    return view('Pizzas.index', compact('pizzas', 'vendedor', 'detalle', 'min_price', 'max_price', 'totalProductos'));
}


public function more_data(Request $request) {
    if($request->ajax()){
        $skip = $request->skip;
        $take = 6;
        
        // Creamos la consulta base
        $query = Pizzeria::query();

        // 1. Aplicamos filtro de nombre si existe
        if ($request->filled('nombre_pizza')) {
            $query->where('nombre_pizza', 'LIKE', '%' . $request->input('nombre_pizza') . '%');
        }

        // 2. Aplicamos filtro de slider de precios si existe
        if ($request->filled('min_price') && $request->filled('max_price')) {
            $query->whereBetween('precio_pizza', [$request->input('min_price'), $request->input('max_price')]);
        }

        // 3. Traemos los datos incluyendo la relación del vendedor para que no falle el JavaScript
        $pizzas = $query->with('vendedor')->skip($skip)->take($take)->get();
        
        return response()->json($pizzas);
    } else {
        return response()->json('Direct Access Not Allowed!!', 403);
    }
}

    public function edit($id)
    {
        $pizzas = Pizzeria::find($id);
        return view('Pizzas.editar', compact('pizzas'));
    }

    public function update(Request $request, $id) // <-- Usamos este $id
    {
        $request->validate([
            'file' => 'sometimes|required|mimes:png,jpg,jpeg|max:2048',
            'nombre_pizza' => 'required',
            'precio_pizza' => 'required',
            'stock' => 'required|integer|min:0',
            'marca' => 'required|string|max:255',
            'descripcion_pizza' => 'nullable|string|max:500',
        ]);

        $file = $request->file('file');
        $fileName = $file->getClientOriginalName();
        $filePath = $file->storeAs('',$fileName, 'public');
    
        $pizzas =Pizzeria::find($request->id);
        $pizzas->nombre_pizza = $request->input('nombre_pizza');
        $pizzas->precio_pizza = $request->input('precio_pizza');
        $pizzas->stock = $request->input('stock');
        $pizzas->imagen_pizza = $filePath;
        $pizzas->marca = $request->input('marca');
        $pizzas->descripcion_pizza = $request->input('descripcion_pizza');

        $pizzas->vendido = ($pizzas->stock <= 0) ? true : false; 

        $pizzas->save();

        if (!$pizzas){
            abort(404);
        }
    
        return redirect()->route('Pizzas.index')->with('success', 'Producto actualizado exitosamente.');
    }

public function carrito(Request $request)
{
    return view('Pizzas.carrito');
}

public function misProductos()
{
    $userId = Auth::user()->id;

    // Agregamos 'setPageName' para que cada pestaña navegue de forma independiente en la URL
    $pizzas = Pizzeria::where('id_usuario', $userId)
        ->orderBy('vendido', 'asc')
        ->paginate(4, ['*'], 'pizzas_page');

    $bebidas = Bebida::where('id_usuario', $userId)
        ->orderBy('vendido', 'asc')
        ->paginate(4, ['*'], 'bebidas_page');

    $postres = Postre::where('id_usuario', $userId)
        ->orderBy('vendido', 'asc')
        ->paginate(4, ['*'], 'postres_page');

    return view('Pizzas.mi', compact('pizzas', 'bebidas', 'postres'));
}



public function agregarCarrito($id,  Request $request)
{
    $producto = Pizzeria::findOrFail($id);

    $quantity = $request->input('quantity', 1);

    if ($producto->stock < $quantity) {
        return redirect()->back()->with('error', 'Lo sentimos, solo quedan ' . $producto->stock . ' piezas disponibles.');
    }

    $carrito = new Carrito;
    $carrito->nombre_producto = $producto->nombre_pizza; // Cambia esto según el tipo de producto
    $carrito->precio_producto = $producto->precio_pizza; // Cambia esto según el tipo de producto
    $carrito->cantidad_producto = $quantity;
    $carrito->imagen_producto = $producto->imagen_pizza; // Cambia esto según el tipo de producto
    $carrito->id_usuario = auth()->user()->id; // Cambia esto según cómo obtienes el ID del usuario actual
    $carrito->save();

    $carritoSesion = session()->get('carrito', []);

    if (isset($carritoSesion[$id])) {
        $carritoSesion[$id]['quantity'] += $quantity;
    } else {
        $carritoSesion[$id] = [
            "nombre_pizza" => $producto->nombre_pizza,
            "imagen_pizza" => $producto->imagen_pizza,
            "precio_pizza" => $producto->precio_pizza,
            "quantity" => $quantity
        ];
    }

    session()->put('carrito', $carritoSesion);

    //manejo de stock
    $producto->stock -= $quantity;

    if ($producto->stock <= 0) {
        $producto->stock = 0; // marca como disponible 0 si no hay stock
        $producto->vendido = true; // Marcar como vendido si no hay stock
    }

    $producto->save();


    return redirect()->route('Pizzas.index')->with('success', 'Producto añadido al carrito exitosamente!');
}


public function updateCart(Request $request)
{
    $request->validate([
        'id' => 'required|integer',
        'quantity' => 'required|integer|min:1',
    ]);

    $userId = Auth::user()->id;
    $newQuantity = intval($request->quantity);
    $pizza = Pizzeria::findOrFail($request->id);

    $cartItem = Carrito::where('id_usuario', $userId)
        ->where('nombre_producto', $pizza->nombre_pizza)
        ->first();

    if (!$cartItem) {
        return redirect()->back()->with('error', 'Producto no encontrado en el carrito.');
    }

    $difference = $newQuantity - intval($cartItem->cantidad_producto);

    if ($difference > 0 && $pizza->stock < $difference) {
        return redirect()->back()->with('error', "Lo sentimos, solo quedan {$pizza->stock} piezas de este producto.");
    }

    $cartItem->update(['cantidad_producto' => $newQuantity]);

    session()->put("carrito.{$request->id}.quantity", $newQuantity);

    $pizza->stock -= $difference;
    $pizza->vendido = ($pizza->stock <= 0);
    $pizza->save();

        return redirect()->back()->with('success', 'Carrito actualizado con éxito.');
}


public function remove(Request $request)
{
    if ($request->id) {
        $userId = auth()->user()->id;
        
        // se busca el postre en la base de datos usando el id enviado por la vista
        $pizza = Pizzeria::findOrFail($request->id);

        // se busca el producto en el carrito del usuario
        $cartItem = Carrito::where('id_usuario', $userId)
            ->where('nombre_producto', $pizza->nombre_pizza)
            ->first();

        // se regresa el stock del postre y se marca como disponible si es que estaba agotado
        if ($cartItem) {
            $pizza->stock += $cartItem->cantidad_producto; 
            $pizza->vendido = false;                      
            $pizza->save();

            $cartItem->delete();
        }

        // se actualiza la sesión del carrito para reflejar la eliminación del producto
        $carrito = session()->get('carrito');
        if (isset($carrito[$request->id])) {
            unset($carrito[$request->id]);
            session()->put('carrito', $carrito);
        }

        session()->flash('success', '¡Producto eliminado del carrito y devuelto al inventario!');
        return redirect()->back();
    }
}
 
    public function descargar($id)
    {
        $pizzas = Pizzeria::findOrFail($id);

        return Storage::disk('public')->download($pizzas->imagen_pizza);
    }
    public function destroy($id)
    {
        $pizzas = Pizzeria::findOrFail($id);
        $pizzas->delete();

        return redirect()->route('Pizzas.index')->with('success', 'Pizzas eliminada exitosamente.');
    }



// PizzasController.php
public function activate($id)
{
    $pizzas = Pizzeria::findOrFail($id);

    if ($pizzas->id_usuario != Auth::user()->id) {
        return back()->with('error', "You don't have permission to activate/sell this pizza");
    }

    $pizzas->update([
        'vendido' => false, // Cambia el estado actual (Active/Sold)
    ]);

    return back()->with('success', 'Pizza status updated successfully');
}

}
