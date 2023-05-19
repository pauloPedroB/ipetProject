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
       
        $cpf = Validations::validarCPF($request->CPF);
        
        if ($cpf){
            return redirect('/Registrar/Usuario')->with('error', 'O CPF inválido');
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
        
        $erro = Validations::validarNome($request->Name);
        
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
