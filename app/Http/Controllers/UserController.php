<?php

namespace App\Http\Controllers;

use App\Pessoa;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function index()
    {
        $usuarios = User::where('nivel_acesso', '!=', 'admin')->paginate(8);
        $data = [
            'title' => "Usuários",
            'type' => "usuarios",
            'menu' => "Usuários",
            'submenu' => "Listar",
            'getUsuarios' => $usuarios,
        ];
        return view('user.list', $data);
    }

    public function loginForm()
    {
        if (Auth::check()) {
            return redirect()->route('home');
        }
        $data = [
            'title' => "Iniciar Sessão",
            'type' => "login",
            'menu' => "Login",
            'submenu' => ""
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

    public function profile()
    {
        $id_pessoa = Auth::user()->pessoa->id;
        $pessoa = Pessoa::find($id_pessoa);
        if (!$pessoa) {
            return back()->with(['error' => "Não encontrou"]);
        }

        $user = User::where(['id_pessoa' => $id_pessoa])->first();
        if (!$user) {
            return back()->with(['error' => "Não encontrou"]);
        }

        $data = [
            'title' => "Perfil",
            'type' => "profile",
            'menu' => "Perfil",
            'submenu' => ""
        ];
        return view('user.profile', $data);
    }
}