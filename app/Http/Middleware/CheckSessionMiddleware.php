<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Session;

class CheckSessionMiddleware
{
    public function handle($request, Closure $next)
    {

        $isAuth = Session::has('EmployeeID');
         if ($isAuth === false || $isAuth === '') {
            return redirect()->route('login');
        } else {
            return $next($request);
        }
    }
}