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
            // put intended url into session
            session()->put('url.intended', $request->url());

            // redirect to post phone
            return redirect('/phone');
        }

        return $next($request);
    }
}
