<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CategoriaServicio extends Model
{
    use HasFactory;

    protected $table = 'categoria_servicio';

    protected $fillable = [
        'id',
        'user_id',
        'nombre',
        'descripcion'
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
