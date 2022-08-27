<?php

use App\Http\Controllers\CategoriasController;
use App\Http\Controllers\NoteController;
use Illuminate\Support\Facades\Route;

/** ============> ENDPOINTS CON AUTENTICACION <============================= */
Route::group(['middleware' => 'auth:sanctum'], function () {

    Route::get('notes', [NoteController::class, 'index']);
    Route::post('notes', [NoteController::class, 'store']);
    Route::delete('notes/{note}', [NoteController::class, 'destroy']);
    Route::put('notes/{note}', [NoteController::class, 'update']);
    Route::get('notes/{note}', [NoteController::class, 'show']);
    Route::get('items', [NoteController::class, 'getItems']);
    Route::get('customers', [NoteController::class, 'getCustomers']);

});

