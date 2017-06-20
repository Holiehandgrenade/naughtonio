<?php

namespace App\Http\Middleware;

use Closure;

class RequiresZip
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
        if ( ! \Auth::user()->zip) {
            // put intended url into session
            session()->put('url.intended', $request->url());

            // redirect to zip
            return redirect('/zip');
        }

        return $next($request);
    }
}
