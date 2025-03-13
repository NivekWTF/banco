<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cheque;
use Illuminate\Support\Facades\Log;

class ChequeController extends Controller
{
    public function abrirCaja()
    {
        $resultado = Cheque::abrirCaja();
        if ($resultado) {
            return redirect()->back()->with('success', 'Caja abierta con éxito y billetes generados.');
        } else {
            return redirect()->back()->with('error', 'La caja ya ha sido abierta anteriormente.');
        }
    }

    public function entregarBilletes(Request $request)
    {
        $importe = $request->input('importe');
        
        // Imprimir en el log de Laravel
        Log::info('Importe recibido: ' . $importe);
        
        // Imprimir en la consola del navegador
        echo "<script>console.log('Importe recibido: " . $importe . "');</script>";
        
        $billetesEntregados = Cheque::entregarBilletes($importe);

        return view('abrir_caja', compact('billetesEntregados'))->with('info', 'Billetes entregados.');
    }

    public function agregarBilletes()
    {
        Cheque::agregarBilletes();
        return redirect()->back()->with('success', 'Billetes agregados con éxito.');
    }
}