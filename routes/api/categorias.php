<?php

use App\Http\Controllers\CategoriasController;
use Illuminate\Support\Facades\Route;

/** ============> ENDPOINTS CON AUTENTICACION <============================= */
Route::group(['middleware' => 'auth:sanctum'], function () {

    Route::get('categorias', [CategoriasController::class, 'index']);

});

