<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CajaController;

Route::get('/abrir-caja', [CajaController::class, 'abrirCaja']);


Route::get('/sucursal', function () {
    return view('app');
});
