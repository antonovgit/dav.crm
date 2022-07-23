<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    //public function handle(Request $request, Closure $next)
    public function handle(Request $request, Closure $next, ...$roles)
    {
        //dd($roles);
		/*if (Auth::user()->hasAnyRole('admin')) { //проверяю что у меня есть роль 'admin'
            return $next($request);
        }*/
		if (Auth::user()->hasAnyRole($roles)) { //укажем параметром $roles какую роль ему проверять..не только жестко админ
            return $next($request);
        }

        return response(false, 403);
    }
}