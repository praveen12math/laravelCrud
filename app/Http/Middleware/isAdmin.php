<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

use Session;

class isAdmin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        if(Session::get('userRole') == "user"){
            return redirect("/user");
        };

        return $next($request);
    }
}
