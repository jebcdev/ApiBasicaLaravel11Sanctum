<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AdminMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        /* Verificar si el usuario en sesion esta autenticado y es un admin */

        $user = $request->user();

        if (!$user || !$user->isAdmin) {
            return abort(403, 'Unauthorized');
        }

        return $next($request);
    }
}
