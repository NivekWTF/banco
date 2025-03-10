<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Caja extends Model
{
    use HasFactory;
    
    protected $table = 'caja';
    protected $fillable = ['sucursal', 'denominacion', 'entregados', 'existencia'];

    // Desactivar la clave primaria incremental
    public $incrementing = false;

    // Desactivar las marcas de tiempo automáticas
    public $timestamps = false;

    // Definir la clave primaria compuesta
    protected $primaryKey = ['sucursal', 'denominacion'];

    // Sobrescribir el método getKeyForSaveQuery para manejar claves primarias compuestas
    protected function setKeysForSaveQuery($query)
    {
        foreach ($this->getKeyName() as $key) {
            $query->where($key, '=', $this->getAttribute($key));
        }

        return $query;
    }
}