<?php

namespace App\Providers;

use App\Events\UserLogin;
use App\Events\UserLogout;
use App\Listeners\RegistrarIngreso;
use App\Listeners\RegistrarSalida;
use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        UserLogin::class => [
            RegistrarIngreso::class
        ],
        UserLogout::class => [
            RegistrarSalida::class
        ]
    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
