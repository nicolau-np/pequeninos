<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function index(){
        $usuarios = User::where('nivel_acesso', '!=', 'admin')->paginate(8);
        $data = [
            'title'=>"Usuários",
            'type'=>"usuarios",
            'menu'=>"Usuários",
            'submenu'=>"Listar",
            'getUsuarios'=>$usuarios,
        ];
        return view('user.list', $data);
    } 
    
    public function loginForm(){
        if(Auth::check()){
            return redirect()->route('home');
        }
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
        $request->validate(
            [
                'username' => ['required', 'string', 'max:255'],
                'password' => ['required', 'string', 'max:255']
            ]
        );

        $credencials = $request->only('username', 'password');
        if (Auth::attempt($credencials)) {
            return redirect()->route('home');
        } else {
            return back()->with(['error' => "Usuário ou Palavra-Passe Incorrectos"]);
        }
    }


}