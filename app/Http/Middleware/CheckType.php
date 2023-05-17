<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Models\Loja;
use App\Models\Usuario;

class CheckType
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $User = auth()->user();
        if($User)
        {
            $registro = Loja::where([
                [
                    'id','=',$User->id
                ]
            ])->first();
            if($registro == null){
                $registro = Usuario::where([
                    [
                        'id','=',$User->id
                    ]
                ])->first();
            }
            
            if($registro == null){
                return redirect('/Tipo/Usuario');
            }   
        }
       
        return $next($request);
    }
}
