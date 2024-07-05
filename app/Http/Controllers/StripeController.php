<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\Pizzeria;
use App\Models\Usuario;
use Illuminate\Support\Facades\Auth;
use Spatie\Permission\Models\Permission;
use Illuminate\Pagination\LengthAwarePaginator;

class StripeController extends Controller
{
    public function index(Request $request)
    {
        $user = Auth::user();
        $query = Pizzeria::query();
        if ($user->hasRole('Usuario')) {
            // Si el usuario es un alumno, muestra solo sus Pizzass
            $pizzas = Pizzeria::where('id', $user->id)
                ->paginate(10);
        } else {
            // Si el usuario es un administrador, muestra todas las calificaciones
            $pizzas = Pizzeria::paginate(10);
        }

        if ($request->filled('nombre_pizza')) {
            $query->where('nombre_pizza', 'LIKE', '%' . $request->input('nombre_pizza') . '%');
        }

        $pizzas = $query->paginate(7);
        return view('Pizzas.index', compact('pizzas'));
    }
    public function session(Request $request)
    {
        //$user         = auth()->user();
        $productItems = [];
 
        \Stripe\Stripe::setApiKey(config('stripe.sk'));
 
        foreach (session('carrito') as $id => $details) {
 
            $product_name = $details['nombre_pizza'];
            $total = $details['precio_pizza'];
            $quantity = $details['quantity'];
 
            $two0 = "00";
            $unit_amount = "$total$two0";
 
            $productItems[] = [
                'price_data' => [
                    'product_data' => [
                        'name' => $product_name,
                    ],
                    'currency'     => 'USD',
                    'unit_amount'  => $unit_amount,
                ],
                'quantity' => $quantity
            ];
        }
 
        $checkoutSession = \Stripe\Checkout\Session::create([
            'line_items'            => [$productItems],
            'mode'                  => 'payment',
            'allow_promotion_codes' => true,
            'metadata'              => [
                'user_id' => "0001"
            ],
            'customer_email' => "cairocoders-ednalan@gmail.com", //$user->email,
            'success_url' => route('success'),
            'cancel_url'  => route('cancel'),
        ]);
     
        return redirect()->away($checkoutSession->url);

    }


    public function success()
    {
        return view('Pizzas.success');
    }
 
    public function cancel()
    {
        return view('Pizzas.cancel');
    }

    public function show($id)
    {
    }

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
    if($request->precio_pizza < 1){
        return back()->with('error', 'Minimum price is $. 1');
    }
     
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




    public function edit( $id)
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
    
        return redirect()->route('Pizzas.index')->with('success', 'Producto actualizado exitosamente.');

}

public function carrito(Request $request)
{
   
    
    return view('Pizzas.carrito');
}

public function comprar($id, Request $request){
    $pizza = Pizzeria::findOrFail($id);
    $quantity = $request->input('quantity', 1);

    if($pizza->user_id == Auth::user()->id){
        return back()->with('error', "Purchase failed, you can't buy your own pizza");
    }

    Pedido::create([
        'id_producto' => $pizza->id,
        'id_comprador' => Auth::user()->id,
        'cantidad_comprada' => $quantity,
    ]);

    $pizza->update([
        'vendido' => true,
    ]);

    return redirect()->route('Pizzas.index')->with('success', 'Congratulations, the pizza has been purchased successfully');
}


public function compra(Request $request) {
    $user = Auth::user();

    if ($user->hasRole('Usuario')) {
        // If the user is a regular user, show only their orders
        $pizzas = Pedido::where('id_comprador', $user->id)
            ->join('pizzeria', 'pedidos.id_producto', '=', 'pizzeria.id')
            ->join('usuarios', 'pedidos.id_comprador', '=', 'usuarios.id')
            ->paginate(5, ['pedidos.*', 'pizzeria.nombre_pizza', 'pizzeria.precio_pizza', 'pizzeria.imagen_pizza', 'usuarios.name', 'usuarios.email']);
    } else {
        // If the user is an administrator, show all orders
        $pizzas = Pedido::join('pizzeria', 'pedidos.id_producto', '=', 'pizzeria.id')
            ->join('usuarios', 'pedidos.id_comprador', '=', 'usuarios.id')
            ->paginate(5, ['pedidos.*', 'pizzeria.nombre_pizza', 'pizzeria.precio_pizza', 'pizzeria.imagen_pizza', 'usuarios.name', 'usuarios.email']);
    }

    $vendedor = Usuario::all();
    $detalle = Pizzeria::all();
    $fechaActual = now();

    return view('Pizzas.compra', compact('pizzas', 'vendedor', 'detalle', 'fechaActual'));
}

public function mi(){
    $pizzas = Pizzeria::where('id_usuario', Auth::user()->id)->orderBy('vendido', 'asc')->get();
    return view('Pizzas.mi', compact('pizzas'));
}



public function agregarCarrito($id, Request $request)
{
    $pizza = Pizzeria::find($id);

    $carrito = session()->get('carrito', []);

    $quantity = $request->input('quantity', 1);

    if (isset($carrito[$id])) {
        $carrito[$id]['quantity'] += $quantity;
    } else {
        $carrito[$id] = [
            "nombre_pizza" => $pizza->nombre_pizza,
            "imagen_pizza" => $pizza->imagen_pizza,
            "precio_pizza" => $pizza->precio_pizza,
            "quantity" => $quantity
        ];
    }

    session()->put('carrito', $carrito);

    return redirect()->route('Pizzas.index')->with('success', 'Producto añadido al carrito exitosamente!');
}




public function updateCart(Request $request)
    {
        if($request->id && $request->quantity){
            $carrito = session()->get('carrito');
            $carrito[$request->id]["quantity"] = $request->quantity;
            session()->put('carrito', $carrito);
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
    public function eliminarPizzas($id)
    {
        $pizzas = Pedido::findOrFail($id);
        $pizzas->delete();

        return redirect()->route('Pizzas.compra')->with('success', 'Pizzas eliminada exitosamente.');
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
}
