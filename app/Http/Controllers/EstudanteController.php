<?php

namespace App\Http\Controllers;

use App\AnoLectivo;
use App\Curso;
use App\Declaracao;
use App\Desistencia;
use App\Estudante;
use App\HistoricEstudante;
use App\Pessoa;
use App\Provincia;
use App\Transferencia;
use App\Turma;
use Illuminate\Http\Request;

use function PHPSTORM_META\map;

class EstudanteController extends Controller
{

    public function __construct()
    {
        $this->middleware('AdminUser');
    }

    public function index()
    {
        $estudantes = Estudante::paginate(5);
        $cursos = Curso::pluck('curso', 'id');
        $ano_lectivos = AnoLectivo::pluck('ano_lectivo', 'ano_lectivo');
        $data = [
            'title' => "Estudantes",
            'type' => "estudantes",
            'menu' => "Estudantes",
            'submenu' => "Listar",
            'getEstudantes' => $estudantes,
            'getCursos' => $cursos,
            'getAnos' => $ano_lectivos,
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
        $ano_lectivos = AnoLectivo::pluck('ano_lectivo', 'ano_lectivo');
        $data = [
            'title' => "Estudantes",
            'type' => "estudantes",
            'menu' => "Estudantes",
            'submenu' => "Novo",
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
            'ano_lectivo' => ['required', 'string', 'min:4', 'max:255'],
        ]);

        $ano_lectivo = AnoLectivo::where('ano_lectivo', $request->ano_lectivo)->first();
        if (!$ano_lectivo) {
            return back()->with(['error' => "Não encontrou ano lectivo"]);
        }

        $turma = Turma::find($request->turma);
        if(!$turma){
            return back()->with(['error' => "Nao encontrou turma"]);
        }
        $nome_pasta = $turma->turma."-".$request->ano_lectivo;

        if ($request->bilhete != "") {
            $request->validate([
                'bilhete' => ['required', 'string', 'unique:pessoas,bilhete']
            ]);
        }

        $path = null;
        if ($request->hasFile('foto') && $request->foto->isValid()) {
            $request->validate([
                'foto' => ['required', 'mimes:jpg,jpeg,png,JPEG,JPG,PNG', 'max:5000']
            ]);
            $path = $request->foto->store('fotos_estudantes/'.$nome_pasta);
        }

        /* criar numero do estudante*/
            $estudantes = Estudante::where(['id_turma'=>$request->turma, 'ano_lectivo'=>$request->ano_lectivo])->get();
            $numero_estudante = $estudantes->count()+1;
        /*end*/

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
            'foto' => $path,
        ];

        $data['estudante'] = [
            'id_turma' => $request->turma,
            'id_pessoa' => null,
            'id_encarregado' => $request->encarregado,
            'estado' => "on",
            'ano_lectivo' => $request->ano_lectivo,
        ];

        $data['historico'] = [
            'id_estudante' => null,
            'id_turma' => $request->turma,
            'estado' => "on",
            'ano_lectivo' => $request->ano_lectivo,
        ];

        if (Pessoa::where([
            'nome' => $data['pessoa']['nome'],
            'data_nascimento' => $data['pessoa']['data_nascimento']
        ])->first()) {
            return back()->with(['error' => "Já cadasrou este estudante"]);
        }

