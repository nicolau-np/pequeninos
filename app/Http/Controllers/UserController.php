<?php

namespace App\Http\Controllers;

use App\Pessoa;
use App\Provincia;
use App\ResetPassword;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;

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

        /* deve verificar se a palavra_passe actual esta correcta */
        $verifica_passe = Hash::check($request->password, $user->password);
        if (!$verifica_passe) {
            return back()->with(['error' => "Palavra-Passe actual incorrecta"]);
        }
        /*fim*/

        $password_nova = Hash::make($request->newpassword);
        $data = [
            'password' => $password_nova,
        ];

        if (User::find($user->id)->update($data)) {
            return back()->with(['success' => "Feito com sucesso"]);
        }
    }

    public function resetpassword()
    {
        $data = [
            'title' => "Recuperar Palavra-Passe",
            'type' => "login",
            'menu' => "Recuperar Palavra-Passe",
            'submenu' => ""
        ];
        return view('user.resetpassword', $data);
    }

    public function resetpassword_req(Request $request)
    {
        $request->validate([
            'telefone' => ['required', 'integer', 'min:1'],
            'email' => ['required', 'string',],
            'username' => ['required', 'string'],
        ]);

        $user = User::where(['username' => $request->username])->first();
        if (!$user) {
            return back()->with(['error' => "Nome de usuário não existente"]);
        }

        if (!$user->email) {
            return back()->with(['error' => "Usuário sem email. Deve contactar o administrador do sistema e informar o seu email."]);
        }

        if ($user->email != $request->email) {
            return back()->with(['error' => "Email incorrecto"]);
        }

        //criar codigo de verificacao
        $verify_code = str_pad(mt_rand(0, 999999), 6, '0', STR_PAD_LEFT);

        //criando o hash code
        $hash_code = $verify_code . "" . $user->email;
        //transformando em hash
        $verify_code_hash = Hash::make($hash_code);
        $data = [
            'id_user' => $user->id,
            'hash_code' => $verify_code_hash,
            'verify_code' => $verify_code,
            'estado' => "on",
        ];

        $data2 = [
            'verify_code' => $verify_code,
            'email' => $user->email,
            'name' => $user->username,
            'id_user' => $user->id,
            'hash_code' => $verify_code_hash,
            'id_reset' => null,
        ];
        $reset_password = ResetPassword::create($data);
        if ($reset_password) {
            $data2['id_reset'] = $reset_password->id;
            /*enviar email*/
            Mail::send('email.reset_password', $data2, function ($message) use ($data2) {
                $message->from('sos@sigeokussoleka.com', 'Escola-SOS');
                $message->subject('[Escola-SOS] Código de verificação');
                $message->to($data2['email']);
            });
            /*fim*/
            return back()->with(['success' => "Feito com sucesso. Recebeu uma SMS no email com código e link"]);
        }
    }

    public function verifycode($id_reset)
    {
        $reset_password = ResetPassword::find($id_reset);
        if (!$reset_password) {
            return back()->with(['error' => "Nao encontrou"]);
        }
        $user = User::find($reset_password->id_user);
        if (!$user) {
            return back()->with(['error' => "Nao encontrou"]);
        }

        if ($reset_password->estado == "off") {
            return back()->with(['error' => "Código sem validade"]);
        }

        $data = [
            'title' => "Código de Verificação",
            'type' => "login",
            'menu' => "Código de Verificação",
            'submenu' => "",
            'getReset' => $reset_password,
            'getUser' => $user,
        ];
        return view('user.verifycode', $data);
    }

    public function verifycode_put(Request $request, $id_reset)
    {
        $reset_password = ResetPassword::find($id_reset);
        if (!$reset_password) {
            return back()->with(['error' => "Nao encontrou"]);
        }
        $user = User::find($reset_password->id_user);
        if (!$user) {
            return back()->with(['error' => "Nao encontrou"]);
        }

        if ($reset_password->estado == "off") {
            return back()->with(['error' => "Código sem validade"]);
        }

        $request->validate([
            'code' => ['required', 'numeric', 'min:1'],
        ]);

        //verificar codigo incripetado com email
        $hash_code = $request->code . "" . $user->email;
        $verify_code = Hash::check($hash_code, $reset_password->hash_code);
        if (!$verify_code) {
            return back()->with(['error' => "Código de verificação incorrecto"]);
        }
        //verificar codigo simples
        if ($request->code != $reset_password->verify_code) {
            return back()->with(['error' => "Código de verificação incorrecto"]);
        }

        $default_password = Hash::make('escola001');
        $data['user'] = [
            'password' => $default_password,
        ];

        $data['reset'] = [
            'estado' => "off",
        ];

        if (User::find($user->id)->update($data['user'])) {
            if (ResetPassword::find($id_reset)->update($data['reset'])) {
                return redirect()->route('login');
            }
        }
    }

    public function create()
    {
        $provincias = Provincia::pluck('provincia', 'id');
        $data = [
            'title' => "Usuários",
            'type' => "usuarios",
            'menu' => "Usuários",
            'submenu' => "Novo",
            'getProvincias' => $provincias,
        ];
        return view('user.new', $data);
    }

    public function store(Request $request)
    {
        $request->validate([
            'nome' => ['required', 'string', 'min:7', 'max:255'],
            'genero' => ['required', 'string'],
            'provincia' => ['required', 'Integer'],
            'municipio' => ['required', 'Integer'],
            'data_nascimento' => ['required', 'date'],
            'nivel_acesso' => ['required', 'string'],
            'email' => ['required', 'string', 'unique:usuarios,email'],
        ]);

        if ($request->bilhete != "") {
            $request->validate([
                'bilhete' => ['required', 'string', 'unique:pessoas,bilhete']
            ]);
        }

        $data['pessoa'] = [
            'id_municipio' => $request->municipio,
            'nome' => $request->nome,
            'data_nascimento' => $request->data_nascimento,
            'genero' => $request->genero,
            'estado_civil' => $request->estado_civil,
            'naturalidade' => $request->naturalidade,
            'telefone' => $request->telefone,
            'bilhete' => $request->bilhete,
            'data_emissao' => $request->data_emissao,
            'local_emissao' => $request->local_emissao,
            'pai' => $request->pai,
            'mae' => $request->mae,
            'comuna' => $request->comuna,
        ];

        $palavra_passe = Hash::make("escola001");
        $string_nome = explode(" ", $request->nome);
        $primeiro_nome = $string_nome[0];
        $ultimo_nome = end($string_nome);

        $data['usuario'] = [
            'id_pessoa' => null,
            'username' => null,
            'password' => $palavra_passe,
            'estado' => "on",
            'nivel_acesso' => $request->nivel_acesso,
            'email' => $request->email,
        ];

        if (Pessoa::where([
            'nome' => $data['pessoa']['nome'],
            'data_nascimento' => $data['pessoa']['data_nascimento']
        ])->first()) {
            return back()->with(['error' => "Já cadasrou este usuário"]);
        }

        $pessoa = Pessoa::create($data['pessoa']);
        if ($pessoa) {
            $data['usuario']['id_pessoa'] = $pessoa->id;
            $nome_completo = strtolower($primeiro_nome . "." . $ultimo_nome) . "" . $pessoa->id;
            $nome_converte = $this->converter_acentos($nome_completo);
            $data['usuario']['username'] = $nome_converte;
            if (User::create($data['usuario'])) {
                return back()->with(['success' => "Feito com sucesso"]);
            }
        }
    }

    public function converter_acentos($string)
    {

        return preg_replace(
            array(
                "/(á|â|ã|à)/", "/(Á|Â|Ã|À)/",
                "/(é|è|ê)/", "/(É|È|Ê)/", "/(í|ì|î)/", "/(Í|Ì|Î)/",
                "/(ó|ò|õ|ô)/", "/(Ó|Ò|Õ|Ô)/", "/(ú|ù|û)/", "/(Ú|Ù|Û)/",
                "/(ñ)/", "/(Ñ)/", "/(ç)/", "/(Ç)/"
            ),
            explode(" ", "a A e E i I o O u U n N c C"),
            $string
        );
    }

    public function edit($id)
    {
        $user = User::find($id);
        if (!$user) {
            return back()->with(['error' => "Nao encontrou"]);
        }
        $provincias = Provincia::pluck('provincia', 'id');
        $data = [
            'title' => "Usuários",
            'type' => "usuarios",
            'menu' => "Usuários",
            'submenu' => "Novo",
            'getProvincias' => $provincias,
            'getUser' => $user,
        ];
        return view('user.edit', $data);
    }

    public function update(Request $request, $id)
    {
        $user = User::find($id);
        if (!$user) {
            return back()->with(['error' => "Nao encontrou"]);
        }
        $request->validate([
            'nome' => ['required', 'string', 'min:7', 'max:255'],
            'genero' => ['required', 'string'],
            'provincia' => ['required', 'Integer'],
            'municipio' => ['required', 'Integer'],
            'data_nascimento' => ['required', 'date'],
            'nivel_acesso' => ['required', 'string'],
            'email' => ['required', 'string',],
        ]);

        if ($request->bilhete != $user->pessoa->bilhete) {
            $request->validate([
                'bilhete' => ['required', 'string', 'unique:pessoas,bilhete']
            ]);
        }

        if ($request->email != $user->email) {
            $request->validate([
                'email' => ['required', 'string', 'unique:usuarios,email']
            ]);
        }

        $data['pessoa'] = [
            'id_municipio' => $request->municipio,
            'nome' => $request->nome,
            'data_nascimento' => $request->data_nascimento,
            'genero' => $request->genero,
            'estado_civil' => $request->estado_civil,
            'naturalidade' => $request->naturalidade,
            'telefone' => $request->telefone,
            'bilhete' => $request->bilhete,
            'data_emissao' => $request->data_emissao,
            'local_emissao' => $request->local_emissao,
            'pai' => $request->pai,
            'mae' => $request->mae,
            'comuna' => $request->comuna,

        ];

        $data['usuario'] = [
            'nivel_acesso' => $request->nivel_acesso,
            'email' => $request->email,
        ];



        $pessoa = Pessoa::find($user->id_pessoa)->update($data['pessoa']);
        if ($pessoa) {

            if (User::find($user->id)->update($data['usuario'])) {
                return back()->with(['success' => "Feito com sucesso"]);
            }
        }
    }
}