<?php

namespace App\Http\Middleware;

use App\Models\User;
use Closure;
use Illuminate\Http\Request;
use Laravel\Sanctum\PersonalAccessToken;

class verifJetStreamToken
{
    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Closure $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        if (isset($request->header()['authorization'])) {

            $permissions = PersonalAccessToken::findToken($request->bearerToken())->getAttribute('abilities');

            if ($request->getMethod() == 'POST') {
                if (in_array("create", $permissions)) {
                    return $next($request);
                } else {
                    return abort(401);
                }
            } elseif ($request->getMethod() == 'PUT') {
                if (in_array("update", $permissions)) {
                    return $next($request);
                } else {
                    return abort(401);
                }
            } elseif ($request->getMethod() == 'DELETE') {
                if (in_array("delete", $permissions)) {
                    return $next($request);
                } else {
                    return abort(401);
                }
            } else {
                return $next($request);
            }

        } else {
            return $next($request);
        }

    }
}
