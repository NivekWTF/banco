<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Billete extends Model
{
    use HasFactory;

    protected $table = 'billetes';

    protected $fillable = ['sucursal', 'denominacion', 'entregados', 'existencia'];

    // Relación: Un billete pertenece a una sucursal
    public function sucursal()
    {
        return $this->belongsTo(Sucursal::class, 'sucursal', 'id');
    }
}

