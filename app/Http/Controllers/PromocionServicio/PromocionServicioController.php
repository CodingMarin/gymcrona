<?php

namespace App\Http\Controllers\PromocionServicio;

use App\Http\Controllers\Controller;
use App\Models\PromocionServicio;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PromocionServicioController extends Controller
{
    public function index()
    {
        $userId = Auth::id();
        $totalPromociones = PromocionServicio::where('user_id', $userId)->count();
        $promociones = PromocionServicio::where('user_id', $userId)
            ->orderBy('created_at', 'desc')
            ->paginate(7);
        return view('promocion.index', compact('promociones', 'totalPromociones'));
    }

    public function edit($id)
    {
        $promocion = PromocionServicio::where('user_id', Auth::id())->findOrFail($id);
        return view('promocion.edit', compact('promocion'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nombre' => 'required|string|max:255',
            'descripcion' => 'required|string|max:255',
            'precio' => 'required|numeric|min:0.00|max:10000.00',
        ]);

        $userId = Auth::id();

        $promocion = PromocionServicio::where('user_id', $userId)->findOrFail($id);
        $promocion->nombre = $request->nombre;
        $promocion->descripcion = $request->descripcion;
        $promocion->precio = $request->precio;
        $promocion->save();

        return redirect()->route('promocion.index')->with('success', '¡Promoción actualizada exitosamente!');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required|string',
            'descripcion' => 'required|string',
            'precio' => ['required', 'numeric', 'regex:/^\d+(\.\d{1,2})?$/', 'max:10000'],
        ]);

        $userId = Auth::id();

        $promocion = new PromocionServicio();
        $promocion->user_id = $userId;
        $promocion->nombre = $request->nombre;
        $promocion->descripcion = $request->descripcion;
        $promocion->precio = $request->precio;
        $promocion->save();

        return redirect()->route('promocion.index')->with('success', '¡Nueva promocion creada correctamente!');
    }

    public function destroy($id)
    {
        try {
            $promocion = PromocionServicio::where('user_id', Auth::id())->findOrFail($id);
            $promocion->delete();

            return redirect()->route('promocion.index')->with('success', '¡Promoción eliminada correctamente!');
        } catch (QueryException $e) {
            // Manejar el error de integridad referencial (1451)
            if ($e->errorInfo[1] === 1451) {
                return redirect()->back()->with('error', 'No se puede eliminar la promocion porque está siendo utilizado en inscripciones registradas.');
            } else {
                // Manejar otros errores de base de datos
                return redirect()->back()->with('error', 'Error al intentar eliminar la promoción.');
            }
        }
    }
}
