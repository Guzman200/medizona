<?php

use App\Http\Controllers\Autenticacion\InicioSesionController;
use Illuminate\Support\Facades\Route;


Route::post('login', [InicioSesionController::class, 'login']);

Route::post('register', [InicioSesionController::class, 'register']);

/** ============> ENDPOINTS CON AUTENTICACION <============================= */
Route::group(['middleware' => 'auth:sanctum'], function () {

    Route::post('logout', [InicioSesionController::class, 'logout']);

});