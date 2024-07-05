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
    ]);

    $file = $request->file('file');
    $fileName = $file->getClientOriginalName();
    $filePath = $file->storeAs('', $fileName, 'public');

    Postre::create([
        
        'nombre_postre' => $request->nombre_postre,
        'postre_imagen' => $filePath ,
        'postre_precio' => $request->postre_precio,
        'vendido' => "0",
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



 public function more_data(Request $request){
    if($request->ajax()){
        $skip=$request->skip;
        $take=6;
        $postres=Postre::skip($skip)->take($take)->get();
        return response()->json($postres);
    }else{
        return response()->json('Direct Access Not Allowed!!');
    }
}



    public function edit( $id)
    {
        $postres = Postre::find($id);
        return view('Postres.editar', compact('postres'));
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
        'nombre_postre' => 'required',
        'postre_precio' => 'required', // Use 'sometimes' to make file optional
    ]);

    // Find the existing Pizzeria record by ID
        $file = $request->file('file');
        $fileName = $file->getClientOriginalName();
        $filePath = $file->storeAs('',$fileName, 'public');

        
    
        $postres =Postre::find($request->id);
        $postres->nombre_postre = $request->input('nombre_postre');
        $postres->postre_precio = $request->input('postre_precio');
        $postres->postre_imagen = $filePath;
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

public function comprar($id, Request $request){
    $postre = Postre::find($id);

    $quantity = $request->input('quantity', 0);

    // Create a new Pedido record for each item added to the cart
    ProductoPostre::create([
        'id_postre' => $postre->id,
        'id_comprador' => Auth::user()->id,
        'cantidad_comprada' => $quantity,
    ]);

    $carrito = session()->get('carrito', []);

    if (isset($carrito[$id])) {
        $carrito[$id]['quantity'] += $quantity;
    } else {
        $carrito[$id] = [
            "nombre_postre" => $postre->nombre_postre,
            "postre_imagen" => $postre->postre_imagen,
            "postre_precio" => $postre->postre_precio,
            "quantity" => $quantity
        ];
    }

    session()->put('carrito', $carrito);

    $postre->update([
        'vendido' => true,
    ]);



    return redirect()->route('Postres.index')->with('success', 'Congratulations, the postre has been purchased successfully');
}


public function mi(){
    $postres =Postre::where('id_usuario', Auth::user()->id)->orderBy('vendido', 'asc')->get();
    
    return view('Postres.mi', compact('postres'));
}



public function agregarCarrito($id, Request $request)
{
     $postre = Postre::find($id);

    $quantity = $request->input('quantity', 0);

    $carrito = new Carrito;
    $carrito->nombre_producto = $postre->nombre_postre; // Cambia esto según el tipo de producto
    $carrito->precio_producto = $postre->postre_precio; // Cambia esto según el tipo de producto
    $carrito->cantidad_producto = $quantity;
    $carrito->imagen_producto = $postre->postre_imagen; // Cambia esto según el tipo de producto
    $carrito->id_usuario = auth()->user()->id; // Cambia esto según cómo obtienes el ID del usuario actual
    $carrito->save();


    // Create a new Pedido record for each item added to the cart
    ProductoPostre::create([
        'id_postre' => $postre->id,
        'id_comprador' => Auth::user()->id,
        'cantidad_comprada' => $quantity,
    ]);

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
    


    return redirect()->route('Postres.index')->with('success', 'Congratulations, the postre has been purchased successfully');
}
 

public function updateCart(Request $request)
{
    if ($request->id && $request->quantity) {
        // Update the session cart
        $carrito = session()->get('carrito');
        $carrito[$request->id]["quantity"] = $request->quantity;
        session()->put('carrito', $carrito);

        // Update the database (assuming you have a Pizzeria model)
        $postre =Postre::findOrFail($request->id);
        $postre->update(['quantity' => $request->quantity]);

        // Update the Pedidos table (assuming you have a Pedido model)
        // Assuming you have a relation between Pedido and Pizzeria models
        $pedido = ProductoPostre::where('id_postre', $request->id)->first();
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
