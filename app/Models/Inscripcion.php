<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Inscripcion extends Model
{
    use HasFactory;

    protected $table = 'inscripcion';

    protected $fillable = [
        'id',
        'user_id',
        'numero_boleta',
        'cliente_id',
        'categoria_servicio_id',
        'promocion_servicio_id',
        'metodo_pago_id',
        'estado_id',
        'fecha_emision',
        'fecha_caducidad',
        'monto_costo',
        'monto_pago',
        'monto_deuda'
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
    public function cliente()
    {
        return $this->belongsTo(Cliente::class, 'cliente_id');
    }
    public function categoriaServicio()
    {
        return $this->belongsTo(CategoriaServicio::class, 'categoria_servicio_id');
    }
    public function promocionServicio()
    {
        return $this->belongsTo(PromocionServicio::class, 'promocion_servicio_id');
    }
    public function metodoPago()
    {
        return $this->belongsTo(MetodoPago::class, 'metodo_pago_id');
    }
    public function estado()
    {
        return $this->belongsTo(Estado::class, 'estado_id');
    }

    //Store procedures
    public static function superUpdate(
        $id,
        $userId,
        $numero_boleta,
        $servicio_id,
        $promocion_id,
        $metodo_pago_id,
        $estado_id,
        $fecha_caducidad,
        $monto_pago,
        $monto_deuda,
    ) {
        return DB::statement(
            'call sp_actualizar_inscripcion(?,?,?,?,?,?,?,?,?,?)',
            [
                $id, // Id inscripcion
                $userId, // Usuario atutenticado
                $numero_boleta, // Numero boleta
                $servicio_id, // Servicio id
                $promocion_id, // Promocion id
                $metodo_pago_id, // Metodo pago id
                $estado_id, // Estado id
                $fecha_caducidad, // Fecha caducidad
                $monto_pago, // Monto pago
                $monto_deuda // Monto deuda
            ]
        );
    }
}
