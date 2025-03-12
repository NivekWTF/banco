<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

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
        DB::transaction(function () use ($denominaciones) {
            foreach ($denominaciones as $denominacion) {
                self::create([
                    'denominacion' => $denominacion,
                    'cantidad' => rand(1, 100) // Genera una cantidad aleatoria de billetes
                ]);
            }
        });

        return true; // Indica que se generaron los billetes
    }

    public static function entregarBilletes($importe)
    {
        // Imprimir en el log de Laravel
        Log::info('Importe en entregarBilletes: ' . $importe);

        $denominaciones = [1000, 500, 200, 100, 50, 20, 10, 5, 2, 1];
        $billetesEntregados = [];

        DB::transaction(function () use ($importe, $denominaciones, &$billetesEntregados) {
            foreach ($denominaciones as $denominacion) {
                if ($importe >= $denominacion) {
                    $billete = self::where('denominacion', $denominacion)->first();
                    if ($billete && $billete->cantidad > 0) {
                        $cantidad = min(intdiv($importe, $denominacion), $billete->cantidad);
                        $importe -= $cantidad * $denominacion;
                        $billete->cantidad -= $cantidad;
                        $billete->save();

                        $billetesEntregados[] = [
                            'denominacion' => $denominacion,
                            'cantidad' => $cantidad
                        ];
                    }
                }
            }

            // Asegurar que se entregue al menos una denominación
            if (empty($billetesEntregados)) {
                $billete = self::where('denominacion', $denominaciones[count($denominaciones) - 1])->first();
                if ($billete && $billete->cantidad > 0) {
                    $billete->cantidad -= 1;
                    $billete->save();

                    $billetesEntregados[] = [
                        'denominacion' => $billete->denominacion,
                        'cantidad' => 1
                    ];
                }
            }
        });

        return $billetesEntregados;
    }

    public static function agregarBilletes()
    {
        $denominaciones = [1000, 500, 200, 100, 50, 20, 10, 5, 2, 1];
        DB::transaction(function () use ($denominaciones) {
            foreach ($denominaciones as $denominacion) {
                $billete = self::where('denominacion', $denominacion)->first();
                if ($billete) {
                    // Si ya existe, sumar la cantidad
                    $billete->cantidad += rand(1, 100);
                    $billete->save();
                } else {
                    // Si no existe, crear un nuevo registro
                    self::create([
                        'denominacion' => $denominacion,
                        'cantidad' => rand(1, 100)
                    ]);
                }
            }
        });
    }
}