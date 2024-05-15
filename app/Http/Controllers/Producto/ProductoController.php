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
        $categoriasProducto = CategoriaProducto::all();
        $totalProductos = Producto::where('user_id', $userId)->count();
        $productos = Producto::where('user_id', $userId)
            ->orderBy('created_at', 'desc')
            ->paginate(5);

        return view('producto.index', compact('totalProductos', 'productos', 'categoriasProducto'));
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

    public function edit($id)
    {
        $user_id = Auth::id();
        $producto = Producto::where('user_id', $user_id)->findOrFail($id);
        $categoriasProducto = CategoriaProducto::all();

        return view('producto.edit', compact('producto', 'categoriasProducto'));
    }

    public function update(Request $request, $id)
    {
        try {
            $user_id = Auth::id();

            $request->validate([
                'nombre' => 'required|string|max:255',
                'descripcion' => 'required|string|max:255',
                'precio' => 'required|numeric',
                'stock' => 'required|integer',
                'categoria_id' => 'required|exists:categoria_producto,id',
                'estado' => 'required|boolean',
                'image' => 'image|mimes:jpeg,png,jpg,gif,webp|max:2048',
            ]);

            $producto = Producto::where('user_id', $user_id)->findOrFail($id);

            $imageName = $producto->foto_url; // Mantener el valor actual de la foto

            if ($request->hasFile('image')) {
                $image = $request->file('image');
                $imageName = time() . '_' . $image->getClientOriginalName();
                $image->move(public_path('images/productos'), $imageName);

                if ($producto->foto_url) {
                    unlink(public_path('images/productos/' . $producto->foto_url));
                }
            }

            $producto->nombre = $request->nombre;
            $producto->descripcion = $request->descripcion;
            $producto->precio = $request->precio;
            $producto->stock = $request->stock;
            $producto->marca = $request->marca ?? '';
            $producto->categoria_id = $request->categoria_id;
            $producto->estado = $request->estado;
            $producto->foto_url = $imageName;
            $producto->user_id = $user_id;
            $producto->save();

            return redirect()->route('producto.index')->with('success', 'Producto actualizado satisfactoriamente');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Se produjo un error al intentar actualizar el producto: ' . $e->getMessage());
        }
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
