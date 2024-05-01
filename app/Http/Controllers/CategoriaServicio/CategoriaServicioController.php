<?php

namespace App\Http\Controllers\CategoriaServicio;

use App\Http\Controllers\Controller;
use App\Models\CategoriaServicio;
use Illuminate\Http\Request;

class CategoriaServicioController extends Controller
{
    public function index()
    {
        $categorias = CategoriaServicio::all();
        return view('categoria.index', compact('categorias'));
    }
}
