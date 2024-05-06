<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Inscripcion extends Model
{
    use HasFactory;

    protected $table = 'inscripcion';

    protected $fillable = [
        'user_id',
        'numero_boleta',
        'cliente_id',
        'categoria_servicio_id',
        'promocion_servicio_id',
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
    public function estado()
    {
        return $this->belongsTo(Estado::class, 'estado_id');
    }
}
