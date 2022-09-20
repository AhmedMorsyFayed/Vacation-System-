<?php


namespace App\Http\Middleware;


use Closure;
use Illuminate\Http\Request;

class Manager
{


    public function handle(Request $request, Closure $next)
    {
        if ((Auth()->user()->level == 'TopManager') or (Auth()->user()->level == 'Manager')) {
            return $next($request);
        }
        return redirect('home');
    }

}
