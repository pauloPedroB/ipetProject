<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Models\Loja;
use App\Models\Usuario;

class CheckNotType
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $User = auth()->user();
        if($User){
            $loja = Loja::where([
                [
                    'user_id','=',$User->id
                ]
            ])->get();

            if(count($loja)==0){
                $loja = Usuario::where([
                    [
                        'user_id','=',$User->id
                    ]
                ])->get();
                if(count($loja)==0){
                    $loja = null;
                }
               
            }
            
        }
        else{
            $loja='teste';
        }
        
        $end = false;
        $id_end = 0;
        if($loja!=null){
            return redirect('/');
        }

        $end = false;
        if($User && $User->AL_id!=3)
        {
            foreach($loja as $loj){
                if($loj->Endereco_id == null)
                {
                    $end = true;
                }
                
            }
        }
        if($end == true && $User->AL_id !=3){
            return redirect('/Endereco');
        }
        return $next($request);
    }
}
