<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Symfony\Component\HttpFoundation\Response;

class isAdmin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function handle(Request $request, Closure $next): Response
    {
        $token = $request->header('Authorization');
        Log::info('token' . $token);

        if ($token) {
            $user = auth()->user();
            $id = Auth::id();
            if ($user && $user->is_admin) {
                return $next($request);
            } else {
                return response()->json(['message' => 'Utente non autorizzato'], 403);
            }
        }
    }
}
