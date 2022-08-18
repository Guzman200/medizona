<?php

namespace App\Listeners;

use App\Models\BitacoraIngreso;
use Carbon\Carbon;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class RegistrarSalida
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  object  $event
     * @return void
     */
    public function handle($event)
    {
        $bitacora = BitacoraIngreso::where('user_id', $event->user->id)->orderBy('created_at', 'DESC')->first();

        if($bitacora){
            $bitacora->salida = Carbon::now();
            $bitacora->update();
        }
    }
}
