<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Tymon\JWTAuth\Facades\JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;

class EnsureTokenIsValid
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
        try {
            // Intentar autenticar al usuario con el token JWT
            $user = JWTAuth::parseToken()->authenticate();
        } catch (JWTException $e) {
            // Token no válido o problema al autenticar
            return response()->json(['error' => 'Token no válido o expirado'], 401);
        }

        // Continuar con la solicitud si el token es válido
        return $next($request);
    }
}
