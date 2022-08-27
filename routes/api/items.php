<?php

use App\Http\Controllers\CustomerController;
use App\Http\Controllers\ItemController;
use Illuminate\Support\Facades\Route;

/** ============> ENDPOINTS CON AUTENTICACION <============================= */
Route::group(['middleware' => 'auth:sanctum'], function () {

    Route::get('items', [ItemController::class, 'search']);

});

