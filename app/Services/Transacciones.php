<?php
namespace App\Services;

use Illuminate\Support\Facades\DB;
use App\Models\Cheque;

class Transacciones
{
    public static function abrirCaja($denominaciones)
    {
        DB::transaction(function () use ($denominaciones) {
            foreach ($denominaciones as $denominacion) {
                Cheque::create([
                    'denominacion' => $denominacion,
                    'cantidad' => rand(1, 100) // Genera una cantidad aleatoria de billetes
                ]);
            }
        });
    }

    public static function entregarBilletes($importe, $denominaciones)
    {
        $billetesEntregados = [];

        DB::transaction(function () use ($importe, $denominaciones, &$billetesEntregados) {
            foreach ($denominaciones as $denominacion) {
                if ($importe >= $denominacion) {
                    $billete = Cheque::where('denominacion', $denominacion)->lockForUpdate()->first();
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
                $billete = Cheque::where('denominacion', $denominaciones[count($denominaciones) - 1])->lockForUpdate()->first();
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
                $billete = Cheque::where('denominacion', $denominacion)->lockForUpdate()->first();
                if ($billete) {
                    // Si ya existe, sumar la cantidad
                    $billete->cantidad += rand(1, 100);
                    $billete->save();
                } else {
                    // Si no existe, crear un nuevo registro
                    Cheque::create([
                        'denominacion' => $denominacion,
                        'cantidad' => rand(1, 100)
                    ]);
                }
            }
        });
    }
}