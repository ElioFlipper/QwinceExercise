<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class Cors
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $response = $next($request);

        // Aggiungi l'header "Access-Control-Allow-Headers" per consentire l'header "X-CSRF-TOKEN"
        $response->headers->set('Access-Control-Allow-Headers', 'Content-Type, X-CSRF-TOKEN');

        return $response;
    }
}
