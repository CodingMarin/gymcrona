<?php

namespace App\Http\Controllers\Cliente;

use App\Exports\ClientesExport;
use App\Http\Controllers\Controller;
use App\Models\Cliente;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Facades\Excel;

class ClienteController extends Controller
{
    public function index()
    {
        $userId = Auth::id();
        $totalClientes = Cliente::where('user_id', $userId)->count();
        $clientes = Cliente::where('user_id', $userId)
            ->orderBy('created_at', 'desc')
            ->paginate(7);

        return view('cliente.index', compact('clientes', 'totalClientes'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'dni' => 'required|string|max:8',
            'nombres' => 'required|string|max:50',
            'ap_paterno' => 'required|string|max:50',
            'ap_materno' => 'required|string|max:50',
            'telefono' => 'nullable|string|max:11',
            'email' => 'nullable|email|max:255',
        ]);

        $cliente = new Cliente();
        $cliente->user_id = Auth::id();
        $cliente->dni = $request->dni;
        $cliente->nombres = $request->nombres;
        $cliente->ap_paterno = $request->ap_paterno;
        $cliente->ap_materno = $request->ap_materno;
        $cliente->telefono = $request->telefono ?? 'N/A';
        $cliente->email = $request->email ?? 'N/A';

        $cliente->save();

        return redirect()->route('cliente.index')->with('success', '¡Cliente creado exitosamente!');
    }

    public function edit($id)
    {
        $user_id = Auth::id();
        $cliente = Cliente::where('user_id', $user_id)->findOrFail($id);

        return view('cliente.edit', compact('cliente'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'dni' => 'required|string|max:8',
            'nombres' => 'required|string|max:50',
            'ap_paterno' => 'required|string|max:50',
            'ap_materno' => 'required|string|max:50',
            'telefono' => 'nullable|string|max:11',
            'email' => 'nullable|string|email|max:255'
        ]);
        $user_id = Auth::id();

        $cliente = Cliente::where('user_id', $user_id)->findOrFail($id);

        $cliente->dni = $request->dni;
        $cliente->nombres = $request->nombres;
        $cliente->ap_paterno = $request->ap_paterno;
        $cliente->ap_materno = $request->ap_materno;
        $cliente->telefono = $request->telefono;
        $cliente->email = $request->email;
        $cliente->save();

        return redirect()->route('cliente.index')->with('success', '¡Cliente actualizado!');
    }


    public function destroy($id)
    {
        try {
            $cliente = Cliente::where('user_id', Auth::id())->findOrFail($id);
            $cliente->delete();

            return redirect()->route('cliente.index')->with('success', '¡Cliente eliminado correctamente!');
        } catch (QueryException $e) {
            // Manejar el error de integridad referencial (1451)
            if ($e->errorInfo[1] === 1451) {
                return redirect()->back()->with('error', 'No se puede eliminar el cliente porque está siendo utilizado en inscripciones registradas.');
            } else {
                // Manejar otros errores de base de datos
                return redirect()->back()->with('error', 'Error al intentar eliminar el cliente.');
            }
        }
    }

    public function export()
    {
        $user_id = Auth::id();
        $clientes = Cliente::where('user_id', $user_id)->get();

        return Excel::download(new ClientesExport($clientes), 'clientes.xlsx');
    }
}
