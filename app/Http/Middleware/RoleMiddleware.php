<?php
namespace App\Http\Middleware;

use Closure;
use App\ACL\Service as AclService;

class RoleMiddleware
{
    
    /**
     * Run the request filter.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string  $role
     * @return mixed
     */
    public function handle($request, Closure $next, $role)
    {
        AclService::setRole($role);
        $hasPermission = AclService::checkPermission();
        if(!$hasPermission) {
           return redirect('error401'); 
        }
        return $next($request);
    }

}