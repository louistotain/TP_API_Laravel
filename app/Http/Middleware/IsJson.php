<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class IsJson
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
        if ($request->expectsJson()) {
            return $next($request);
        } else {
            abort('404');
        }
    }
}
