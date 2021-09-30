<?php

namespace App\Http\Middleware;

use Closure;
//use Illuminate\Contracts\Session\Session;
use Illuminate\Http\Request;
use Session;

class CustomAuth
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
        $path = $request->path();

        if ((Session()->has('userId')) && ($path == "login" || $path == "register")) {
            return redirect('/user');
            //echo Session::get('userID');
        } else if (!(Session()->has('userId')) && ($path != "login" && $path != "register")) {
            return redirect('/login');
        }

        // $path = $request->path();
        // echo Session::get('user');
        // if((($path == "login") || ($path == "register")) && (Session::get('user'))){
        //     echo $path;
        // }
        return $next($request);
    }
}
