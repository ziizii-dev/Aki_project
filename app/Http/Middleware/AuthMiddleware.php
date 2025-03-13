<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class AuthMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, string $param = 'user'): Response
    {

        $user = $request->user();

        $role = '';

        if(Auth::guard('web')->check()) {
            $role = 'user';
        }

        if(Auth::guard('admin')->check()) {
            $role = 'admin';
        }
     

        if($user &&  $param != $role ) {
            return redirect( $param === 'admin' ? '/dashboard' : "/login" );
        }

        if(!$user) {
            return redirect( $param === 'admin' ? '/login' : "/login" );
        }   
        


        return $next($request);
    }
}