<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminMiddleware
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
        $user = Auth::user();
        if($user->role === 'ADMINISTRATOR'){
            return $next($request);
        }

        if($user->role === 'EMPLOYER'){
            return redirect('/employer/dashboard');
        }

        if($user->role === 'USER' || $user->role === 'EMPLOYEE'){
            return redirect('/employee/dashboard');
        }

        abort(403);
    }
}
