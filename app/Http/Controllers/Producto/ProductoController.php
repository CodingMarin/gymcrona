<?php

namespace App\Http\Controllers\Producto;

use App\Http\Controllers\Controller;
use App\Models\CategoriaProducto;
use App\Models\Producto;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProductoController extends Controller
{
    public function index()
    {
        $userId = Auth::id();
        $totalProductos = Producto::where('user_id', $userId)->count();
        $productos = Producto::where('user_id', $userId)
            ->orderBy('created_at', 'desc')
            ->paginate(5);

        return view('producto.index', compact('totalProductos', 'productos'));
    }

    public function create()
    {
        $categoriasProducto = CategoriaProducto::all();
        return view('producto.create', compact('categoriasProducto'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required|string|max:255',
            'descripcion' => 'required|string|max:255',
            'precio' => 'required|numeric',
            'stock' => 'required|integer',
            'categoria_id' => 'required|exists:categoria_producto,id',
            'estado' => 'required|boolean',
            'image' => 'image|mimes:jpeg,png,jpg,gif,webp|max:2048',
        ]);

        $imageName = null;

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time() . '_' . $image->getClientOriginalName();
            $image->move(public_path('images/productos'), $imageName);
        }

        $producto = new Producto();
        $producto->nombre = $request->nombre;
        $producto->descripcion = $request->descripcion;
        $producto->precio = $request->precio;
        $producto->stock = $request->stock;
        $producto->marca = $request->marca ?? '';
        $producto->foto_url = $imageName;
        $producto->user_id = Auth::id();
        $producto->categoria_id = $request->categoria_id;
        $producto->estado = $request->estado;
        $producto->save();

        return redirect()->route('producto.index')->with('success', 'Producto creado satisfactoriamente');
    }

    public function destroy($id)
    {
        try {
            $user_id = Auth::id();
            $producto = Producto::where('user_id', $user_id)->findOrFail($id);
            $producto->delete();

            return redirect()->route('producto.index')->with('success', 'Producto eliminado');
        } catch (QueryException $e) {
            // Manejar el error de integridad referencial (1451)
            if ($e->errorInfo[1] === 1451) {
                return redirect()->back()->with('error', 'No se puede eliminar el producto porque está siendo utilizado en ventas registradas.');
            } else {
                // Manejar otros errores de base de datos
                return redirect()->back()->with('error', 'Error al intentar eliminar el producto.');
            }
        }
    }
}
