<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class MetodoPago extends Model
{
    use HasFactory;

    protected $table = 'metodo_pago';

    protected $fillable = [
        'id',
        'user_id',
        'brand_id',
        'foto_qr'
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function brand()
    {
        return $this->belongsTo(Brand::class, 'brand_id');
    }

    /**
     * Store procedure
     */

    static public function superInsert($user_id, $brand_id, $foto_qr)
    {
        return DB::statement('call sp_insertar_metodo_pago(?,?,?)', [$user_id, $brand_id, $foto_qr]);
    }
}
