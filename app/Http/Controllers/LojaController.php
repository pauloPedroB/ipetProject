<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Loja;
use App\Models\User;


class LojaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('auth.loja');
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
        $loja = new Loja;
        $loja->Razao = $request->razaoSocial;
        $loja->CNPJ = $request->cnpj;
        $loja->Nome = $request->nomeFantasia;
        $loja->Telefone = $request->telefone;
        $loja->Celular = $request->celular;

        $user = auth()->user();
        $loja->user_id = $user->id;
        $loja->save();

        $User=User::findOrFail($user->id);
        $User->AL_id = 2;
        $User->save();
        return redirect('/Endereco');
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
        //
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
    
}
