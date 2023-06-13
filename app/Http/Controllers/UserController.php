<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Loja;
use App\Models\Usuario;
use App\Models\Endereco;


class UserController extends Controller
{
    public function typeUser(){
        $user = auth()->user();
        if($user){
            if($user->email_verified_at == null && $user->AL_id != 3){
                return view('auth.verify-email');
            }
        }
        return view('user.typeUser');
    }
    public function destroy(){
        $user = auth()->user();
        if($user){
            $user = User::findOrFail($user->id);
            $loja = Loja::where('user_id','=',$user->id)->first();
            if($loja == null){
                $loja = Usuario::where('user_id','=',$user->id)->first();    
            }
            $loja->delete();
            $user->delete();

        }
       
        return redirect('/');
    }
}
