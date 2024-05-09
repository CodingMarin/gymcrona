<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Producto extends Model
{
    use HasFactory;

    protected $table = 'producto';

    protected $fillable = [
        'id',
        'nombre',
        'descripcion',
        'precio',
        'stock',
        'marca',
        'foto_url',
        'user_id',
        'categoria_id',
        'estado'
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function categoriaProducto()
    {
        return $this->belongsTo(CategoriaProducto::class, 'categoria_id');
    }
}
