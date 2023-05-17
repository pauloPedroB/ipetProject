<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Loja;
use App\Models\User;
use App\Models\Usuario;
use App\Models\Endereco;




class LojaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('user.loja');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        $registro = Loja::where([
            [
                'CNPJ','=',$request->cnpj
            ]
        ])->first();
        if($registro != null){
            return redirect('/Registrar/Loja')->with('error', 'O CNPJ enviado já está cadastrado');
        }

        $Endereco = new Endereco;

        $Endereco->Logradouro = $request->street;
        $Endereco->Cidade = $request->city;
        $Endereco->Bairro = $request->neighborhood;
        $Endereco->Numero = $request->Number;
        $Endereco->CEP = $request->cep;
        $Endereco->UF = $request->uf;
        $Endereco->Latitude = $request->lat;
        $Endereco->Longitude = $request->long;
        $user = auth()->user();
        $Endereco->save();

        $loja = new Loja;
        $loja->Razao = $request->razaoSocial;
        $loja->CNPJ = $request->cnpj;
        $loja->Nome = $request->nomeFantasia;
        $loja->Telefone = $request->telefone;
        $loja->Celular = $request->celular;

        $user = auth()->user();
        $loja->user_id = $user->id;
        $loja->Endereco_id = $Endereco->id;
        $loja->save();

        $User=User::findOrFail($user->id);
        $User->AL_id = 2;
        $User->save();
        return redirect('/dashboard')->with('msg','Sua Loja foi cadastrada com sucesso!!');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
         $registro = Loja::where([
            [
                'id','=',$id
            ]
        ])->first();
        if($registro == null){
            $registro = Usuario::where([
                [
                    'id','=',$id
                ]
            ])->first();
        }
        $user = auth()->user();   
        $endereco = Endereco::where([['id','=',$registro->Endereco_id]])->first();
        return view('user.lojaEdit',['registro'=>$registro,'endereco'=>$endereco,'user'=>$user]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
    public function premiumIndex(){
        $User = auth()->user();
        $loja = Loja::where([
            [
                'user_id','=',$User->id
            ]
        ])->get();

        return view('user.premium',['user'=>$User,'loja'=>$loja]);
    }
    public function premium(){
        $User = auth()->user();
        $loja = Loja::where([
            [
                'user_id','=',$User->id
            ]
        ])->first();
        $loja->Premium = 1;
        $loja->save();
        return redirect('/');
    }
    public function payment(){
        $User = auth()->user();
        $loja = Loja::where([
            [
                'user_id','=',$User->id
            ]
        ])->get();

        return view('user.payment',['user'=>$User,'loja'=>$loja]);
    }
    public function pix(){
        $User = auth()->user();
        $loja = Loja::where([
            [
                'user_id','=',$User->id
            ]
        ])->get();

        return view('user.pix',['user'=>$User,'loja'=>$loja]);
    }
    
}
