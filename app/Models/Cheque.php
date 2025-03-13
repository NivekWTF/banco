<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Services\Transacciones;

class Cheque extends Model
{
    use HasFactory;

    protected $fillable = ['denominacion', 'cantidad'];

    public static function abrirCaja()
    {
        // Verificar si ya existen billetes en la caja
        if (self::count() > 0) {
            return false; // Indica que ya existen billetes
        }

        $denominaciones = [1000, 500, 200, 100, 50, 20, 10, 5, 2, 1];
        Transacciones::abrirCaja($denominaciones);

        return true; // Indica que se generaron los billetes
    }

    public static function entregarBilletes($importe)
    {
        $denominaciones = [1000, 500, 200, 100, 50, 20, 10, 5, 2, 1];
        return Transacciones::entregarBilletes($importe, $denominaciones);
    }

    public static function agregarBilletes()
    {
        Transacciones::agregarBilletes();
    }
}