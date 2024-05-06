<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Estado extends Model
{
    use HasFactory;

    protected $table = 'estado';


    protected $fillable = [
        'nombre'
    ];

    public function inscripcion()
    {
        return $this->hasMany(Inscripcion::class);
    }
}
