<?php

namespace App\Http\Controllers;

use App\AnoLectivo;
use App\CategoriaEstudante;
use App\Curso;
use App\Declaracao;
use App\Desistencia;
use App\DocumentoEntregue;
use App\Estudante;
use App\Grade;
use App\HistoricEstudante;
use App\Pagamento;
use App\Pessoa;
use App\Provincia;
use App\RestricaoNota;
use App\TipoPagamento;
use App\Transferencia;
use App\Trimestral;
use App\Turma;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

use function PHPSTORM_META\map;

class EstudanteController extends Controller
{

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
        $categorias = CategoriaEstudante::pluck('categoria', 'sigla');
        $data = [
            'title' => "Estudantes",
            'type' => "estudantes",
            'menu' => "Estudantes",
            'submenu' => "Novo",
            'getProvincias' => $provincias,
            'getCursos' => $cursos,
            'getAnoLectivo' => $ano_lectivos,
            'getCategorias' => $categorias,
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
            'docs_entregues' => ['required'],
            'docs_entregues.*' => ['string']
        ]);

        $ano_lectivo = AnoLectivo::where('ano_lectivo', $request->ano_lectivo)->first();
        if (!$ano_lectivo) {
            return back()->with(['error' => "Não encontrou ano lectivo"]);
        }

        $turma = Turma::find($request->turma);
        if (!$turma) {
            return back()->with(['error' => "Nao encontrou turma"]);
        }
        $nome_pasta = $turma->turma . "-" . $request->ano_lectivo;

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
            $path = $request->foto->store('fotos_estudantes/' . $nome_pasta);
        }

        /* criar numero do estudante*/
        $estudantes = Estudante::where(['id_turma' => $request->turma, 'ano_lectivo' => $request->ano_lectivo])->get();
        $numero_estudante = $estudantes->count() + 1;
        /*end*/

        /*criar numero acesso */
        $gerando_aleatorio = str_pad(mt_rand(0, 9999), 4, '0', STR_PAD_LEFT);

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
            'bairro' => $request->bairro,
            'rua' => $request->rua,
            'residencia' => $request->residencia,
            'deficiencia' => $request->deficiencia,
            'tipo_deficiencia' => $request->tipo_deficiencia,
        ];

        $data['estudante'] = [
            'id_turma' => $request->turma,
            'id_pessoa' => null,
            'numero' => $numero_estudante,
            'numero_acesso' => null,
            'id_encarregado' => $request->encarregado,
            'estado' => "on",
            'ano_lectivo' => $request->ano_lectivo,
            'categoria' => $request->categoria,
        ];

        $data['historico'] = [
            'id_estudante' => null,
            'id_turma' => $request->turma,
            'numero' => $numero_estudante,
            'numero_acesso' => null,
            'estado' => "on",
            'ano_lectivo' => $request->ano_lectivo,
            'categoria' => $request->categoria,
        ];

        $data['docs_entregues'] = [
            'id_historico' => null,
            'documento' => null,
            'estado' => "on",
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
                $data['historico']['numero_acesso'] = $gerando_aleatorio . "-" . $estudante->id;
                $data['historico']['id_estudante'] = $estudante->id;
                $numero_acesso = $gerando_aleatorio . "-" . $estudante->id;
                $historico = HistoricEstudante::create($data['historico']);
                if ($historico) {
                    if (Estudante::find($estudante->id)->update(['numero_acesso' => $numero_acesso])) {
                        foreach ($request->docs_entregues as $docs) {
                            $data['docs_entregues']['documento'] = $docs;
                            $data['docs_entregues']['id_historico'] = $historico->id;
                            DocumentoEntregue::create($data['docs_entregues']);
                        }
                        return back()->with(['success' => "Feito com sucesso"]);
                    }
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
        $categorias = CategoriaEstudante::pluck('categoria', 'sigla');
        $provincias = Provincia::pluck('provincia', 'id');
        $cursos = Curso::pluck('curso', 'id');
        $ano_lectivos = AnoLectivo::pluck('ano_lectivo', 'ano_lectivo');
        $historico = HistoricEstudante::where(['id_estudante' => $estudante->id, 'ano_lectivo' => $estudante->ano_lectivo])->first();
        $docs_entregues = DocumentoEntregue::where(['id_historico' => $historico->id])->get();
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
            'getCategorias' => $categorias,
            'getDocsEntregues' => $docs_entregues,
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
            'docs_entregues' => ['required'],
            'docs_entregues.*' => ['string']
        ]);

        $ano_lectivo = AnoLectivo::where('ano_lectivo', $request->ano_lectivo)->first();
        if (!$ano_lectivo) {
            return back()->with(['error' => "Não encontrou ano lectivo"]);
        }

        $turma = Turma::find($request->turma);
        if (!$turma) {
            return back()->with(['error' => "Nao encontrou turma"]);
        }
        $nome_pasta = $turma->turma . "-" . $request->ano_lectivo;

        if ($request->bilhete != "" && $request->bilhete != $estudante->pessoa->bilhete) {
            $request->validate([
                'bilhete' => ['required', 'string', 'unique:pessoas,bilhete']
            ]);
        }

        $path = $estudante->pessoa->foto;
        if ($request->hasFile('foto') && $request->foto->isValid()) {
            $request->validate([
                'foto' => ['required', 'mimes:jpg,png,jpeg,JPG,PNG,JPEG', 'max:5000']
            ]);
            if ($estudante->pessoa->foto != "" && file_exists($estudante->pessoa->foto)) {
                unlink($estudante->pessoa->foto);
            }
            $path = $request->foto->store('fotos_estudantes/' . $nome_pasta);
        }

        $historico = HistoricEstudante::where(['id_estudante' => $estudante->id, 'ano_lectivo' => $estudante->ano_lectivo])->first();


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
            'bairro' => $request->bairro,
            'rua' => $request->rua,
            'residencia' => $request->residencia,
            'deficiencia' => $request->deficiencia,
            'tipo_deficiencia' => $request->tipo_deficiencia,
        ];

        $data['estudante'] = [
            'id_turma' => $request->turma,
            'id_encarregado' => $request->encarregado,
            'estado' => "on",
            'ano_lectivo' => $request->ano_lectivo,
            'categoria' => $request->categoria,
        ];

        $data['historico'] = [
            'id_turma' => $request->turma,
            'estado' => "on",
            'ano_lectivo' => $request->ano_lectivo,
            'categoria' => $request->categoria,
        ];

        $data['docs_entregues'] = [
            'id_historico' => $historico->id,
            'documento' => null,
            'estado' => "on",
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
                if (HistoricEstudante::find($historico->id)->update($data['historico'])) {
                    DocumentoEntregue::where(['id_historico' => $historico->id])->delete();
                    foreach ($request->docs_entregues as $docs) {
                        $data['docs_entregues']['documento'] = $docs;
                        DocumentoEntregue::create($data['docs_entregues']);
                    }
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
        $categorias = CategoriaEstudante::pluck('categoria', 'sigla');
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
            'getCategorias' => $categorias,
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
            'docs_entregues' => ['required'],
            'docs_entregues.*' => ['string']
        ]);

        if ($request->bilhete != "" && $request->bilhete != $estudante->pessoa->bilhete) {
            $request->validate([
                'bilhete' => ['required', 'string', 'unique:pessoas,bilhete']
            ]);
        }

        $ano_lectivo = AnoLectivo::where('ano_lectivo', $request->ano_lectivo)->first();
        if (!$ano_lectivo) {
            return back()->with(['error' => "Não encontrou ano lectivo"]);
        }

        $turma = Turma::find($request->turma);
        if (!$turma) {
            return back()->with(['error' => "Nao encontrou turma"]);
        }

        $nome_pasta = $turma->turma . "-" . $request->ano_lectivo;
        $path = $estudante->pessoa->foto;
        if ($request->hasFile('foto') && $request->foto->isValid()) {
            $request->validate([
                'foto' => ['required', 'mimes:jpg,png,jpeg,JPG,PNG,JPEG', 'max:5000']
            ]);
            if ($estudante->pessoa->foto != "" && file_exists($estudante->pessoa->foto)) {
                unlink($estudante->pessoa->foto);
            }
            $path = $request->foto->store('fotos_estudantes/' . $nome_pasta);
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
            'bairro' => $request->bairro,
            'rua' => $request->rua,
            'residencia' => $request->residencia,
            'deficiencia' => $request->deficiencia,
            'tipo_deficiencia' => $request->tipo_deficiencia,
        ];

        $data['estudante'] = [
            'id_turma' => $request->turma,
            'id_encarregado' => $request->encarregado,
            'estado' => "on",
            'ano_lectivo' => $request->ano_lectivo,
            'categoria' => $request->categoria,
        ];

        $data['historico'] = [
            'id_estudante' => $id_estudante,
            'id_turma' => $request->turma,
            'numero_acesso' => $estudante->numero_acesso,
            'estado' => "on",
            'ano_lectivo' => $request->ano_lectivo,
            'categoria' => $request->categoria,
        ];

        $data['docs_entregues'] = [
            'id_historico' => null,
            'documento' => null,
            'estado' => "on",
        ];

        if (HistoricEstudante::where(['id_estudante' => $id_estudante, 'ano_lectivo' => $data['estudante']['ano_lectivo']])->first()) {
            return back()->with(['error' => "Já confirmou para este ano"]);
        }

        if (Pessoa::find($estudante->pessoa->id)->update($data['pessoa'])) {
            if (Estudante::find($estudante->id)->update($data['estudante'])) {
                $historico = HistoricEstudante::create($data['historico']);
                if ($historico) {
                    foreach ($request->docs_entregues as $docs) {
                        $data['docs_entregues']['documento'] = $docs;
                        $data['docs_entregues']['id_historico'] = $historico->id;
                        DocumentoEntregue::create($data['docs_entregues']);
                    }
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
        $declaracao = Declaracao::where(['ano_emissao' => date('Y')])->get();
        $numero = $declaracao->count() + 1;
        $data = [
            'id_estudante' => $id_estudante,
            'tipo' => $request->tipo,
            'motivo' => $request->motivo,
            'numero' => $numero,
            'data_emissao' => $request->data,
            'ano_lectivo' => $request->ano_lectivo,
            'ano_emissao' => date('Y'),
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
            'epoca' => ['required', 'integer', 'min:1'],
            'ano_lectivo' => ['required', 'string', 'min:4', 'max:255'],
        ]);

        $transferencia = Transferencia::where(['ano_emissao' => date('Y')])->get();
        $numero = $transferencia->count() + 1;

        $data = [
            'id_estudante' => $id_estudante,
            'motivo' => $request->descricao,
            'data_emissao' => $request->data,
            'epoca' => $request->epoca,
            'numero' => $numero,
            'ano_lectivo' => $request->ano_lectivo,
            'ano_emissao' => date('Y'),
        ];

        if (Transferencia::where(['id_estudante' => $id_estudante,])->first()) {
            return back()->with(['error' => "Já foi transferido estudante"]);
        }

        if (Transferencia::create($data)) {
            if (HistoricEstudante::where(['id_estudante' => $id_estudante, 'ano_lectivo' => $request->ano_lectivo])->update(['observacao_final' => "transferido"])) {
                return back()->with(['success' => "Feito com sucesso"]);
            }
        }
    }

    public function desistencia($id_estudante, $ano_lectivo)
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

    public function store_desistencias(Request $request, $id_estudante)
    {
        $estudante = Estudante::find($id_estudante);
        if (!$estudante) {
            return back()->with(['error' => "Não encontrou estudante"]);
        }

        $request->validate([
            'data' => ['required', 'date'],
            'motivo' => ['required', 'string', 'min:5'],
            'epoca' => ['required', 'integer', 'min:1'],
            'ano_lectivo' => ['required', 'string', 'min:4', 'max:255'],
        ]);

        $data = [
            'id_estudante' => $id_estudante,
            'motivo' => $request->motivo,
            'data_saida' => $request->data,
            'epoca' => $request->epoca,
            'ano_lectivo' => $request->ano_lectivo,
        ];

        if (Desistencia::where(['id_estudante' => $id_estudante,])->first()) {
            return back()->with(['error' => "Já está desistido estudante"]);
        }

        if (Desistencia::create($data)) {
            if (HistoricEstudante::where(['id_estudante' => $id_estudante, 'ano_lectivo' => $request->ano_lectivo])->update(['observacao_final' => "desistencia"])) {
                return back()->with(['success' => "Feito com sucesso"]);
            }
        }
    }

    public function choose_declaracao($id_declaracao)
    {
        $declaracao = Declaracao::find($id_declaracao);
        if (!$declaracao) {
            return back()->with(['error' => "Não encontrou declaração"]);
        }
        $historico = HistoricEstudante::where(['id_estudante' => $declaracao->id_estudante, 'ano_lectivo' => $declaracao->ano_lectivo])->first();
        if (!$historico) {
            return back()->with(['error' => "Não encontrou estudante"]);
        }

        $turma = Turma::find($historico->id_turma);
        if (!$turma) {
            return back()->with(['error' => "Não encontrou turma"]);
        }

        $grade_disciplinas = Grade::where([
            'id_curso' => $turma->id_curso,
            'id_classe' => $turma->id_classe,
        ])->get();

        Session::forget('disciplinas');
        $data = [
            'title' => "Estudantes",
            'type' => "estudantes",
            'menu' => "Estudantes",
            'submenu' => "Declaração com Notas",
            'getDeclaracao' => $declaracao,
            'getHistorico' => $historico,
            'getTurma' => $turma,
            'getGrade' => $grade_disciplinas,
        ];
        return view('estudantes.choose_declaracao', $data);
    }

    public function destroy(Request $request)
    {
        $request->validate([
            'id_estudante' => ['required', 'integer', 'min:1'],
        ]);

        $estudante = Estudante::find($request->id_estudante);
        if (!$estudante) {
            return back()->with(['error' => "Não encontrou estudante"]);
        }

        //verificar se ja existe lancamentos de notas
        if (Trimestral::where(['id_estudante' => $request->id_estudante,])->first()) {
            return back()->with(['error' => "Não pode eliminar o estudante porque já tem lançamentos de notas feitos"]);
        }
        //verificar em pagamentos
        if (Pagamento::where(['id_estudante' => $request->id_estudante,])->first()) {
            return back()->with(['error' => "Não pode eliminar o estudante porque já tem pagamentos feitos"]);
        }

        $id_pessoa = $estudante->id_pessoa;
        $id_estudante = $estudante->id;
        Desistencia::where(['id_estudante' => $id_estudante])->delete();
        Transferencia::where(['id_estudante' => $id_estudante])->delete();
        Declaracao::where(['id_estudante' => $id_estudante])->delete();
        HistoricEstudante::where(['id_estudante' => $id_estudante])->delete();
        Estudante::find($id_estudante)->delete();

        if (Pessoa::find($id_pessoa)->delete()) {
            return back()->with(['success' => "Estudante eliminado com sucesso"]);
        }
    }

    public function restringir_notas()
    {
        $tipos_pagamentos = TipoPagamento::pluck('tipo', 'id');
        $anos_lectivos = AnoLectivo::orderBy('id', 'desc')->pluck('ano_lectivo', 'id');

        $data = [
            'title' => "Estudantes",
            'type' => "estudantes",
            'menu' => "Estudantes",
            'submenu' => "Restringir Notas",
            'getTipoPagamentos' => $tipos_pagamentos,
            'getAnos' => $anos_lectivos,
        ];
        return view('estudantes.restringir_notas', $data);
    }

    public function extrato($id_estudante, $ano_lectivo)
    {
        $estudante = Estudante::find($id_estudante);
        if (!$estudante) {
            return back()->with(['error' => "Não encontrou"]);
        }

        $historico = HistoricEstudante::where(['id_estudante' => $id_estudante, 'ano_lectivo' => $ano_lectivo])->first();
        if (!$historico) {
            return back()->with(['error' => "Estudante nao matriculado neste ano lectivo"]);
        }

        $pagamentos = Pagamento::where(['id_estudante' => $id_estudante, 'ano_lectivo' => $ano_lectivo])->get();

        $data = [
            'title' => "Estudantes",
            'type' => "estudantes",
            'menu' => "Estudantes",
            'submenu' => "Extrato de Pagamentos",
            'getHistorico' => $historico,
            'getPagamentos' => $pagamentos,
        ];
        return view('estudantes.extrato_pagamentos', $data);
    }

    public function restringir(Request $request)
    {
        $request->validate([
            'tipo_pagamento' => ['required', 'integer', 'min:1'],
            'epoca' => ['required', 'integer', 'min:1'],
            'ano_lectivo' => ['required', 'integer', 'min:1'],
        ]);

        $ano_lectivo = AnoLectivo::find($request->ano_lectivo);
        if (!$ano_lectivo) {
            return back()->with(['error' => "Não encontrou"]);
        }
        $epocas = null;
        if ($request->epoca == 1) {
            $epocas = [
                'Setembro',
                'Outubro',
                'Novembro',
                'Dezembro'
            ];
        } elseif ($request->epoca == 2) {
            $epocas = [
                'Janeiro',
                'Fevereiro',
                'Março',
                'Abril'
            ];
        } elseif ($request->epoca == 3) {
            $epocas = [
                'Abril',
                'Maio',
                'Junho',
            ];
        }
        $historico_estudantes = HistoricEstudante::where(['ano_lectivo' => $ano_lectivo->ano_lectivo])->get();
        /**lista de historico */
        foreach ($historico_estudantes as $historico) {

            /**lista de epocas */
            foreach ($epocas as $epoca) {

                /**verifica na tabela de pagamentos se o estudante efectuou nestas epocas */
                $pagamentos = Pagamento::where([
                    'id_estudante' => $historico->id_estudante,
                    'ano_lectivo' => $ano_lectivo->ano_lectivo,
                    'id_tipo_pagamento' => $request->tipo_pagamento,
                    'epoca' => $epoca,
                ])->first();

                $data['restricao'] = [

                    'id_estudante' => $historico->id_estudante,
                    'ano_lectivo' => $ano_lectivo->ano_lectivo,
                    'epoca' => $request->epoca,
                    'mes' => $epoca,
                    'id_tipo_pagamento' => $request->tipo_pagamento,
                    'estado' => "on"
                ];

                if (!$pagamentos) {
                    /**se nao pagou entao leva ele para lista das restricao */
                    /**se ainda nao existe cadastra*/
                    if (!RestricaoNota::where($data['restricao'])->first()) {
                        /**manda para restricao */
                        RestricaoNota::create($data['restricao']);
                    }
                } else {
                    /*pagou deve eliminar os os que estao nas restricoes*/
                    RestricaoNota::where($data['restricao'])->delete();
                }
            }
        }

        return back()->with(['success' => "Feito com sucesso"]);
    }

    public function termo($id_estudante, $ano_lectivo)
    {
        $estudante = Estudante::find($id_estudante);
        if (!$estudante) {
            return back()->with(['error' => "Não encontrou"]);
        }
        $ano = AnoLectivo::where(['ano_lectivo' => $ano_lectivo])->first();
        if (!$ano) {
            return back()->with(['error' => "Nao encontrou"]);
        }

        $historico = HistoricEstudante::where(['id_estudante' => $id_estudante, 'ano_lectivo' => $ano_lectivo])->first();
        if (!$historico) {
            return back()->with(['error' => "Estudante nao matriculado neste ano lectivo"]);
        }

        $turma = Turma::find($historico->id_turma);
        $grade_disciplinas = Grade::where([
            'id_curso' => $turma->id_curso,
            'id_classe' => $turma->id_classe,
        ])->get();

        Session::forget('disciplinas');
        $data = [
            'title' => "Estudantes",
            'type' => "estudantes",
            'menu' => "Estudantes",
            'submenu' => "Termos",
            'getTurma' => $turma,
            'getHistorico' => $historico,
            'getGrade' => $grade_disciplinas,
        ];
        return view('estudantes.create_termo', $data);
    }

    public function search_advanced()
    {
        $estudante = "nada";
        $data = [
            'title' => "Estudantes",
            'type' => "estudantes",
            'menu' => "Estudantes",
            'submenu' => "Pesquisa Avançada",
            'getEstudante' => $estudante,
        ];
        return view('estudantes.search_advanced', $data);
    }

    public function search_advancedP(Request $request)
    {
        $request->validate([
            'processo' => ['required', 'integer'],
        ]);
        $estudante = true;
        $estudante = Estudante::find($request->processo);
        $data = [
            'title' => "Estudantes",
            'type' => "estudantes",
            'menu' => "Estudantes",
            'submenu' => "Pesquisa Avançada",
            'getEstudante' => $estudante,
        ];
        return view('estudantes.search_advanced', $data);
    }

    public function restringir_destroy()
    {
        $restrincao = RestricaoNota::where('id', '>=', 1)->delete();

        return back()->with(['success' => "Feito com sucesso"]);
    }

    public function ficha_modificar($id_historico)
    {
        $historico = HistoricEstudante::find($id_historico);
        if (!$historico) {
            return back()->with(['error' => "Nao encontrou"]);
        }
        $historico->update(['ano_lectivo' => "2021-2022"]);

        return back()->with(['success' => "Feito com sucesso"]);
    }
}