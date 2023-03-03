<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Molde extends Model
{
    use HasFactory;

    protected $fillable = [
        'nome',
        'escala_id',
        'circunferencia_base',
        'distancia_base'
    ];

    public function escala()
    {
        return $this->belongsTo(Escala::class);
    }
}
