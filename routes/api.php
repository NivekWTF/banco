<?php
use App\Http\Controllers\BilleteController;

Route::post('/cambiar-cheque', [BilleteController::class, 'cambiarCheque']);
