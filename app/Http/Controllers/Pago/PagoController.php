<?php

namespace App\Http\Controllers\Pago;

use App\Http\Controllers\Controller;
use App\Models\Pago;
use Illuminate\Http\Request;

class PagoController extends Controller
{
    public function index()
    {
        $pagos = Pago::all();
        return view('pago.index', compact('pagos'));
    }
}
