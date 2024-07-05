<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pedido;
use Illuminate\Support\Facades\Auth;

class PerfilController  extends Controller
{
    public function index(){
        return view('Pizzas.perfil');
    }
 
    public function compra(){
        return view('Pizzas.compra');
    }
}
