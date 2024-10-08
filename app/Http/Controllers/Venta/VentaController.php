<?php

namespace App\Http\Controllers\Venta;

use App\Http\Controllers\Controller;
use App\Models\Cliente;
use App\Models\MetodoPago;
use App\Models\Pago;
use App\Models\Producto;
use App\Models\Venta;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class VentaController extends Controller
{
    public function index()
    {
        $userId = Auth::id();
        $totalVentas = Venta::where('user_id', $userId)->get();
        $ventas = Venta::superSelect($userId);

        return view('venta.index', compact('ventas', 'totalVentas'));
    }

    public function store(Request $request)
    {
        try {
            $request->validate([
                'cliente_id' => 'required|exists:cliente,id',
                'metodo_pago_id' => 'required|exists:metodo_pago,id',
                'detalle_venta.*.producto_id' => 'required|exists:producto,id',
                'detalle_venta.*.producto_nombre' => 'required|string',
                'detalle_venta.*.cantidad' => 'required|numeric|min:1',
            ]);

            $cliente_id = $request->cliente_id;
            $metodo_pago_id = $request->metodo_pago_id;

            foreach ($request->detalle_venta as $detalle) {
                $producto_id = $detalle['producto_id'];
                $producto_nombre = $detalle['producto_nombre'];
                $cantidad = $detalle['cantidad'];

                // Instanciar modelo producto
                $producto = Producto::findOrFail($producto_id);

                // Restar la cantidad vendida del stock actual al producto :)
                $producto->stock -= $cantidad;

                // Guardar los cambios de stock del producto
                $producto->save();

                $subtotal = $detalle['subtotal'];

                Venta::superInsert(
                    $request->user()->id,
                    $cliente_id,
                    $producto_id,
                    $metodo_pago_id,
                    $subtotal,
                    null // Observaciones, nulla por ahora
                );

                //Guardar el registro de venta en pagos
                $pago = new Pago();
                $pago->user_id = $request->user()->id;
                $pago->metodo_id = $metodo_pago_id;
                $pago->producto_servicio = $producto_nombre;
                $pago->monto = $subtotal;
                $pago->save();
            }

            return redirect()->route('venta.index')->with('success', 'Venta registrada exitosamente.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Ocurrió un error al procesar la venta: ' . $e->getMessage());
        }
    }


    public function create()
    {
        $userId = Auth::id();
        $clientes = Cliente::where('user_id', $userId)->get();
        $productos = Producto::where('user_id', $userId)->get();
        $metodosPago = MetodoPago::where('user_id', $userId)->get();

        return view('venta.create', compact([
            'productos',
            'clientes',
            'metodosPago',
        ]));
    }
}
