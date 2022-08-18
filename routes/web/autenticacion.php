<?php

use App\Http\Controllers\Autenticacion\InicioSesionController;
use Illuminate\Support\Facades\Route;

Route::get('inicio-sesion', [InicioSesionController::class, 'index'])
    ->name('login');


Route::get('cambio-password/{token?}/{email?}', [InicioSesionController::class, 'index'])
    ->name('cambiar_password');