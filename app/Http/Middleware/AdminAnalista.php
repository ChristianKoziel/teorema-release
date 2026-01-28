<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AdminAnalista
{
    public function handle(Request $request, Closure $next): Response
    {
        if (!auth()->check() || !in_array(auth()->user()->role, ['admin', 'analista'])) {
            abort(403, 'Acesso não autorizado. Apenas administradores e analistas podem acessar esta área.');
        }
        
        return $next($request);
    }
}