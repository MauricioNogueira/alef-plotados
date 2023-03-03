<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Escala extends Model
{
    use HasFactory;

    protected $fillable = [
        'tipo'
    ];
    
    public function moldes()
    {
        return $this->hasMany(Molde::class);
    }
}
