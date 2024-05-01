<?php

namespace App\Http\Controllers\MetodoPago;

use App\Http\Controllers\Controller;
use App\Models\MetodoPago;
use Illuminate\Http\Request;

class MetodoPagoController extends Controller
{
    public function index()
    {
        $metodosPago = MetodoPago::all();
        return view('metodo_pago.index', compact('metodosPago'));
    }
}
