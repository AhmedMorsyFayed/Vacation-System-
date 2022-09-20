<?php


namespace App\Http\Middleware;

use Closure;


use Illuminate\Http\Request;


class Admin
{

    public function handle(Request $request, Closure $next)
    {
        if (Auth()->user()->level == 'Admin') {
            return $next($request);
        }
        return redirect('home');
    }

}
