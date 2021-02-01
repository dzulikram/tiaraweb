<?php

namespace App\Http\Middleware;

use Closure;

class BasicAuthenticate
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
        if (config('basicauth.users')->contains([$request->getUser(), $request->getPassword()])) {
            return $next($request);
        }
        return response('You shall not pass!', 401, ['WWW-Authenticate' => 'Basic']);
    }
}
