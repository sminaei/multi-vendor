<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Routing\Controllers\Middleware;
use Symfony\Component\HttpFoundation\Response;

class Authenticate extends Middleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    protected function redirectTo(Request $request, Closure $next): ?string
    {
       if (!$request->expectsJson()){
           if ($request->routeIs('admin.*')){
               session()->flash('failed','you must login first');
               return route('admin.login');
           }
           if ($request->routeIs('seller,*')){
               session()->flash('fail','you must login first');
               return route('seller.login');
           }
       }
    }
}
