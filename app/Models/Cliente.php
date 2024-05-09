<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cliente extends Model
{
    use HasFactory;

    protected $table = 'cliente';

    protected $fillable = [
        'id',
        'user_id',
        'dni',
        'nombres',
        'ap_paterno',
        'ap_materno',
        'telefono',
        'email'
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
