<?php

use Illuminate\Support\Facades\Route;


Route::get('/', function () {
    
    return view('dashboard');

})->name('home')->middleware('auth:sanctum');

// Mapeamos todas la rutas posibles y retonarmos
// la vista, ya vue router se encarga de mostrar
// el componente correcto
Route::get('{param?}/{param2?}/{param3?}', function(){
    
    return view('dashboard');
    
})->middleware('auth:sanctum');

