<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Producto extends Model
{
    use HasFactory;

    protected $table = 'producto';

    protected $fillable = [
        'nombre',
        'descripcion',
        'precio',
        'stock',
        'marca',
        'foto_url',
        'estado'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function categoriaProducto()
    {
        return $this->belongsTo(CategoriaProducto::class, 'categoria_id');
    }
}
