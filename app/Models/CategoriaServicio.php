<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CategoriaServicio extends Model
{
    use HasFactory;

    protected $table = 'categoria_servicio';

    protected $fillable = [
        'nombre',
        'descripcion'
    ];

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function inscripcion(){
        return $this->hasMany(Inscripcion::class);
    }
}
