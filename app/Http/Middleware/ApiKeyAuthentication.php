<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ApiKeyAuthentication
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */

    public function handle(Request $request, Closure $next): Response
    {
        // return $next($request);
        $apiKey = $request->header('X-API-Key');

        if (!$apiKey  ||  !($apiKey === "you+qualify+here")) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }

        return $next($request);
    }
}
