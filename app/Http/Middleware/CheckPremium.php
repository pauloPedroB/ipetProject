<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Models\Loja;


class CheckPremium
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $user = auth()->user();

        $registro = Loja::where([
            [
                'user_id','=',$user->id
            ]
        ])->first();

        if($registro->Premium == 1){
            return redirect('/dashboard')->with('msg-exclusion','Já existe um pacote adicionado à sua loja');
        }
        return $next($request);
    }
}
