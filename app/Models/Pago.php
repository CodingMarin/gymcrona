<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pago extends Model
{
    use HasFactory;

    protected $table = 'pago';

    protected $fillable = [
        'id',
        'user_id',
        'metodo_id',
        'producto_servicio',
        'monto',
    ];

    public function metodoPago()
    {
        return $this->belongsTo(MetodoPago::class, 'metodo_id');
    }

    public function categoriaServicio()
    {
        return $this->belongsTo(CategoriaServicio::class, 'servicio_id');
    }

    public function promocionServicio()
    {
        return $this->belongsTo(PromocionServicio::class, 'promocion_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
