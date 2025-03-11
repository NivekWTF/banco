<?php

use App\Http\Controllers\ChequeController;
use App\Models\Cheque;
use Illuminate\Support\Facades\Route;


Route::post('/abrir-caja', [ChequeController::class, 'abrirCaja'])->name('abrir-caja');
Route::post('/entregar-billetes', [ChequeController::class, 'entregarBilletes'])->name('entregar-billetes');

Route::get('/', function () {
    return view('home');
});

Route::get('/prueba', function(){
    return view('abrir_caja');
});


// Route::get('prueba', function (){
//     $numerosAleatorios = [];

//     for ($i = 0; $i < 3; $i++) {
//         $numeroAleatorio = rand(1, 100); // Genera un número aleatorio entre 1 y 100
//         $numerosAleatorios[] = $numeroAleatorio;
//     }
//     $cheque = new Cheque;

//     $cheque->Denominacion = $numerosAleatorios[0];
//     $cheque->Entregados = $numerosAleatorios[1];
//     $cheque->Existencia = $numerosAleatorios[2];
//     $cheque->save();
//     return $cheque;

// });