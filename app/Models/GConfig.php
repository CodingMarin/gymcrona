<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GConfig extends Model
{
    use HasFactory;

    protected $table = 'gc_config';

    protected $fillable = [
        'id',
        'user_id',
        'name_printer'
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
