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
        'metodo_id',
        'servicio_id',
        'promocion_id',
        'monto',
        'created_at',
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
