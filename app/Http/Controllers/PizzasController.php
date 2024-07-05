<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
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
    ]);

    $file = $request->file('file');
    $fileName = $file->getClientOriginalName();
    $filePath = $file->storeAs('', $fileName, 'public');

    Pizzeria::create([
        'nombre_pizza' => $request->nombre_pizza,
        'imagen_pizza' => $filePath ,
        'precio_pizza' => $request->precio_pizza,
        'vendido' => "0",
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


public function more_data(Request $request){
    if($request->ajax()){
        $skip=$request->skip;
        $take=6;
        $pizzas=Pizzeria::skip($skip)->take($take)->get();
        return response()->json($pizzas);
    }else{
        return response()->json('Direct Access Not Allowed!!');
    }
}

    public function edit($id)
    {
        $pizzas = Pizzeria::find($id);
        return view('Pizzas.editar', compact('pizzas'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
{
    $request->validate([
        'file' => 'sometimes|required|mimes:png,jpg|max:2048',
        'nombre_pizza' => 'required',
        'precio_pizza' => 'required', // Use 'sometimes' to make file optional
    ]);

    // Find the existing Pizzeria record by ID
        $file = $request->file('file');
        $fileName = $file->getClientOriginalName();
        $filePath = $file->storeAs('',$fileName, 'public');

        
    
        $pizzas = Pizzeria::find($request->id);
        $pizzas->nombre_pizza = $request->input('nombre_pizza');
        $pizzas->precio_pizza = $request->input('precio_pizza');
        $pizzas->imagen_pizza = $filePath;
        $pizzas->save();

        if (!$pizzas){
            abort(404);
        }
    
        return back()->with('success', 'Producto actualizado exitosamente.');

}

public function carrito(Request $request)
{return view('Pizzas.carrito');
}


public function comprar($id, Request $request) {
    

    $producto = Pizzeria::find($id);

    $quantity = $request->input('quantity', 0);

    $carrito = new Carrito;
    $carrito->nombre_producto = $producto->nombre_pizza; // Cambia esto según el tipo de producto
    $carrito->precio_producto = $producto->precio_pizza; // Cambia esto según el tipo de producto
    $carrito->cantidad_producto = $quantity;
    $carrito->imagen_producto = $producto->imagen_pizza; // Cambia esto según el tipo de producto
    $carrito->id_usuario = auth()->user()->id; // Cambia esto según cómo obtienes el ID del usuario actual
    $carrito->save();

    ProductoPizzas::create([
        'id_producto' => $producto->id,
        'id_comprador' => Auth::user()->id,
        'cantidad_comprada' => $quantity,
    ]);


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



    return redirect()->back()->with('success', 'La pizza a sido comprado exitosament');
} 

public function misProductos(){
    $pizzas = Pizzeria::where('id_usuario', Auth::user()->id)->orderBy('vendido', 'asc')->paginate(4);
    $bebidas =Bebida::where('id_usuario', Auth::user()->id)->orderBy('vendido', 'asc')->paginate(4);
    $postres =Postre::where('id_usuario', Auth::user()->id)->orderBy('vendido', 'asc')->paginate(4);

    
    return view('Pizzas.mi', compact('pizzas', 'bebidas', 'postres'));
}



public function agregarCarrito($id,  Request $request)
{
    $producto = Pizzeria::find($id);

    $quantity = $request->input('quantity', 0);

    $carrito = new Carrito;
    $carrito->nombre_producto = $producto->nombre_pizza; // Cambia esto según el tipo de producto
    $carrito->precio_producto = $producto->precio_pizza; // Cambia esto según el tipo de producto
    $carrito->cantidad_producto = $quantity;
    $carrito->imagen_producto = $producto->imagen_pizza; // Cambia esto según el tipo de producto
    $carrito->id_usuario = auth()->user()->id; // Cambia esto según cómo obtienes el ID del usuario actual
    $carrito->save();

    ProductoPizzas::create([
        'id_producto' => $producto->id,
        'id_comprador' => Auth::user()->id,
        'cantidad_comprada' => $quantity,
    ]);


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


    return redirect()->route('Pizzas.index')->with('success', 'Producto añadido al carrito exitosamente!');
}


public function updateCart(Request $request)
{
    if ($request->id && $request->quantity) {
        // Update the session cart
        $carrito = session()->get('carrito');
        $carrito[$request->id]["quantity"] = $request->quantity;
        session()->put('carrito', $carrito);

        // Update the database (assuming you have a Pizzeria model)
        $pizza = Pizzeria::findOrFail($request->id);
        $pizza->update(['quantity' => $request->quantity]);

        // Update the Pedidos table (assuming you have a Pedido model)
        // Assuming you have a relation between Pedido and Pizzeria models
        $pedido = ProductoPizzas::where('id_producto', $request->id)->first();
        if ($pedido) {
            $pedido->update(['cantidad_comprada' => $request->quantity]);
        }

        session()->flash('success', 'Actualizado.');
    }
}

    public function remove(Request $request)
    {
        if($request->id) {
            $carrito = session()->get('carrito');
            if(isset($carrito[$request->id])) {
                unset($carrito[$request->id]);
                session()->put('carrito', $carrito);
            }
            session()->flash('success', 'Product successfully removed!');
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
