<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckForm
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if ($request->is('post') && 
            ($request->is('multipart/form-data') || 
             $request->is('application/x-www-form-urlencoded'))) {
            return $next($request);
        } else {
            abort(403,'Não Autorizado');
        }
    }
}
