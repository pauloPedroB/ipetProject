<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redis;
use App\Models\Usuario;
use App\Models\Avaliation;



class AvaliationsController extends Controller
{
    public function create(Request $request){
        $User = auth()->user();
        $id = $request->value;
        $usuario = Usuario::where([
            [
                'user_id','=',$User->id
            ]
        ])->get();
        if(count($usuario)!=0){
            foreach($usuario as $usu){
                if($usu->user_id==$User->id)
                {
                    $av = Avaliation::where('Usuario_id','=',$usu->id)
                                        ->where('Loja_id','=',$request->loja)
                                        ->get();
                    if(count($av)>0){
                        return redirect('/produto'.'/'.$id)->with('msg','Você já fez uma Avaliação para essa loja');
                    }
                    else{
                        $avaliation = new Avaliation;
                        $avaliation->Qntd = $request->value;
                        $avaliation->Description = $request->avaliacao;
                        $avaliation->Loja_id = $request->loja;
                        $avaliation->Usuario_id = $usu->id;
                        $avaliation->save();
                        return redirect('/produto/2')->with('msg','Avaliação enviada');

                    }
                }
                
            }
            
        }
    }
}
