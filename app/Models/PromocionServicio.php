<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PromocionServicio extends Model
{
    use HasFactory;
    protected $table = 'promocion_servicio';

    protected $fillable = [
        'nombre',
        'descripcion',
        'precio'
    ];

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function inscripcion(){
        return $this->hasMany(Inscripcion::class);
    }

}
