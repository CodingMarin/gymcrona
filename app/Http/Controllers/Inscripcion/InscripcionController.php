<?php

namespace App\Http\Controllers\Inscripcion;

use App\Http\Controllers\Controller;
use App\Models\CategoriaServicio;
use App\Models\Cliente;
use App\Models\Estado;
use App\Models\Pago;
use App\Models\Inscripcion;
use App\Models\MetodoPago;
use App\Models\PromocionServicio;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class InscripcionController extends Controller
{
    public function index()
    {
        $user_id = Auth::id();

        $inscripcionesPorVencer = Inscripcion::where('user_id', $user_id)
            ->where('estado_id', 1)
            ->where('fecha_caducidad', '>=', now())
            ->count();

        $totalInscripciones = Inscripcion::where('user_id', $user_id)->count();
        $inscripciones = Inscripcion::where('user_id', $user_id)
            ->orderBy('id', 'desc')
            ->paginate(15);

        return view(
            'inscripcion.index',
            compact([
                'inscripciones',
                'totalInscripciones',
                'inscripcionesPorVencer'
            ])
        );
    }

    public function create()
    {
        $user_id = Auth::id();
        $clientes = Cliente::where('user_id', $user_id)->get();
        $metodoPago = MetodoPago::where('user_id', $user_id)->get();
        $estadoInscripcion = Estado::all();
        $categoriasServicio = CategoriaServicio::where('user_id', $user_id)->get();
        $promocionServicio = PromocionServicio::where('user_id', $user_id)->get();
        $precioPromocionServicio = PromocionServicio::where('user_id', $user_id)->get(['precio']);

        return view(
            'inscripcion.create',
            compact([
                'clientes',
                'metodoPago',
                'promocionServicio',
                'estadoInscripcion',
                'categoriasServicio',
            ])
        );
    }

    public function edit($id)
    {
        $userId = Auth::id();
        $estadoInscripcion = Estado::all();
        $metodoPago = MetodoPago::where('user_id', $userId)->get();
        $clientes = Cliente::where('user_id', $userId)->get();
        $inscripcion = Inscripcion::where('user_id', $userId)->findOrFail($id);
        $promocionServicio = PromocionServicio::where('user_id', $userId)->get();
        $categoriasServicio = CategoriaServicio::where('user_id', $userId)->get();

        return view(
            'inscripcion.edit',
            compact([
                'inscripcion',
                'clientes',
                'categoriasServicio',
                'promocionServicio',
                'metodoPago',
                'estadoInscripcion',
            ])
        );
    }


    public function update(Request $request, $id)
    {
        $userId = Auth::id();

        $request->validate([
            'numero_boleta' => 'nullable|string|max:20',
            'servicio_id' => 'required|exists:categoria_servicio,id',
            'promocion_id' => 'nullable|exists:promocion_servicio,id',
            'estado_id' => 'required|exists:estado,id',
            'fecha_caducidad' => 'required|date',
            'monto_pago' => 'nullable|numeric',
            'monto_deuda' => 'nullable|numeric',
            'metodo_pago_id' => 'nullable|exists:metodo_pago,id',
            'pago_actual' => 'nullable|numeric'
        ]);

        Inscripcion::superUpdate(
            $id,
            $userId,
            $request->numero_boleta,
            $request->servicio_id,
            $request->promocion_id ?? null,
            $request->metodo_pago_id,
            $request->estado_id,
            $request->fecha_caducidad,
            $request->monto_pago,
            $request->monto_deuda
        );

        $pago = new Pago();
        $pago->user_id = $userId;
        $pago->metodo_id = $request->metodo_pago_id;
        $pago->servicio_id = $request->servicio_id;
        $pago->promocion_id = $request->promocion_id ?? null;
        $pago->monto = $request->pago_actual;
        $pago->save();

        return redirect()->route('inscripcion.index')->with('success', 'Inscripción actualizada exitosamente.');
    }

    public function store(Request $request)
    {

        $userId = Auth::id();

        $request->validate([
            'numero_boleta' => 'nullable|string|max:11',
            'cliente_id' => 'required|exists:cliente,id',
            'servicio_id' => 'required|exists:categoria_servicio,id',
            'promocion_id' => 'nullable|exists:promocion_servicio,id',
            'metodo_pago_id' => 'nullable|exists:metodo_pago,id',
            'estado_id' => 'required|exists:estado,id',
            'fecha_emision' => 'required|date',
            'fecha_caducidad' => 'required|date',
            'monto_costo' => 'required|numeric',
            'monto_pago' => 'nullable|numeric',
            'monto_deuda' => 'nullable|numeric',
        ]);

        $inscripcion = new Inscripcion();
        $inscripcion->user_id = $userId;
        $inscripcion->numero_boleta = $request->numero_boleta ?? '000';
        $inscripcion->cliente_id = $request->cliente_id;
        $inscripcion->categoria_servicio_id = $request->servicio_id;
        $inscripcion->promocion_servicio_id = $request->promocion_id ?? null;
        $inscripcion->metodo_pago_id = $request->metodo_pago_id;
        $inscripcion->estado_id = $request->estado_id;
        $inscripcion->fecha_emision = $request->fecha_emision;
        $inscripcion->fecha_caducidad = $request->fecha_caducidad;
        $inscripcion->monto_costo = $request->monto_costo;
        $inscripcion->monto_pago = $request->monto_pago;
        $inscripcion->monto_deuda = $request->monto_deuda;

        $inscripcion->save();

        $pago = new Pago();
        $pago->user_id = $userId;
        $pago->metodo_id = $request->metodo_pago_id;
        $pago->servicio_id = $request->servicio_id;
        $pago->promocion_id = $request->promocion_id;
        $pago->monto = $request->monto_pago;
        $pago->save();

        session()->flash('new_user_id', $inscripcion->id);

        return redirect()->route('inscripcion.index')->with('success', 'Inscripción creada exitosamente.');
    }
}
