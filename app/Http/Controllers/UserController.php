<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Loja;
use App\Models\Usuario;
use App\Models\Endereco;


class UserController extends Controller
{
    public function endereco()
    {
        $correct = false;
        $user = auth()->user();
        $registro = Loja::where([
            [
                'user_id','=',$user->id
            ]
        ])->first();
        if($registro==null){
            $registro = Usuario::where([
                [
                    'user_id','=',$user->id
                ]
            ])->first();
            if($registro==null){
                $correct = false;
            }
            else{
                $correct = true;
            }
        }
        else{
            $correct = true;
        }

        if($correct == true){
            $Enderecos = Endereco::all();
            $Logradouro = "";
            $Cidade = "";
            $Bairro = "";
            $Numero = "";
            $CEP="";
            $UF="";
            $Latitude = "";
            $Longitude = "";
            return view('user.endereco',['User'=>$user,'Enderecos'=>$Enderecos,
            'Logradouro'=>$Logradouro,'Cidade'=>$Cidade,'Bairro'=>$Bairro,'Numero'=>$Numero,
            'CEP'=>$CEP,'UF'=>$UF,'Latitude'=>$Latitude,'Longitude'=>$Longitude,'title'=>'Registrar Endereço','Caminho'=>'/Endereco/Cadastrar']);
        }
        else{
            return redirect('/');
        }
        
    }
    public function createEndereco(Request $request){
        $Endereco = new Endereco;

        $Endereco->Logradouro = $request->street;
        $Endereco->Cidade = $request->city;
        $Endereco->Bairro = $request->neighborhood;
        $Endereco->Numero = $request->Number;
        $Endereco->CEP = $request->cep;
        $Endereco->UF = 'sp';
        $Endereco->Latitude = $request->lat;
        $Endereco->Longitude = $request->long;
        $user = auth()->user();
        $Endereco->save();
        $registro = Loja::where([
            [
                'user_id','=',$user->id
            ]
        ])->first();
        if($registro==null){
            $registro = Usuario::where([
                [
                    'user_id','=',$user->id
                ]
            ])->first();
        }
        
        $registro->Endereco_id = $Endereco->id;
        $registro->save();
        return redirect('/dashboard')->with('msg','Endereço Criado com sucesso!');
    }
    public function editEndereco(Request $request){
        Endereco::findOrFail($request->id)->update($request->all());
        return redirect('/dashboard')->with('msg','Endereço Editado com sucesso!');
    }
    public function update(Request $request){
        
    }
    public function typeUser(){
        return view('user.typeUser');
    }
    
    
    
}
