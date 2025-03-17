<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Illuminate\Routing\Router;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        function (Router $router) {
            // $router->middleware('api')
            // ->prefix('api')
            // ->group(base_path('routes/api.php'));

            $router->middleware('web')
            ->group(base_path('routes/web.php'));

            $router->middleware('web')
            ->group(base_path('routes/admin.php'));

           $router->middleware('web')
          ->group(base_path('routes/client.php'));

          $router->middleware('web')
         ->group(base_path('routes/seller.php'));
},
        commands: __DIR__.'/../routes/console.php',
        health: '/up',

)->withMiddleware(function(Middleware $middleware){
    $middleware->alias([
        'preventBackHistory' => App\Http\Middleware\PreventBackHistory::class
    ]);
})


 
    ->withExceptions(function (Exceptions $exceptions) {


        
        //
    })->create();
