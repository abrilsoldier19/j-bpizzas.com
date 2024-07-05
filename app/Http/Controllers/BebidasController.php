<?php

namespace App\Http\Controllers;

use App\Models\ProductoBebida;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\Bebida;
use App\Models\Usuario;
use App\Models\Carrito;

use Illuminate\Support\Facades\Auth;
use Spatie\Permission\Models\Permission;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\DB;

class BebidasController extends Controller
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


    return view('Bebidas.crear', compact('permission', 'currentUser', 'usuarios'));
    }


    public function store(Request $request)
{
     
    $request->validate([
        'file' => 'required|image|mimes:jpeg,png,jpg|max:2048',
    ]);

    $file = $request->file('file');
    $fileName = $file->getClientOriginalName();
    $filePath = $file->storeAs('', $fileName, 'public');

    Bebida::create([
        'nombre_bebida' => $request->nombre_bebida,
        'bebida_imagen' => $filePath ,
        'bebida_precio' => $request->bebida_precio,
        'vendido' => "0",
        'id_usuario' => Auth::user()->id,
    ]);

    return redirect()->route('Bebidas.index')->with('success', 'bebidas publicado exitosamente.');
}



    public function show($id)
    {
    }

    public function index(Request $request)
{
    $user = Auth::user();
    $query = Bebida::query();
    $bebida_precio = $request->input('bebida_precio');

    if ($request->filled('nombre_bebida')) {
        $query->where('nombre_bebida', 'LIKE', '%' . $request->input('nombre_bebida') . '%');
    }

    if ($bebida_precio == 'below_70') {
        $query->where('bebida_precio', '<', 70);
    } elseif ($bebida_precio == 'above_70') {
        $query->where('bebida_precio', '>', 70);
    }

    if ($request->filled('min_price') && $request->filled('max_price')) {
        $minPrice = $request->input('min_price');
        $maxPrice = $request->input('max_price');
        $query->whereBetween('bebida_precio', [$minPrice, $maxPrice]);
    }

    $min_price = 10;
    $max_price = 100;

    if ($request->ajax()) {
        return response()->json([
            $bebidas= view('Bebidas.index', compact('bebidas'))->render(),
            'pagination' => $bebidas->links()->toHtml(),
        ]);
    }

    $bebidas = $query->simplePaginate(5);
    $totalProductos = $query->count();

    return view('Bebidas.index', compact('bebidas', 'min_price', 'max_price', 'totalProductos'));
}


    public function more_data(Request $request){
        if($request->ajax()){
            $skip=$request->skip;
            $take=6;
            $bebidas=Bebida::skip($skip)->take($take)->get();
            return response()->json($bebidas);
        }else{
            return response()->json('Direct Access Not Allowed!!');
        }
    }


    public function edit( $id)
    {
        $bebidas = Bebida::find($id);
        return view('Bebidas.editar', compact('bebidas'));
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
        'nombre_bebida' => 'required',
        'bebida_precio' => 'required', // Use 'sometimes' to make file optional
    ]);

    // Find the existing Pizzeria record by ID
        $file = $request->file('file');
        $fileName = $file->getClientOriginalName();
        $filePath = $file->storeAs('',$fileName, 'public');

        
    
        $bebidas =Bebida::find($request->id);
        $bebidas->nombre_bebida = $request->input('nombre_bebida');
        $bebidas->bebida_precio = $request->input('bebida_precio');
        $bebidas->bebida_imagen = $filePath;
        $bebidas->save();

        if (!$bebidas){
            abort(404);
        }
    
        return redirect()->route('Bebidas.index')->with('success', 'Producto actualizado exitosamente.');

}

public function carrito(Request $request)
{
    return view('Bebidas.carrito');
}

public function comprar($id, Request $request)
{
    $bebida = Bebida::find($id);

    $quantity = $request->input('quantity', 0);

    // Create a new Pedido record for each item added to the cart
    ProductoBebida::create([
        'id_bebida' => $bebida->id,
        'id_comprador' => Auth::user()->id,
        'cantidad_comprada' => $quantity,
    ]);

    $carrito = session()->get('carrito', []);

    if (isset($carrito[$id])) {
        $carrito[$id]['quantity'] += $quantity;
    } else {
        $carrito[$id] = [
            "nombre_bebida" => $bebida->nombre_bebida,
            "bebida_imagen" => $bebida->bebida_imagen,
            "bebida_precio" => $bebida->bebida_precio,
            "quantity" => $quantity
        ];
    }

    session()->put('carrito', $carrito);

    $bebida->update([
        'vendido' => true,
    ]);



    return redirect()->route('Bebidas.index')->with('success', 'La bebida a sido comprado exitosamente');
}




public function agregarCarrito($id, Request $request)
{
    $bebida = Bebida::find($id);

    $quantity = $request->input('quantity', 0);

    $carrito = new Carrito;
    $carrito->nombre_producto = $bebida->nombre_bebida; // Cambia esto según el tipo de producto
    $carrito->precio_producto = $bebida->bebida_precio; // Cambia esto según el tipo de producto
    $carrito->cantidad_producto = $quantity;
    $carrito->imagen_producto = $bebida->bebida_imagen; // Cambia esto según el tipo de producto
    $carrito->id_usuario = auth()->user()->id; // Cambia esto según cómo obtienes el ID del usuario actual
    $carrito->save();

    // Create a new Pedido record for each item added to the cart
    ProductoBebida::create([
        'id_bebida' => $bebida->id,
        'id_comprador' => Auth::user()->id,
        'cantidad_comprada' => $quantity,
    ]);

    $carritoSesion = session()->get('carrito', []);

    if (isset($carritoSesion[$id])) {
        $carritoSesion[$id]['quantity'] += $quantity;
    } else {
        $carritoSesion[$id] = [
            "nombre_bebida" => $bebida->nombre_bebida,
            "bebida_imagen" => $bebida->bebida_imagen,
            "bebida_precio" => $bebida->bebida_precio,
            "quantity" => $quantity
        ];
    }

    session()->put('carrito', $carritoSesion);


    return redirect()->route('Bebidas.index')->with('success', 'La bebida a sido agregado exitosamente');
}
 

public function updateCart(Request $request)
{
    if ($request->id && $request->quantity) {
        // Update the session cart
        $carrito = session()->get('carrito');
        $carrito[$request->id]["quantity"] = $request->quantity;
        session()->put('carrito', $carrito);

        // Update the database (assuming you have a Pizzeria model)
        $pedido =Bebida::findOrFail($request->id);
        $pedido->update(['quantity' => $request->quantity]);

        // Update the Pedidos table (assuming you have a Pedido model)
        // Assuming you have a relation between Pedido and Pizzeria models
        $pedido = ProductoBebida::where('id_bebida', $request->id)->first();
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
        $bebidas =Bebida::findOrFail($id);

        return Storage::disk('public')->download($bebidas->bebida_imagen);
    }
    public function destroy($id)
    {
        $bebidas =Bebida::findOrFail($id);
        $bebidas->delete();

        return redirect()->route('Bebidas.index')->with('success', 'Bebidas eliminada exitosamente.');
    }



// PizzasController.php
public function activate($id)
{
    $bebidas =Bebida::findOrFail($id);

    if ($bebidas->id_usuario != Auth::user()->id) {
        return back()->with('error', "You don't have permission to activate/sell this pizza");
    }

    $bebidas->update([
        'vendido' => false, // Cambia el estado actual (Active/Sold)
    ]);

    return back()->with('success', 'Bebidas status updated successfully');
}

}
