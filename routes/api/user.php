<?php

use App\Http\Controllers\Autenticacion\InicioSesionController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

/** ============> ENDPOINTS CON AUTENTICACION <============================= */
Route::group(['middleware' => 'auth:sanctum'], function () {

    Route::post('user/update/{user}', [UserController::class, 'update']);

});