        $pessoa = Pessoa::create($data['pessoa']);
        if ($pessoa) {
            $data['estudante']['id_pessoa'] = $pessoa->id;
            $estudante = Estudante::create($data['estudante']);
            if ($estudante) {
                $data['historico']['id_estudante'] = $estudante->id;
                if (HistoricEstudante::create($data['historico'])) {
                    return back()->with(['success' => "Feito com sucesso"]);
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
        $estudante = Estudante::find($id);
        if (!$estudante) {
            return back()->with(['error' => "Não encontrou"]);
        }
        $ano_lectivo = AnoLectivo::where(['ano_lectivo' => $estudante->ano_lectivo])->first();

        $provincias = Provincia::pluck('provincia', 'id');
        $cursos = Curso::pluck('curso', 'id');
        $ano_lectivos = AnoLectivo::pluck('ano_lectivo', 'ano_lectivo');
        $data = [
            'title' => "Estudantes",
            'type' => "estudantes",
            'menu' => "Estudantes",
            'submenu' => "Editar",
            'getProvincias' => $provincias,
            'getCursos' => $cursos,
            'getAnoLectivo' => $ano_lectivos,
            'getEstudante' => $estudante,
            'getAno' => $ano_lectivo,
        ];
        return view('estudantes.edit', $data);
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
        $estudante = Estudante::find($id);
        if (!$estudante) {
            return back()->with(['error' => "Não encontrou"]);
        }

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
            'ano_lectivo' => ['required', 'string', 'min:4', 'max:255'],
        ]);

        $ano_lectivo = AnoLectivo::where('ano_lectivo', $request->ano_lectivo)->first();
        if (!$ano_lectivo) {
            return back()->with(['error' => "Não encontrou ano lectivo"]);
        }

        $turma = Turma::find($request->turma);
        if(!$turma){
            return back()->with(['error' => "Nao encontrou turma"]);
        }
        $nome_pasta = $turma->turma."-".$request->ano_lectivo;

        if ($request->bilhete != "" || $request->bilhete != $estudante->bilhete) {
            $request->validate([
                'bilhete' => ['required', 'string', 'unique:pessoas,bilhete']
            ]);
        }

        $path = null;
        if ($request->hasFile('foto') && $request->foto->isValid()) {
            $request->validate([
                'foto' => ['required', 'mimes:jpg,png,jpeg,JPG,PNG,JPEG', 'max:5000']
            ]);
            if ($estudante->pessoa->foto != "" && file_exists($estudante->pessoa->foto)) {
                unlink($estudante->pessoa->foto);
            }
            $path = $request->foto->store('fotos_estudantes/'.$nome_pasta);
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
            'foto' => $path,
        ];

        $data['estudante'] = [
            'id_turma' => $request->turma,
            'id_encarregado' => $request->encarregado,
            'estado' => "on",
            'ano_lectivo' => $request->ano_lectivo,
        ];

        $data['historico'] = [
            'id_turma' => $request->turma,
            'estado' => "on",
            'ano_lectivo' => $request->ano_lectivo,
        ];

        if ($request->nome != $data['pessoa']['nome'] || $request->data_nascimento != $data['pessoa']['data_nascimento']) {
            if (Pessoa::where([
                'nome' => $data['pessoa']['nome'],
                'data_nascimento' => $data['pessoa']['data_nascimento']
            ])->first()) {
                return back()->with(['error' => "Já cadasrou este estudante"]);
            }
        }


        if (Pessoa::find($estudante->id_pessoa)->update($data['pessoa'])) {

            if (Estudante::find($estudante->id)->update($data['estudante'])) {
                if (HistoricEstudante::find($estudante->id)->update($data['historico'])) {
                    return back()->with(['success' => "Feito com sucesso"]);
                }
            }
        }
    }


    public function confirmar($id_estudante)
    {
        $estudante = Estudante::find($id_estudante);
        if (!$estudante) {
            return back()->with(['error' => "Não encontrou"]);
        }
        $ano_lectivo = AnoLectivo::where(['ano_lectivo' => $estudante->ano_lectivo])->first();

        $provincias = Provincia::pluck('provincia', 'id');
        $cursos = Curso::pluck('curso', 'id');
        $ano_lectivos = AnoLectivo::pluck('ano_lectivo', 'ano_lectivo');
        $data = [
            'title' => "Estudantes",
            'type' => "estudantes",
            'menu' => "Estudantes",
            'submenu' => "Confirmar",
            'getProvincias' => $provincias,
            'getCursos' => $cursos,
            'getAnoLectivo' => $ano_lectivos,
            'getEstudante' => $estudante,
            'getAno' => $ano_lectivo,
        ];
        return view('estudantes.confirmar', $data);
    }

