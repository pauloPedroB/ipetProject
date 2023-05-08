<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;

use Illuminate\Http\Request;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Validator;
use Laravel\Jetstream\Jetstream;

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
    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|confirmed|min:8',
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        $user = Jetstream::newUserModel()->forceFill([
            'email' => $request->email,
            'password' => bcrypt($request->password),
        ]);

        $user->save();

        event(new Registered($user));

        Auth::login($user);

        return redirect('/dashboard');
    }
}
