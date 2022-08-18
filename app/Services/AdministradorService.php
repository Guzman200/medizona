<?php

namespace App\Services;

use App\Models\User;

class AdministradorService {

    /**
     * Actualiza la foto de portada de todos los empleados del administrador
     * 
     *  @param \App\Models\User $administrador
     *  @param String $imagen nombre de la imagen
     * 
     * @return void
     */
    public static function actualizarFotoPortadaEmpleados(User $administrador, $imagen)
    {
        $negocio_id = $administrador->negocio->id;

        User::whereHas('empleadoSucursal.sucursal', function($query) use ($negocio_id){
            
            $query->where('negocio_id', $negocio_id);
            
        })->update([
            'imagen_portada' => $imagen
        ]);

    }

}