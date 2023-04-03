<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Endereco;


class UserController extends Controller
{
    public function endereco()
    {
        return view('user.endereco');
    }
    public function createEndereco(Request $request){

        $Endereco = new Endereco;

        $Endereco->Logradouro = $request->street;
        $Endereco->Cidade = $request->city;
        $Endereco->Bairro = $request->neighborhood;
        $Endereco->Numero = $request->Number;
        $Endereco->CEP = $request->cep;
        $Endereco->UF = 'sp';
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
