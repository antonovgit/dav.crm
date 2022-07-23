<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Auth\Middleware\Authenticate as Middleware;
use Illuminate\Support\Facades\Auth;

class Authenticate extends Middleware
{
    /**
     * Get the path the user should be redirected to when they are not authenticated.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return string|null
     */
    /*protected function redirectTo($request)
    {
        if (! $request->expectsJson()) {
            return route('login');
        }
    }*/
	
	/*//D:\OpS\OpenServer\domains\rdavydov2\Laravel\dav.crm\vendor\laravel\framework\src\Illuminate\Auth\Middleware\Authenticate.php
	//!в handle передается $request, т.е. мы можем из запросом что то делать, фильтровать какие то данные с запроса и т.д. Closure $next - это то что будет после выполненно..т.е. этот $next($request) будет выполнять скорее всего метод контроллера, либо следующий какой то middleware. Т.е. они могут быть какой то цепочкой
	public function handle($request, Closure $next, ...$guards)
    {
        if (!Auth::check()) { //если авторизация не проходит  // check() -вернет истину если пользователь аутентифицирован
            return response(false, 301);
        }

        return $next($request); //т.е. этот $next($request) будет выполнять скорее всего метод контроллера, либо следующий какой то middleware. Т.е. они могут быть какой то цепочкой
    }*/
}
