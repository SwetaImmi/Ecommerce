<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class CheckRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (Auth::check()) {
            if (Auth::user()->role == 'Admin') { // if the current role is Administrator
                return $next($request);
            }elseif(Auth::user()->role == 'User'){
                return $next($request);
            }
        }
        // return redirect('/');
        abort(403, "Cannot access to restricted page");
        return $next($request);
    }
}
