<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Usuario;
use App\Models\User;
use App\Models\Endereco;

use DateTime;
use App\Utils\Validations;

class UsuarioController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('user.cadastroCliente');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
       
      
        $registro = Usuario::where([
            [
                'CPF','=',$request->CPF
            ]
        ])->first();
        if($registro != null){
            return redirect('/Registrar/Usuario')->with('error', 'CPF enviado já está cadastrado');
        }
        $cpf = preg_replace('/[^0-9]/', '', $request->CPF);
    
        // Verificar se o CPF tem 11 dígitos
        if (strlen($cpf) != 11) {
            return redirect('/Registrar/Usuario')->with('error', 'CPF inválido');
        }
        
        // Verificar se todos os dígitos são iguais (CPF inválido)
        if (preg_match('/(\d)\1{10}/', $cpf)) {
            return redirect('/Registrar/Usuario')->with('error', 'CPF inválido');
        }
        
        // Calcular o primeiro dígito verificador
        $soma = 0;
        for ($i = 0; $i < 9; $i++) {
            $soma += ($cpf[$i] * (10 - $i));
        }
        $resto = $soma % 11;
        $digitoVerificador1 = ($resto < 2) ? 0 : (11 - $resto);
        
        // Calcular o segundo dígito verificador
        $soma = 0;
        for ($i = 0; $i < 10; $i++) {
            $soma += ($cpf[$i] * (11 - $i));
        }
        $resto = $soma % 11;
        $digitoVerificador2 = ($resto < 2) ? 0 : (11 - $resto);
        
        // Verificar se os dígitos verificadores estão corretos
        if (($cpf[9] != $digitoVerificador1) || ($cpf[10] != $digitoVerificador2)) {
            return redirect('/Registrar/Usuario')->with('error', 'CPF inválido');
        }
        $today = new DateTime();
        $diff = $today->diff(new DateTime($request->DT));
        $years = $diff->y;
        
        if($years < 18){
            return redirect('/Registrar/Usuario')->with('error', 'Cadastro proíbido para menores de 18 anos');
        }
        
      

        $Endereco = new Endereco;

        $Endereco->Logradouro = $request->street;
        $Endereco->Cidade = $request->city;
        $Endereco->Bairro = $request->neighborhood;
        $Endereco->Numero = $request->Number;
        $Endereco->CEP = $request->cep;
        $Endereco->UF = $request->uf;
        if($request->lat != null){
            $Endereco->Latitude = $request->lat;  
        }
        else{
            $Endereco->Latitude= '-23.61279792090457';
        }
        if($request->long != null){
            $Endereco->Longitude = $request->long;
        }
        else{
            $Endereco->Longitude= '-46.780145384505474';
        }
        $user = auth()->user();
        $Endereco->save();
 
        $usuario = new Usuario;
        $usuario->Name = $request->Name;
        $usuario->CPF = $request->CPF;
        $usuario->Telefone = $request->Telefone;
        $usuario->Celular = $request->Celular;
        $usuario->DT = $request->DT;

        $user = auth()->user();
        $usuario->user_id = $user->id;
        $usuario->Endereco_id = $Endereco->id;

        $usuario->save();

        $User=User::findOrFail($user->id);
        $User->AL_id = 1;
        $User->save();
        return redirect('/dashboard')->with('msg','Você foi cadastrado(a) com sucesso!!');

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
}
