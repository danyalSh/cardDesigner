<?php

namespace App\Http\Middleware;

use App\User;
use Closure;

class RolesAndPermissions
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $action = $request->route()->getAction();
        $permission = $action['permission']? $action['permission'] : '';
        $this->usersRoles =  new User();
        if ($this->usersRoles->hasPermission($permission, $request)) {
            return $next($request);
        }
        return response(collect([
            'status'=> 'failure',
            'message' => 'not authorized'
        ]));
    }
}
