<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Inscripcion extends Model
{
    use HasFactory;

    protected $table = 'inscripcion';

    protected $fillable = [
        'numero_boleta',
        'fecha_emision',
        'fecha_caducidad',
        'monto_costo',
        'monto_pago',
        'monto_deuda'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function cliente()
    {
        return $this->belongsTo(Cliente::class);
    }
    public function categoriaServicio()
    {
        return $this->belongsTo(CategoriaServicio::class);
    }
    public function promocionServicio()
    {
        return $this->belongsTo(PromocionServicio::class);
    }
    public function estado()
    {
        return $this->belongsTo(Estado::class);
    }
}
