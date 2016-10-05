<?php

namespace App\Http\Middleware;

use App\Models\User;
use Closure;
use Illuminate\Support\Facades\Auth;


class RoleCheck
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
        if ($request->user() === null) {
            return redirect()->route('login');
        }

        $action = $request->route()->getAction();
        $roles = isset($action['roles']) ? $action['roles'] : null;

        if($request->user()->hasAnyRole($roles) || !$roles) {
            return $next($request);
        }

        return response('У вас нет прав для просмотра этой страцниы', 401);
    }

}
