<?php

namespace App\Http\Middleware;

use Closure;

class RequiresPhone
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if ( ! \Auth::user()->phone) {
            // redirect to update phone
            return redirect('/phone');
        }
        return $next($request);
    }
}
