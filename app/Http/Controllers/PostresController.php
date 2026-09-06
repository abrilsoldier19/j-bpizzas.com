<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\Postre;
use App\Models\Usuario;
use App\Models\Carrito;
use App\Models\ProductoPostre;
use Illuminate\Support\Facades\Auth;
use Spatie\Permission\Models\Permission;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\DB;

class PostresController extends Controller
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


    return view('Postres.crear', compact('permission', 'currentUser', 'usuarios'));
    }


    public function store(Request $request)
{
     
    $request->validate([
        'file' => 'required|image|mimes:jpeg,png,jpg|max:2048',
        'nombre_postre' => 'required|string|max:255',
        'marca' => 'required|string|max:255',
        'postre_precio' => 'required|numeric|min:0',
        'stock' => 'required|integer|min:0',
    ]);

    $file = $request->file('file');
    $fileName = $file->getClientOriginalName();
    $filePath = $file->storeAs('', $fileName, 'public');

    Postre::create([
        
        'nombre_postre' => $request->nombre_postre,
        'marca' => $request->marca,
        'postre_imagen' => $filePath ,
        'postre_precio' => $request->postre_precio,
        'vendido' => "0",
        'stock' => $request->stock,
        'id_usuario' => Auth::user()->id,
    ]);

    return redirect()->route('Postres.index')->with('success', 'postres publicado exitosamente.');
}



    public function show($id)
    {
    }

    public function index(Request $request)
{
    $user = Auth::user();
    $query = Postre::query();
    $postre_precio = $request->input('postre_precio');

    if ($request->filled('nombre_postre')) {
        $query->where('nombre_postre', 'LIKE', '%' . $request->input('nombre_postre') . '%');
    }

    if ($postre_precio == 'below_70') {
        $query->where('postre_precio', '<', 70);
    } elseif ($postre_precio == 'above_70') {
        $query->where('postre_precio', '>', 70);
    }

    if ($request->filled('min_price') && $request->filled('max_price')) {
        $minPrice = $request->input('min_price');
        $maxPrice = $request->input('max_price');
        $query->whereBetween('postre_precio', [$minPrice, $maxPrice]);
    }

    $min_price = 10;
    $max_price = 100;

    if ($request->ajax()) {
        return response()->json([
            $postres= view('Postres.index', compact('postres'))->render(),
            'pagination' => $postres->links()->toHtml(),
        ]);
    }

    $postres = $query->simplePaginate(5);
    $totalProductos = $query->count();

    return view('Postres.index', compact('postres', 'min_price', 'max_price', 'totalProductos'));
}



public function more_data(Request $request) {
    if($request->ajax()){
        $skip = $request->skip;
        $take = 6;
        
        // Creamos la consulta base
        $query = Postre::query();

        // 1. Aplicamos filtro de nombre si existe
        if ($request->filled('nombre_postre')) {
            $query->where('nombre_postre', 'LIKE', '%' . $request->input('nombre_postre') . '%');
        }

        // 2. Aplicamos filtro de slider de precios si existe
        if ($request->filled('min_price') && $request->filled('max_price')) {
            $query->whereBetween('postre_precio', [$request->input('min_price'), $request->input('max_price')]);
        }

        // 3. Traemos los datos incluyendo la relación del vendedor para que no falle el JavaScript
        $postres = $query->with('vendedor')->skip($skip)->take($take)->get();
        
        return response()->json($postres);
    } else {
        return response()->json('Direct Access Not Allowed!!', 403);
    }
}



    public function edit( $id)
    {
        $postres = Postre::find($id);
        return view('Postres.editar', compact('postres'));
    }

    public function update(Request $request, $id)
{
    $request->validate([
        'file' => 'sometimes|required|mimes:png,jpg|max:2048',
        'nombre_postre' => 'required',
        'postre_precio' => 'required', // Use 'sometimes' to make file optional
        'stock' => 'required|integer|min:0',
        'marca' => 'required|string|max:255'
    ]);

    // Find the existing Pizzeria record by ID
        $file = $request->file('file');
        $fileName = $file->getClientOriginalName();
        $filePath = $file->storeAs('',$fileName, 'public');
    
        $postres =Postre::find($request->id);
        $postres->nombre_postre = $request->input('nombre_postre');
        $postres->postre_precio = $request->input('postre_precio');
        $postres->stock = $request->input('stock');
        $postres->postre_imagen = $filePath;
        $postres->marca = $request->input('marca');

        $postres->vendido = ($postres->stock <= 0) ? true : false; 

        $postres->save();

        if (!$postres){
            abort(404);
        }
    
        return redirect()->route('Postres.index')->with('success', 'Producto actualizado exitosamente.');

}

