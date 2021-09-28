<?php

namespace App\Http\Controllers;

use App\Cargo;
use App\Escalao;
use App\Funcionario;
use App\Pessoa;
use App\Provincia;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class FuncionarioController extends Controller
{

    public function __construct()
    {
        $this->middleware('AdminUser');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $funcionarios = Funcionario::paginate(5);
        $data = [
            'title' => "Funcionários",
            'type' => "funcionarios",
            'menu' => "Funcionários",
            'submenu' => "Listar",
            'getFuncionarios' => $funcionarios,
        ];
        return view('funcionarios.list', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $cargos = Cargo::pluck('cargo', 'id');
        $escalaos = Escalao::pluck('escalao', 'id');
        $provincias = Provincia::pluck('provincia', 'id');
        $data = [
            'title' => "Funcionários",
            'type' => "funcionarios",
            'menu' => "Funcionários",
            'submenu' => "Novo",
            'getCargos' => $cargos,
            'getEscalaos' => $escalaos,
            'getProvincias' => $provincias,
        ];
        return view('funcionarios.new', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'nome' => ['required', 'string', 'min:7', 'max:255'],
            'genero' => ['required', 'string'],
            'provincia' => ['required', 'Integer'],
            'municipio' => ['required', 'Integer'],
            'data_nascimento' => ['required', 'date'],
            'cargo' => ['required', 'Integer'],
            'escalao' => ['required', 'Integer'],
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
            'foto' => null,
        ];

        $data['funcionario'] = [
            'id_cargo' => $request->cargo,
            'id_escalao' => $request->escalao,
            'id_pessoa' => null,
            'estado' => "on",
        ];

        $palavra_passe = Hash::make("olamundo2015");
        $nivel_acesso = null;
        $string_nome = explode(" ", $request->nome);
        $primeiro_nome = $string_nome[0];
        $ultimo_nome = end($string_nome);
        $isUser = false;

        if ($request->cargo == 1 || $request->cargo == 2 || $request->cargo == 3) {
            //professor normal
            $nivel_acesso = "professor";
            $isUser = true;
        } elseif ($request->cargo == 4) {
            //chefe de secretaria
            $nivel_acesso = "user";
            $isUser = true;
        } elseif ($request->cargo == 5 || $request->cargo == 6) {
            //director e subdirector
            $nivel_acesso = "admin";
            $isUser = true;
        }

        $data['usuario'] = [
            'id_pessoa' => null,
            'username' => null,
            'password' => $palavra_passe,
            'estado' => "on",
            'nivel_acesso' => $nivel_acesso,
        ];

        if (Pessoa::where([
            'nome' => $data['pessoa']['nome'],
            'data_nascimento' => $data['pessoa']['data_nascimento']
        ])->first()) {
            return back()->with(['error' => "Já cadasrou este funcionario"]);
        }

        $pessoa = Pessoa::create($data['pessoa']);
        if ($pessoa) {
            $data['funcionario']['id_pessoa'] = $pessoa->id;
            $data['usuario']['id_pessoa'] = $pessoa->id;
            $nome_completo = strtolower($primeiro_nome.".".$ultimo_nome)."".$pessoa->id;
            $nome_converte = $this->converter_acentos($nome_completo);
            $data['usuario']['username'] = $nome_converte;
            $funcionario = Funcionario::create($data['funcionario']);
            if ($funcionario) {
                if ($isUser) {
                    if (User::create($data['usuario'])) {
                        return back()->with(['success' => "Feito com sucesso"]);
                    }
                } else {
                    return back()->with(['success' => "Feito com sucesso"]);
                }
            }
        }


    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $funcionario = Funcionario::find($id);
        if (!$funcionario) {
            return back()->with(['error' => "Nao encontrou"]);
        }

        $cargos = Cargo::pluck('cargo', 'id');
        $escalaos = Escalao::pluck('escalao', 'id');
        $provincias = Provincia::pluck('provincia', 'id');
        $data = [
            'title' => "Funcionários",
            'type' => "funcionarios",
            'menu' => "Funcionários",
            'submenu' => "Editar",
            'getCargos' => $cargos,
            'getEscalaos' => $escalaos,
            'getProvincias' => $provincias,
            'getFuncionario' => $funcionario,
        ];
        return view('funcionarios.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $funcionario = Funcionario::find($id);
        if (!$funcionario) {
            return back()->with(['error' => "Nao encontrou"]);
        }

        $request->validate([
            'nome' => ['required', 'string', 'min:7', 'max:255'],
            'genero' => ['required', 'string'],
            'provincia' => ['required', 'Integer'],
            'municipio' => ['required', 'Integer'],
            'data_nascimento' => ['required', 'date'],
            'cargo' => ['required', 'Integer'],
            'escalao' => ['required', 'Integer'],
        ]);

        if ($request->bilhete != "" || $request->bilhete != $funcionario->bilhete) {
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
            'foto' => null,
        ];

        $data['funcionario'] = [
            'id_cargo' => $request->cargo,
            'id_escalao' => $request->escalao,
            'estado' => "on",
        ];

        $nivel_acesso = null;
        $isUser = false;

        if ($request->cargo == 1 || $request->cargo == 2 || $request->cargo == 3) {
            //professor normal
            $nivel_acesso = "professor";
            $isUser = true;
        } elseif ($request->cargo == 4) {
            //chefe de secretaria
            $nivel_acesso = "user";
            $isUser = true;
        } elseif ($request->cargo == 5 || $request->cargo == 6) {
            //director e subdirector
            $nivel_acesso = "admin";
            $isUser = true;
        }

        $data['usuario'] = [
            'estado' => "on",
            'nivel_acesso' => $nivel_acesso,
        ];

        if ($request->nome != $data['pessoa']['nome'] || $request->data_nascimento != $data['pessoa']['data_nascimento']) {
            if (Pessoa::where([
                'nome' => $data['pessoa']['nome'],
                'data_nascimento' => $data['pessoa']['data_nascimento']
            ])->first()) {
                return back()->with(['error' => "Já cadasrou este funcionario"]);
            }
        }

        if (Pessoa::find($funcionario->id_pessoa)->update($data['pessoa'])) {
            if (Funcionario::find($funcionario->id)->update($data['funcionario'])) {
                if ($isUser) {
                    if (User::where('id_pessoa', $funcionario->id_pessoa)->update($data['usuario'])) {
                        return back()->with(['success' => "Feito com sucesso"]);
                    }
                } else {
                    return back()->with(['success' => "Feito com sucesso"]);
                }
            }
        }
    }

     public function converter_acentos($string) {

        return preg_replace(array("/(á|â|ã|à)/", "/(Á|Â|Ã|À)/",
                "/(é|è|ê)/", "/(É|È|Ê)/", "/(í|ì|î)/", "/(Í|Ì|Î)/",
                "/(ó|ò|õ|ô)/", "/(Ó|Ò|Õ|Ô)/", "/(ú|ù|û)/", "/(Ú|Ù|Û)/",
                "/(ñ)/", "/(Ñ)/", "/(ç)/", "/(Ç)/"),
                explode(" ","a A e E i I o O u U n N c C"), $string);
    }

    public function import(){
        $data = [
            'title' => "Funcionários",
            'type' => "funcionarios",
            'menu' => "Funcionários",
            'submenu' => "Importar",
        ];
        return view('funcionarios.import', $data);
    }

    public function store_import(Request $request){
        $request->validate([
            'arquivo' => ['required', 'mimes:xlsx,xls'],
        ]);
        $file = $request->file('arquivo');

        //$import = new PessoaImport;

        /*if($import->import($file)){
            return back()->with(['success'=>"Feito com sucesso"]);
        }*/
    }
}