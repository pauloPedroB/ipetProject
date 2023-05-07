<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;

use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function index(Request $request){
        $email = $request->email;
        $password = $request->password;
        if (Auth::attempt(['email' => $email, 'password' => $password])) {
            // As credenciais são válidas, redirecione o usuário para a página de destino.
            return redirect()->intended('dashboard');
        } else {
            // As credenciais são inválidas, redirecione o usuário de volta para a página de login com uma mensagem de erro.
            return redirect('/login')->with('error', 'Email ou senha inválidos.');
        }
    }
}
