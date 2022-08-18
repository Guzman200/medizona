<?php

namespace App\Services;

use App\Models\Suspencion;
use App\Models\User;

class SuspencionService {

    /**
     * Regresa la ultima suspencion hecha y activa del usuario en caso tenga una suspencion
     * de no tener una suspencion activa regresa null
     * 
     * @return \App\Models\Suspencion $suspencion | null
     * @todo realizar tarea programada para verificar los vencimientos  de las suspenciones
     */
    public static function getSuspencionActiva(User $user)
    {
        $suspencion = Suspencion::activa()->where('user_id', $user->id)->orderBy('fecha_fin', 'DESC')
            ->first();

        return ($suspencion) ? $suspencion : null;
    }

}