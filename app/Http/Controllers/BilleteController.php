<?php

namespace App\Http\Controllers;

use App\Models\Billete;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class BilleteController extends Controller
{
    public function cambiarCheque(Request $request) {
        $importe = $request->importe;
        $sucursal = $request->sucursal;

        DB::beginTransaction(); // 🔹 Inicia una transacción

        try {
            $denominaciones = Billete::where('sucursal', $sucursal)
                                    ->orderBy('denominacion', 'desc')
                                    ->get();

            $billetesEntregados = [];

            foreach ($denominaciones as $billete) {
                if ($importe == 0) break;

                // 🔹 Bloqueo pesimista: bloqueamos la fila hasta que termine la transacción
                $billete = Billete::where('id', $billete->id)->lockForUpdate()->first();

                $cantidad = min(floor($importe / $billete->denominacion), $billete->existencia);
                if ($cantidad > 0) {
                    $billete->existencia -= $cantidad;
                    $billete->entregados += $cantidad;
                    $billete->save(); // 🔹 Guarda los cambios antes de liberar el bloqueo

                    $billetesEntregados[$billete->denominacion] = $cantidad;
                    $importe -= $cantidad * $billete->denominacion;
                }
            }

            DB::commit(); // 🔹 Confirma la transacción

            return response()->json($billetesEntregados);
        } catch (\Exception $e) {
            DB::rollBack(); // 🔹 Revertimos la transacción en caso de error
            return response()->json(["error" => "Error en la transacción"], 500);
        }
    }
}

