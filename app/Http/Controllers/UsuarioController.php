<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Usuario;
use App\Models\User;
use App\Models\Endereco;

use DateTime;
use App\Utils\validations;

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
        $cpf = preg_replace('/[^0-9]/', '', $request->CPF);
    
        if (strlen($cpf) !== 11) {
            return redirect('/Registrar/Usuario')->with('error', 'O CPF Inválido');
        }
        if (preg_match('/(\d)\1{10}/', $cpf)) {
            return redirect('/Registrar/Usuario')->with('error', 'O CPF Inválido');
        }
        $soma = 0;
        for ($i = 0; $i < 9; $i++) {
            $soma += intval($cpf[$i]) * (10 - $i);
        }
        $resto = $soma % 11;
        $digito1 = ($resto < 2) ? 0 : (11 - $resto);
        if (intval($cpf[9]) !== $digito1) {
            return redirect('/Registrar/Usuario')->with('error', 'O CPF Inválido');
        }
        $soma = 0;
        for ($i = 0; $i < 10; $i++) {
            $soma += intval($cpf[$i]) * (11 - $i);
        }
        $resto = $soma % 11;
        $digito2 = ($resto < 2) ? 0 : (11 - $resto);
        if (intval($cpf[10]) !== $digito2) {
            return redirect('/Registrar/Usuario')->with('error', 'O CPF Inválido');
        }

        $registro = Usuario::where([
            [
                'CPF','=',$request->CPF
            ]
        ])->first();
        if($registro != null){
            return redirect('/Registrar/Usuario')->with('error', 'O CPF enviado já está cadastrado');
        }
        $today = new DateTime();
        $diff = $today->diff(new DateTime($request->DT));
        $years = $diff->y;
        
        if($years < 18){
            return redirect('/Registrar/Usuario')->with('error', 'Cadastro proíbido para menores de 18 anos');
        }
        
        $erro = validations::validarNome($nome);
        
        if ($erro) {
            return redirect('/Registrar/Usuario')->with('error', 'Nome Inválido');
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
