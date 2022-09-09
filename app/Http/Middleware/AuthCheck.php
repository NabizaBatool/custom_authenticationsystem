<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class AuthCheck
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
        // login nhi hai and url is other than login and logout
        if(!session()->has('LoggedUser') && ($request->path() !='auth/login' && $request->path() !='auth/register' )){
            return redirect('auth/login')->with('fail','You must be logged in');
        }

        if(session()->has('LoggedUser') && ($request->path() == 'auth/login' || $request->path() == 'auth/register' ) ){
            return back();
        }
        return $next($request);
    }
}
