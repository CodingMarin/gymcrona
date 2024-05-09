<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PromocionServicio extends Model
{
    use HasFactory;
    protected $table = 'promocion_servicio';

    protected $fillable = [
        'id',
        'user_id',
        'nombre',
        'descripcion',
        'precio'
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
