<?php

namespace App\Http\Middleware;

use Closure;
use http\Client\Response;
use Illuminate\Http\Request;


class RoleMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */

    public function handle(Request $request, Closure $next, string $role) : \Symfony\Component\HttpFoundation\Response
    {
        if (auth()->check() && auth()->user()->type->value == $role) {
            return $next($request);
        }

        abort(403);
    }
}
