<?php

namespace App\Http\Controllers\CategoriaServicio;

use App\Http\Controllers\Controller;
use App\Models\CategoriaServicio;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CategoriaServicioController extends Controller
{
    public function index()
    {
        $userId = Auth::id();
        $categorias = CategoriaServicio::where('user_id', $userId)
            ->orderBy('created_at', 'desc')
            ->paginate(7);
        $totalCategorias = CategoriaServicio::where('user_id', $userId)->count();

        return view('categoria.index', compact('categorias', 'totalCategorias'));
    }

    public function edit($id)
    {
        $user_id = Auth::id();
        $categoria = CategoriaServicio::where('user_id', $user_id)->findOrFail($id);
        return view('categoria.edit', compact('categoria'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nombre' => 'required|string|max:255',
            'descripcion' => 'nullable|string',
        ]);

        $user_id = Auth::id();
        $categoria = CategoriaServicio::where('user_id', $user_id)->findOrFail($id);

        $categoria->nombre = $request->nombre;
        $categoria->descripcion = $request->descripcion;

        $categoria->save();

        return redirect()->route('categoria.index')->with('success', 'Categoria actualizada');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required|string|max:255',
            'descripcion' => 'nullable|string',
        ]);

        $categoria = new CategoriaServicio();
        $categoria->user_id = Auth::id();
        $categoria->nombre = $request->nombre;
        $categoria->descripcion = $request->descripcion;
        $categoria->save();

        return redirect()->route('categoria.index')->with('success', '¡La categoría se ha creado correctamente!');
    }

    public function destroy($id)
    {
        try {
            $categoria = CategoriaServicio::where('user_id', Auth::id())->findOrFail($id);
            $categoria->delete();

            return redirect()->route('categoria.index')->with('success', '¡La categoría se ha eliminado correctamente!');
        } catch (QueryException $e) {
            // Manejar el error de integridad referencial (1451)
            if ($e->errorInfo[1] === 1451) {
                return redirect()->back()->with('error', 'No se puede eliminar la categoria porque está siendo utilizado en inscripciones registradas.');
            } else {
                // Manejar otros errores de base de datos
                return redirect()->back()->with('error', 'Error al intentar eliminar el producto.');
            }
        }
    }
}
