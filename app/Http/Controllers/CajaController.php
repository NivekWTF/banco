<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Caja;
use App\Models\ControlCaja;

class CajaController extends Controller
{
    public function abrirCaja()
    {
        // Verificar si la caja ya está abierta
        $control = ControlCaja::first();

        if ($control->estatus) {
            return response()->json(['mensaje' => 'La caja ya está abierta'], 400);
        }

        // Denominaciones de billetes y monedas
        $denominaciones = [1000, 500, 200, 100, 50, 20, 10, 5, 2, 1];

        // Insertar o actualizar valores aleatorios de la caja
        foreach ($denominaciones as $denominacion) {
            Caja::updateOrCreate(
                ['sucursal' => 1, 'denominacion' => $denominacion],
                ['entregados' => 1, 'existencia' => rand(1, 100)]
            );
        }

        // Marcar la caja como abierta
        $control->estatus = true;
        $control->save();

        return response()->json(['mensaje' => 'Caja abierta correctamente'], 200);
    }
}