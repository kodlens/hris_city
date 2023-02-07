<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Auth;



class CidMiddleware
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
        
        if($user->role === 'CID'){
            return $next($request);
        }

        abort(403);
    }
}
