<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pago extends Model
{
    use HasFactory;

    protected $fillable = [
        'metodo_id',
        'promocion_id',
        'monto'
    ];

    public function metodoPago()
    {
        return $this->belongsTo(MetodoPago::class);
    }

    public function promocionServicio()
    {
        return $this->belongsTo(PromocionServicio::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
