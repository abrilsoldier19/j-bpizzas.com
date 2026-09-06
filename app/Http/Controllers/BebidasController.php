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
        'nombre_bebida' => 'required|string|max:255',
        'marca'=> 'required|string|max:255',
        'bebida_precio' => 'required|numeric|min:0',
        'stock' => 'required|integer|min:0',
    ]);

    $file = $request->file('file');
    $fileName = $file->getClientOriginalName();
    $filePath = $file->storeAs('', $fileName, 'public');

    Bebida::create([
        'nombre_bebida' => $request->nombre_bebida,
        'marca' => $request->marca,
        'bebida_imagen' => $filePath ,
        'bebida_precio' => $request->bebida_precio,
        'stock' => $request->stock,
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
    
    public function update(Request $request, $id)
{
    $request->validate([
        'file' => 'sometimes|required|mimes:png,jpg|max:2048',
        'nombre_bebida' => 'required',
        'bebida_precio' => 'required',
        'stock' => 'required|integer|min:0',
        'marca' => 'required|string|max:255',
    ]);

    // Find the existing Pizzeria record by ID
        $file = $request->file('file');
        $fileName = $file->getClientOriginalName();
        $filePath = $file->storeAs('',$fileName, 'public');

        
    
        $bebidas =Bebida::find($request->id);
        $bebidas->nombre_bebida = $request->input('nombre_bebida');
        $bebidas->bebida_precio = $request->input('bebida_precio');
        $bebidas->bebida_imagen = $filePath;
        $bebidas->stock = $request->input('stock');
        $bebidas->marca = $request->input('marca');

        $bebidas->vendido = ($bebidas->stock <=0) ? true : false; 

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

public function agregarCarrito($id, Request $request)
{
    $bebida = Bebida::findOrFail($id);

    $quantity = $request->input('quantity', 1);

    if ($bebida->stock < $quantity) {
        return redirect()->back()->with('error', 'Lo sentimos, solo quedan ' . $bebida->stock . ' disponibles.');
    }

    $carrito = new Carrito;
    $carrito->nombre_producto = $bebida->nombre_bebida; // Cambia esto según el tipo de producto
    $carrito->precio_producto = $bebida->bebida_precio; // Cambia esto según el tipo de producto
    $carrito->cantidad_producto = $quantity;
    $carrito->imagen_producto = $bebida->bebida_imagen; // Cambia esto según el tipo de producto
    $carrito->id_usuario = auth()->user()->id; // Cambia esto según cómo obtienes el ID del usuario actual
    $carrito->save();

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

    $bebida->stock -= $quantity;
    if ($bebida->stock <= 0) {
        $bebida->stock = 0;
        $bebida->vendido = true;
    }

    $bebida->save();

    return redirect()->route('Bebidas.index')->with('success', 'La bebida a sido agregado exitosamente');
}
 

public function updateCart(Request $request)
{
    $request->validate([
        'id' => 'required|exists:bebidas,id',
        'quantity' => 'required|integer|min:1',
    ]);

    $userId = auth()->id();
    $newQuantity = intval($request->quantity);
    $bebida = Bebida::findOrFail($request->id);

    $cartItem = Carrito::where('id_usuario', $userId)
        ->where('nombre_producto', $bebida->nombre_bebida)
        ->first();

    if (!$cartItem) {
        return redirect()->back()->with('error', 'Producto no encontrado en el carrito.');
    }

    $difference = $newQuantity - intval($cartItem->cantidad_producto);

    if ($difference > 0 && $bebida->stock < $difference) {
        return redirect()->back()->with('error', "Lo sentimos, solo quedan {$bebida->stock} piezas de este producto.");
    }

    $cartItem->update(['cantidad_producto' => $newQuantity]);

    session()->put("carrito.{$request->id}.quantity", $newQuantity);

    $bebida->stock -= $difference;
    $bebida->vendido = ($bebida->stock <= 0);
    $bebida->save();
        
    return redirect()->back()->with('success', 'Carrito actualizado con éxito.');

}

    public function remove(Request $request)
{
    if ($request->id) {
        $userId = auth()->user()->id;
        
        $bebida = Bebida::findOrFail($request->id);

        $cartItem = Carrito::where('id_usuario', $userId)
            ->where('nombre_producto', $bebida->nombre_bebida)
            ->first();

        if ($cartItem) {
            $bebida->stock += $cartItem->cantidad_producto; 
            $bebida->vendido = false;                      
            $bebida->save();

            $cartItem->delete();
        }

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
