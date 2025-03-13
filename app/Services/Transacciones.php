<?php
namespace App\Services;

use Illuminate\Support\Facades\DB;
use App\Models\Cheque;
use Illuminate\Support\Facades\Log;

class Transacciones
{
    public static function abrirCaja($denominaciones)
    {
        DB::transaction(function () use ($denominaciones) {
            foreach ($denominaciones as $denominacion) {
                Cheque::create([
                    'sucursal' => 1,
                    'denominacion' => $denominacion,
                    'cantidad' => rand(1, 100), // Genera una cantidad aleatoria de billetes
                    'entregados' => 0
                ]);
            }
        });
    }

    public static function entregarBilletes($importe, $denominaciones)
    {
        $billetesEntregados = [];

        // Verificar si hay suficiente dinero en la caja
        $totalDisponible = Cheque::sum(DB::raw('denominacion * cantidad'));
        if ($importe > $totalDisponible) {
            return ['error' => 'No hay suficiente dinero en la caja para entregar el importe solicitado.'];
        }

        DB::transaction(function () use ($importe, $denominaciones, &$billetesEntregados) {
            foreach ($denominaciones as $denominacion) {
                if ($importe >= $denominacion) {


                    $billete = Cheque::where('denominacion', $denominacion)->where('sucursal', 1)->lockForUpdate()->first();
                                                // Imprimir en el log de Laravel
                                                Log::info('Billete: ' . $billete);
        
                                                // Imprimir en la consola del navegador
                                                            echo "<script>console.log('Billete; " . $billete . "');</script>";
                    if ($billete && $billete->cantidad > 0) {
                        $cantidad = min(intdiv($importe, $denominacion), $billete->cantidad);
                        $importe -= $cantidad * $denominacion;
                        $billete->cantidad -= $cantidad;
                        $billete->entregados += $cantidad;
                        $billete->save();

                        $billetesEntregados[] = [
                            'denominacion' => $denominacion,
                            'cantidad' => $cantidad
                        ];
                    }
                }
            }

            // Asegurar que se entregue al menos una denominación
            // if (empty($billetesEntregados)) {
            //     $billete = Cheque::where('denominacion', $denominaciones[count($denominaciones) - 1])->where('sucursal', 1)->lockForUpdate()->first();
            //     if ($billete && $billete->cantidad > 0) {
            //         $billete->cantidad -= 1;
            //         $billete->entregados += 1;
            //         $billete->save();

            //         $billetesEntregados[] = [
            //             'denominacion' => $billete->denominacion,
            //             'cantidad' => 1
            //         ];
            //     }
            // }
        });

        return $billetesEntregados;
    }

    public static function agregarBilletes()
    {
        $denominaciones = [1000, 500, 200, 100, 50, 20, 10, 5, 2, 1];
        DB::transaction(function () use ($denominaciones) {
            foreach ($denominaciones as $denominacion) {
                $billete = Cheque::where('denominacion', $denominacion)->where('sucursal', 1)->lockForUpdate()->first();
                if ($billete) {
                    // Si ya existe, sumar la cantidad
                    $billete->cantidad += rand(1, 100);
                    $billete->save();
                } 
            }
        });
    }
}