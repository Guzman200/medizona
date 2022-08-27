<?php

use App\Http\Controllers\CustomerController;
use Illuminate\Support\Facades\Route;

/** ============> ENDPOINTS CON AUTENTICACION <============================= */
Route::group(['middleware' => 'auth:sanctum'], function () {

    Route::get('customer', [CustomerController::class, 'index']);

});

