<?php

namespace App\Listeners;

use App\Events\UserLogin;
use App\Models\BitacoraIngreso;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Log;

class RegistrarIngreso
{

    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
    
    }

    /**
     * Handle the event.
     *
     * @param  object  $event
     * @return void
     */
    public function handle(UserLogin $event)
    {

        
        BitacoraIngreso::create([
            'user_id' => $event->user->id,
            'entrada' => Carbon::now(),
        ]);
             
    }
}
