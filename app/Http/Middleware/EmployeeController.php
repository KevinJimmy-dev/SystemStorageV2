<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class EmployeeController
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        if(auth()->check() && auth()->user()->level == 1){
            return $next($request);

        } elseif(auth()->check() && auth()->user()->level == 2){
            return redirect('/funcionario');

        } elseif(auth()->check() && auth()->user()->level == 3){
            return redirect('/cordenador');

        } else{
            return redirect('/login');
        }
    }
}
