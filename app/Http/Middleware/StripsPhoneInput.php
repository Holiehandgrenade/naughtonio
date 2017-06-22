<?php

namespace App\Http\Middleware;

use Closure;

class StripsPhoneInput
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
        $input = $request->all();

        if (isset($input['phone'])) {
            $input['phone'] = preg_replace('/[^0-9]/s', '', $input['phone']);
            $request->replace($input);
        }

        return $next($request);
    }
}
