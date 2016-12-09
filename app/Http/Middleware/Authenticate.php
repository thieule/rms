<?php

namespace App\Http\Middleware;

use Closure;

class Authenticate
{

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     * @author ThieuLQ
     */
    public function handle($request, Closure $next)
    {

        if (!\App\Authentication\Service::isAuthenticated()) {
            return redirect('login');
        }

        return $next($request);
    }
}