public function carrito(Request $request)
{
    return view('Postres.carrito');
}

public function mi(){
    $postres =Postre::where('id_usuario', Auth::user()->id)->orderBy('vendido', 'asc')->get();
    
    return view('Postres.mi', compact('postres'));
}



public function agregarCarrito($id, Request $request)
{
    //Se busca si hay postres o no con el id
    $postre = Postre::findOrFail($id);

    //Para saber si hay suficiente stock antes de agregar al carrito
    $quantity = $request->input('quantity', 1);

    // validacion de stock
    if ($postre->stock < $quantity) {
        return redirect()->back()->with('error', 'Lo sentimos, solo quedan ' . $postre->stock . ' piezas disponibles.');
    }

    // se guarda los postres en el carrito de compras y en la base de datos
    $carrito = new Carrito;
    $carrito->nombre_producto = $postre->nombre_postre; // Cambia esto según el tipo de producto
    $carrito->precio_producto = $postre->postre_precio; // Cambia esto según el tipo de producto
    $carrito->cantidad_producto = $quantity;
    $carrito->imagen_producto = $postre->postre_imagen; // Cambia esto según el tipo de producto
    $carrito->id_usuario = auth()->user()->id; // Cambia esto según cómo obtienes el ID del usuario actual
    $carrito->save();

    //guardar en la sesion del carrito
    $carritoSesion = session()->get('carrito', []);

    if (isset($carritoSesion[$id])) {
        $carritoSesion[$id]['quantity'] += $quantity;
    } else {
        $carritoSesion[$id] = [
            "nombre_postre" => $postre->nombre_postre,
            "postre_imagen" => $postre->postre_imagen,
            "postre_precio" => $postre->postre_precio,
            "quantity" => $quantity
        ];
    }

    session()->put('carrito', $carritoSesion);

    //manejo de stock
    $postre->stock -= $quantity;

    if ($postre->stock <= 0) {
        $postre->stock = 0; // marca como disponible 0 si no hay stock
        $postre->vendido = true; // Marcar como vendido si no hay stock
    }

    $postre->save();

    return redirect()->route('Postres.index')->with('success', 'El postre se ha agregado al carrito exitosamente');
}
 

public function updateCart(Request $request)
{
    $request->validate([
        'id' => 'required|exists:postres,id',
        'quantity' => 'required|integer|min:1'
    ]);

    $userId = auth()->id();
    $newQuantity = intval($request->quantity);
    $postre = Postre::findOrFail($request->id);

    $cartItem = Carrito::where('id_usuario', $userId)
        ->where('nombre_producto', $postre->nombre_postre)
        ->first();

    if (!$cartItem) {
        return redirect()->back()->with('error', 'Producto no encontrado en tu carrito.');
    }

    $difference = $newQuantity - intval($cartItem->cantidad_producto);

    if ($difference > 0 && $postre->stock < $difference) {
        return redirect()->back()->with('error', "Lo sentimos, solo quedan {$postre->stock} piezas de este producto.");
    }

    $cartItem->update(['cantidad_producto' => $newQuantity]);

    session()->put("carrito.{$request->id}.quantity", $newQuantity);

    $postre->stock -= $difference;
    $postre->vendido = ($postre->stock <= 0);
    $postre->save();

    return redirect()->back()->with('success', 'Carrito actualizado con éxito.');
}



   public function remove(Request $request)
{
    if ($request->id) {
        $userId = auth()->user()->id;
        
        // se busca el postre en la base de datos usando el id enviado por la vista
        $postre = Postre::findOrFail($request->id);

        // se busca el producto en el carrito del usuario
        $cartItem = Carrito::where('id_usuario', $userId)
            ->where('nombre_producto', $postre->nombre_postre)
            ->first();

        // se regresa el stock del postre y se marca como disponible si es que estaba agotado
        if ($cartItem) {
            $postre->stock += $cartItem->cantidad_producto; 
            $postre->vendido = false;                      
            $postre->save();

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
        $postres =Postre::findOrFail($id);

        return Storage::disk('public')->download($postres->postre_imagen);
    }
    public function destroy($id)
    {
        $postres =Postre::findOrFail($id);
        $postres->delete();

        return redirect()->route('Postres.index')->with('success', 'Postres eliminada exitosamente.');
    }



// PizzasController.php
public function activate($id)
{
    $postres =Postre::findOrFail($id);

    if ($postres->id_usuario != Auth::user()->id) {
        return back()->with('error', "You don't have permission to activate/sell this pizza");
    }

    $postres->update([
        'vendido' => false, // Cambia el estado actual (Active/Sold)
    ]);

    return back()->with('success', 'Postre status updated successfully');
}
}
