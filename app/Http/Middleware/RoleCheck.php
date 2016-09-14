<?php

namespace App\Http\Middleware;

use App\User;
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
    public function handle($request, Closure $next, $role)
    {


        $data['user'] = Auth::user();

        if(isset( $data['user'] )) {
            $getRole = new User();
            $roleName = $getRole->getRoleType($data['user']->role_id);
            $data['user']['role'] =  $roleName[0]->role;
        }

        $pre_current = url('/');
        $ful_current = url()->current();
        $current = explode($pre_current, $ful_current);

        if($data['user']['role'] == $role) {
             if($current['1'] !== '/home'){
                 return redirect('/home');
             }
        } else {
            if($current['1'] !== '/home/test'){
                return redirect('/home/test');
            }
        }

        return $next($request);
    }
}
