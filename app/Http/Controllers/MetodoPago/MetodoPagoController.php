<?php

namespace App\Http\Controllers\MetodoPago;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use App\Models\MetodoPago;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MetodoPagoController extends Controller
{
    public function index()
    {
        $userId = Auth::id();

        $brands = Brand::all();
        $metodosPago = MetodoPago::where('user_id', $userId)
            ->orderBy('created_at', 'desc')
            ->paginate(7);

        return view('metodo_pago.index', compact('metodosPago', 'brands'));
    }

    public function edit($id)
    {

        $userId = Auth::id();
        $brands = Brand::all();
        $metodoPago = MetodoPago::where('user_id', $userId)->findOrFail($id);

        return view('metodo_pago.edit', compact('metodoPago', 'brands'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'brand_id' => 'required|exists:brands,id',
            'descripcion' => 'required|string',
        ]);

        $userId = Auth::id();

        $metodoPago = MetodoPago::where('user_id', $userId)->findOrFail($id);

        $metodoPago->brand_id = $request->brand_id;
        $metodoPago->descripcion = $request->descripcion;
        $metodoPago->save();

        return redirect()->route('metodo-pago.index')->with('success', '¡El método de pago se ha actualizado correctamente!');
    }

    public function store(Request $request)
    {
        $request->validate([
            'brand_id' => 'required|exists:brands,id',
            'descripcion' => 'required|string',
        ]);

        $userId = Auth::id();

        $metodoPago = new MetodoPago();
        $metodoPago->user_id = $userId;
        $metodoPago->brand_id = $request->brand_id;
        $metodoPago->descripcion = $request->descripcion;
        $metodoPago->save();

        return redirect()->route('metodo-pago.index')->with('success', '¡El método de pago se ha creado correctamente!');
    }

    public function destroy($id)
    {
        $metodoPago = MetodoPago::where('user_id', Auth::id())->findOrFail($id);
        $metodoPago->delete();

        return redirect()->route('metodo-pago.index')->with('success', '¡El metodo de pago se ha eliminado correctamente!');
    }
}