    public function store_confirmar(Request $request, $id_estudante)
    {
        $estudante = Estudante::find($id_estudante);
        if (!$estudante) {
            return back()->with(['error' => "Não encontrou"]);
        }

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
            'ano_lectivo' => ['required', 'string', 'min:4', 'max:255'],
        ]);

        if ($request->bilhete != "" || $request->bilhete != $estudante->bilhete) {
            $request->validate([
                'bilhete' => ['required', 'string', 'unique:pessoas,bilhete']
            ]);
        }

        $ano_lectivo = AnoLectivo::where('ano_lectivo', $request->ano_lectivo)->first();
        if (!$ano_lectivo) {
            return back()->with(['error' => "Não encontrou ano lectivo"]);
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

        $data['estudante'] = [
            'id_turma' => $request->turma,
            'id_encarregado' => $request->encarregado,
            'estado' => "on",
            'ano_lectivo' => $request->ano_lectivo,
        ];

        $data['historico'] = [
            'id_estudante' => $id_estudante,
            'id_turma' => $request->turma,
            'estado' => "on",
            'ano_lectivo' => $request->ano_lectivo,
        ];

        if (HistoricEstudante::where(['id_estudante' => $id_estudante, 'ano_lectivo' => $data['estudante']['ano_lectivo']])->first()) {
            return back()->with(['error' => "Já confirmou para este ano"]);
        }

        if (Pessoa::find($estudante->pessoa->id)->update($data['pessoa'])) {
            if (Estudante::find($estudante->id)->update($data['estudante'])) {
                if (HistoricEstudante::create($data['historico'])) {
                    return back()->with(['success' => "Feito com sucesso"]);
                }
            }
        }
    }

    public function ficha($id_estudante, $ano_lectivo)
    {
        $estudante = Estudante::find($id_estudante);
        if (!$estudante) {
            return back()->with(['error' => "Não encontrou"]);
        }
        $ano_lectivos = AnoLectivo::where('ano_lectivo', $ano_lectivo)->first();
        if (!$ano_lectivos) {
            return back()->with(['error' => "Não encontrou ano lectivo"]);
        }
        $historicoAnos = HistoricEstudante::where(['id_estudante' => $id_estudante])->orderBy('id', 'desc')->get();
        $historico = HistoricEstudante::where(['id_estudante' => $id_estudante, 'ano_lectivo' => $ano_lectivo])->first();
        $data = [
            'title' => "Estudantes",
            'type' => "estudantes",
            'menu' => "Estudantes",
            'submenu' => "Ficha",
            'getEstudante' => $estudante,
            'getHistoricoEstudanteAnos' => $historicoAnos,
            'getHistoricoEstudante' => $historico,
        ];
        return view('estudantes.ficha', $data);
    }

    public function declaracao($id_estudante, $ano_lectivo)
    {
        $estudante = Estudante::find($id_estudante);
        if (!$estudante) {
            return back()->with(['error' => "Não encontrou"]);
        }

        $historico = HistoricEstudante::where(['id_estudante' => $id_estudante, 'ano_lectivo' => $ano_lectivo])->first();
        if (!$historico) {
            return back()->with(['error' => "Estudante nao matriculado neste ano lectivo"]);
        }

        $anos = AnoLectivo::pluck('ano_lectivo', 'ano_lectivo');

        $declaracaos = Declaracao::where(['id_estudante' => $id_estudante,])->orderBy('id', 'desc')->get();

        $data = [
            'title' => "Estudantes",
            'type' => "estudantes",
            'menu' => "Estudantes",
            'submenu' => "Declaração",
            'getEstudante' => $estudante,
            'getAno' => $ano_lectivo,
            'getAnos' => $anos,
            'getDeclaracaos' => $declaracaos,
        ];
        return view('estudantes.create_declaracao', $data);
    }

    public function store_declaracao(Request $request, $id_estudante)
    {
        $estudante = Estudante::find($id_estudante);
        if (!$estudante) {
            return back()->with(['error' => "Não encontrou"]);
        }
        $request->validate([
            'tipo' => ['required', 'string', 'min:3', 'max:255'],
            'data' => ['required', 'date'],
            'motivo' => ['required', 'string', 'min:5'],
            'ano_lectivo' => ['required', 'string', 'min:4', 'max:255'],
        ]);

        $historico = HistoricEstudante::where(['id_estudante' => $id_estudante, 'ano_lectivo' => $request->ano_lectivo])->first();
        if (!$historico) {
            return back()->with(['error' => "Estudante nao matriculado neste ano lectivo"]);
        }

        $data = [
            'id_estudante' => $id_estudante,
            'tipo' => $request->tipo,
            'motivo' => $request->motivo,
            'data_emissao' => $request->data,
            'ano_lectivo' => $request->ano_lectivo,
        ];

        if (Declaracao::create($data)) {
            return back()->with(['success' => "Feito com sucesso"]);
        }
    }

    public function guiatransferencia($id_estudante, $ano_lectivo)
    {
        $estudante = Estudante::find($id_estudante);
        if (!$estudante) {
            return back()->with(['error' => "Não encontrou"]);
        }

        $historico = HistoricEstudante::where(['id_estudante' => $id_estudante, 'ano_lectivo' => $ano_lectivo])->first();
        if (!$historico) {
            return back()->with(['error' => "Estudante nao matriculado neste ano lectivo"]);
        }

        $anos = AnoLectivo::pluck('ano_lectivo', 'ano_lectivo');

        $transferencias = Transferencia::where(['id_estudante' => $id_estudante,])->orderBy('id', 'desc')->get();

        $data = [
            'title' => "Estudantes",
            'type' => "estudantes",
            'menu' => "Estudantes",
            'submenu' => "Guia de Transferencia",
            'getEstudante' => $estudante,
            'getAno' => $ano_lectivo,
            'getAnos' => $anos,
            'getTransferencias' => $transferencias,
        ];
        return view('estudantes.create_transferencia', $data);
    }

    public function store_guiatransferencia(Request $request, $id_estudante)
    {
        $estudante = Estudante::find($id_estudante);
        if (!$estudante) {
            return back()->with(['error' => "Não encontrou"]);
        }

        $request->validate([
            'data' => ['required', 'date'],
            'descricao' => ['required', 'string', 'min:5'],
            'ano_lectivo' => ['required', 'string', 'min:4', 'max:255'],
        ]);

        $data = [
            'id_estudante' => $id_estudante,
            'motivo' => $request->descricao,
            'data_emissao' => $request->data,
            'ano_lectivo' => $request->ano_lectivo,
        ];

        if(Transferencia::create($data)){
            if(HistoricEstudante::where(['id_estudante' => $id_estudante, 'ano_lectivo'=>$request->ano_lectivo])->update(['observacao_final'=>"transferido"])){
                return back()->with(['success' => "Feito com sucesso"]);
            }
        }
    }

    public function desistencia($id_estudante, $ano_lectivo){
        $estudante = Estudante::find($id_estudante);
        if (!$estudante) {
            return back()->with(['error' => "Não encontrou"]);
        }

        $historico = HistoricEstudante::where(['id_estudante' => $id_estudante, 'ano_lectivo' => $ano_lectivo])->first();
        if (!$historico) {
            return back()->with(['error' => "Estudante nao matriculado neste ano lectivo"]);
        }

        $anos = AnoLectivo::pluck('ano_lectivo', 'ano_lectivo');

        $desistencias = Desistencia::where(['id_estudante' => $id_estudante,])->orderBy('id', 'desc')->get();

        $data = [
            'title' => "Estudantes",
            'type' => "estudantes",
            'menu' => "Estudantes",
            'submenu' => "Desistencias",
            'getEstudante' => $estudante,
            'getAno' => $ano_lectivo,
            'getAnos' => $anos,
            'getDesistencias' => $desistencias,
        ];
        return view('estudantes.create_desistencias', $data);
    }

    public function store_desistencias(Request $request, $id_estudante){
        $estudante = Estudante::find($id_estudante);
        if (!$estudante) {
            return back()->with(['error' => "Não encontrou estudante"]);
        }

        $request->validate([
            'data' => ['required', 'date'],
            'motivo' => ['required', 'string', 'min:5'],
            'ano_lectivo' => ['required', 'string', 'min:4', 'max:255'],
        ]);

        $data = [
            'id_estudante' => $id_estudante,
            'motivo' => $request->motivo,
            'data_saida' => $request->data,
            'ano_lectivo' => $request->ano_lectivo,
        ];

        if(Desistencia::create($data)){
            if(HistoricEstudante::where(['id_estudante' => $id_estudante, 'ano_lectivo'=>$request->ano_lectivo])->update(['observacao_final'=>"desistencia"])){
                return back()->with(['success' => "Feito com sucesso"]);
            }
        }

   }

}