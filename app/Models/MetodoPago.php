<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MetodoPago extends Model
{
    use HasFactory;

    protected $table = 'metodo_pago';

    protected $fillable = [
        'nombre',
        'descripcion'
    ];

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function pago(){
        return $this->hasMany(Pago::class);
    }
}
