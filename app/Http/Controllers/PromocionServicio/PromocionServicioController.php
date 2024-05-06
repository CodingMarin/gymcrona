<?php

namespace App\Http\Controllers\PromocionServicio;

use App\Http\Controllers\Controller;
use App\Models\PromocionServicio;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PromocionServicioController extends Controller
{
    public function index()
    {
        $userId = Auth::id();
        $totalPromociones = PromocionServicio::all()->count();
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
        $promocion = PromocionServicio::where('user_id', Auth::id())->findOrFail($id);
        $promocion->delete();

        return redirect()->route('promocion.index')->with('success', '¡Promoción eliminada correctamente!');
    }
}
