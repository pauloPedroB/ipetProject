<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Endereco;


class UserController extends Controller
{
    public function endereco()
    {
        $user = auth()->user();
        $Enderecos = Endereco::all();
        $Logradouro = "";
        $Cidade = "";
        $Bairro = "";
        $Numero = "";
        $CEP="";
        $UF="";
        $Latitude = "";
        $Longitude = "";
        return view('user.endereco',['User'=>$user,'Enderecos'=>$Enderecos,'btn'=>'Registrar Endereço',
        'Logradouro'=>$Logradouro,'Cidade'=>$Cidade,'Bairro'=>$Bairro,'Numero'=>$Numero,
        'CEP'=>$CEP,'UF'=>$UF,'Latitude'=>$Latitude,'Longitude'=>$Longitude,'title'=>'Registrar Endereço']);
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
        $registro = User::find($user->id);
        $registro->Endereco_id = $Endereco->id;
        $registro->save();
        return redirect('/');
    }
    public function update(Request $request){
        
    }
    
    
    
}
