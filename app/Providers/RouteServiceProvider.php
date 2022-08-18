<?php

namespace App\Providers;

use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Facades\Route;

class RouteServiceProvider extends ServiceProvider
{
    /**
     * The path to the "home" route for your application.
     *
     * This is used by Laravel authentication to redirect users after login.
     *
     * @var string
     */
    public const HOME = '/';

    /**
     * Define your route model bindings, pattern filters, etc.
     *
     * @return void
     */
    public function boot()
    {
        $this->configureRateLimiting();

        $this->routes(function () {


            /** Api */

            /*Route::prefix('api')
                ->middleware('api')
                ->group(base_path('routes/api.php'));*/

            Route::prefix('api')
                ->middleware('api')
                ->group(base_path('routes/api/autenticacion.php'));

            Route::prefix('api')
                ->middleware('api')
                ->group(base_path('routes/api/user.php'));

            Route::prefix('api')
                ->middleware('api')
                ->group(base_path('routes/api/categorias.php'));

            Route::prefix('api')
                ->middleware('api')
                ->group(base_path('routes/api/tareas.php'));

            /** Web */

            Route::middleware('web')
                ->group(base_path('routes/web/autenticacion.php'));
                    
            Route::middleware('web')
                ->group(base_path('routes/web.php'));
        });
    }

    /**
     * Configure the rate limiters for the application.
     *
     * @return void
     */
    protected function configureRateLimiting()
    {
        RateLimiter::for('api', function (Request $request) {
            return Limit::perMinute(60);
        });
    }
}
