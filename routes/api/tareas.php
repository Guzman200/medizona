<?php

use App\Http\Controllers\CategoriasController;
use App\Http\Controllers\TareasController;
use Illuminate\Support\Facades\Route;

/** ============> ENDPOINTS CON AUTENTICACION <============================= */
Route::group(['middleware' => 'auth:sanctum'], function () {

    Route::post('tareas', [TareasController::class, 'store']);
    Route::post('tareas/{tarea}', [TareasController::class, 'marcarComoRealizada']);
    Route::post('tareas/edit/{tarea}', [TareasController::class, 'update']);
    Route::delete('tareas/{tarea}', [TareasController::class, 'delete']);
    Route::get('tareas', [TareasController::class, 'index']);
    Route::get('tareas/{tarea}', [TareasController::class, 'show']);

});

