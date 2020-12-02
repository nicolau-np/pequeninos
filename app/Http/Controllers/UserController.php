<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function loginForm(){
        $data = [
            'title'=>"Iniciar Sessão",
            'type'=>"login",
            'menu'=>"Login",
            'submenu'=>""
        ];
        return view('user.login', $data);
    }

    public function logout()
    {
        Auth::logout();
        return redirect()->route('login');
    }

    public function logar(Request $request)
    {
        $request->validate([
                'email' => ['required','email'],
                'password' => ['required', 'string']
            ]);

        $credencials = array_merge($request->only('email', 'password'), ['isVerified' => 1]);
        if (Auth::attempt($credencials)) {
            return redirect()->route('home');
        } else {

            return back()->with(['error' => "Erro no Email ou Palavra-Passe"]);
        }
    }


}