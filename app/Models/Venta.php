<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

use function PHPSTORM_META\map;

class Venta extends Model
{
    use HasFactory;

    protected $table = 'ventas';

    protected $fillable = [
        'id',
        'user_id',
        'cliente_id',
        'producto_id',
        'metodo_pago_id',
        'monto_total',
        'fecha_venta',
        'observaciones',
        'estado'
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function cliente()
    {
        return $this->belongsTo(Cliente::class, 'cliente_id');
    }

    public function producto()
    {
        return $this->belongsTo(Producto::class, 'producto_id');
    }

    public function metodoPago()
    {
        return $this->belongsTo(MetodoPago::class, 'metodo_pago_id');
    }

    /**
     * Store procedures
     */
    public static function superSelect($user_id)
    {
        return DB::select('call sp_listar_ventas(?)', [$user_id]);
    }

    public static function superInsert($user_id, $cliente_id, $producto_id, $metodo_pago_id, $monto_total, $observaciones)
    {
        return DB::statement('call sp_registrar_venta(?,?,?,?,?,?)', [
            $user_id,
            $cliente_id,
            $producto_id,
            $metodo_pago_id,
            $monto_total,
            $observaciones
        ]);
    }
}
