<?php

namespace App\Http\Controllers;

use App\Pessoa;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

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
            'type' => "perfil",
            'menu' => $pessoa->nome,
            'submenu' => "",
            'getPessoa' => $pessoa,
            'getUser' => $user,
        ];
        return view('user.profile', $data);
    }

    public function updateprofile(Request $request)
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

        $request->validate([
            'password' => ['required', 'string',],
            'newpassword' => ['required', 'string', 'min:6', 'max:255'],
            'confirmpassword' => ['required', 'string', 'min:6', 'max:255'],
        ]);

        if ($request->newpassword != $request->confirmpassword) {
            return back()->with(['error' => "Errou na confirmação da Palavra-Passe"]);
        }

        $password_nova = Hash::make($request->newpassword);
        $data = [
            'password'=>$password_nova,
        ];

        if(User::find($user->id)->update($data)){
            return back()->with(['success' => "Feito com sucesso"]);
        }
    }

    public function resetpassword(){
        
    }
}