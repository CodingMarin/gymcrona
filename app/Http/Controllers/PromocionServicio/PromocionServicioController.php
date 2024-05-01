<?php

namespace App\Http\Controllers\PromocionServicio;

use App\Http\Controllers\Controller;
use App\Models\PromocionServicio;
use Illuminate\Http\Request;

class PromocionServicioController extends Controller
{
    public function index()
    {
        $promociones = PromocionServicio::all();
        return view('promocion.index', compact('promociones'));
    }
}
