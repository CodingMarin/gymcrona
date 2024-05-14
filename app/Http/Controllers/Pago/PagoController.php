<?php

namespace App\Http\Controllers\Pago;

use App\Http\Controllers\Controller;
use App\Models\Pago;
use Illuminate\Support\Facades\Auth;

class PagoController extends Controller
{
    public function index()
    {
        $userId = Auth::id();
        $pagos = Pago::where('user_id', $userId)
            ->orderBy('created_at', 'desc')
            ->paginate(7);

        return view('ingreso.index', compact('pagos'));
    }
}
