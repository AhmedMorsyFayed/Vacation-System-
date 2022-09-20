<?php


namespace App\Http\Middleware;


use Illuminate\Http\Request;
use Closure;


class HR
{

    public function handle(Request $request, Closure $next)
    {
        if (Auth()->user()->level == 'HR') {
            return $next($request);
        }
        return redirect('home');
    }


}
