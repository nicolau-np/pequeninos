<?php

namespace App\Http\Controllers;

use App\AnoLectivo;
use App\Curso;
use App\Estudante;
use App\HistoricEstudante;
use App\Pessoa;
use App\Provincia;
use Illuminate\Http\Request;

use function PHPSTORM_META\map;

class EstudanteController extends Controller
{

    public function __construct()
    {
        $this->middleware('admin');
    }

    public function index()
    {
        $estudantes = Estudante::paginate(5);
        $data = [
            'title' => "Estudantes",
            'type' => "estudantes",
            'menu' => "Estudantes",
            'submenu' => "Listar",
            'getEstudantes' => $estudantes,
        ];
        return view('estudantes.list', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $provincias = Provincia::pluck('provincia', 'id');
        $cursos = Curso::pluck('curso', 'id');
        $ano_lectivos = AnoLectivo::pluck('ano_lectivo', 'id');
        $data = [
            'title' => "Estudantes",
            'type' => "estudantes",
            'menu' => "Estudantes",
            'submenu' => "Listar",
            'getProvincias' => $provincias,
            'getCursos' => $cursos,
            'getAnoLectivo' => $ano_lectivos,
        ];
        return view('estudantes.new', $data);
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
            'encarregado' => ['required', 'Integer'],
            'curso' => ['required', 'Integer'],
            'classe' => ['required', 'Integer'],
            'turma' => ['required', 'Integer'],
            'ano_lectivo' => ['required', 'Integer'],
        ]);

        if ($request->bilhete != "") {
            $request->validate([
                'bilhete' => ['required', 'string', 'unique:pessoas,bilhete']
            ]);
        }

        $ano_lectivo = AnoLectivo::find($request->ano_lectivo);

        $data['pessoa'] = [
            'id_municipio'=>$request->municipio,
            'nome'=>$request->nome,
            'data_nascimento'=>$request->data_nascimento,
            'genero'=>$request->genero,
            'estado_civil'=>$request->estado_civil,
            'naturalidade'=>$request->naturalidade,
            'telefone'=>$request->telefone,
            'bilhete'=>$request->bilhete,
            'data_emissao'=>$request->data_emissao,
            'local_emissao'=>$request->local_emissao,
            'pai'=>$request->pai,
            'mae'=>$request->mae,
            'comuna'=>$request->comuna,
            'foto'=>null,
        ];

        $data['estudante'] = [
            'id_turma'=>$request->turma,
            'id_pessoa'=>null,
            'id_encarregado'=>$request->encarregado,
            'estado'=>"on",
            'ano_lectivo'=>$ano_lectivo->ano_lectivo,
        ];

        $data['historico'] = [
            'id_estudante'=>null,
            'id_turma'=>$request->turma,
            'estado'=>"on",
            'ano_lectivo'=>$ano_lectivo->ano_lectivo,
        ];

        if(Pessoa::where(['nome'=>$data['pessoa']['nome'], 
        'data_nascimento'=>$data['pessoa']['data_nascimento']])->first()){
            return back()->with(['error'=>"Já cadasrou este estudante"]);
        }
        
        $pessoa = Pessoa::create($data['pessoa']);
        if($pessoa){
            $data['estudante']['id_pessoa'] = $pessoa->id;
            $estudante = Estudante::create($data['estudante']);
            if($estudante){
                $data['historico']['id_estudante'] = $estudante->id;
                if(HistoricEstudante::create($data['historico'])){
                    return back()->with(['success'=>"Feito com sucesso"]);
                }
            }
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}