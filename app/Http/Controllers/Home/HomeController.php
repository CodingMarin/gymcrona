<?php

namespace App\Http\Controllers\Home;

use App\Http\Controllers\Controller;
use App\Models\Cliente;
use App\Models\Inscripcion;
use App\Models\Producto;
use App\Models\PromocionServicio;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $user_id = Auth::id();
        $productos = Producto::where('user_id', $user_id)->count();
        $clientes = Cliente::where('user_id', $user_id)->count();
        $promociones = PromocionServicio::where('user_id', $user_id)->count();
        $inscripciones = Inscripcion::where('user_id', $user_id)->count();

        return view('home', compact('clientes', 'productos', 'inscripciones', 'promociones'));
    }
}
