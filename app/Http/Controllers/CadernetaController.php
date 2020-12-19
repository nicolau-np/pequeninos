<?php

namespace App\Http\Controllers;

use App\AnoLectivo;
use App\Avaliacao;
use App\Disciplina;
use App\Estudante;
use App\Funcionario;
use App\Horario;
use App\NotaFinal;
use App\NotaTrimestral;
use App\Prova;
use App\Turma;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class CadernetaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function __construct()
    {
        $this->middleware('prof');
    }

    public function index()
    {
        $id_pessoa = Auth::user()->pessoa->id;
        $funcionario = Funcionario::where('id_pessoa', $id_pessoa)->first();
        $data['where'] = [
            'id_funcionario' => $funcionario->id,
            'estado' => "visivel",
        ];
        $horarios = Horario::where($data['where'])->orderBy('ano_lectivo', 'desc')->paginate(8);
        Session::put('id_funcionario', $funcionario->id);
        $data = [
            'title' => "Caderneta",
            'type' => "caderneta",
            'menu' => "Caderneta",
            'submenu' => "Listar",
            'getHorario' => $horarios,
        ];
        return view('caderneta.list', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id_turma, $id_disciplina, $ano_lectivo, $epoca)
    {
        //verificar se a epoca existe
        if (($epoca != 1) && ($epoca != 2) && ($epoca != 3) && ($epoca != 4)) {
            return back()->with(['error' => "Não encontrou epoca"]);
        } else {
            Session::put('epoca', $epoca);
        }

        //veirficar turma se existe
        $id_ensino = null;
        $turma = Turma::find($id_turma);
        if (!$turma) {
            return back()->with(['error' => "Não encontrou turma"]);
        }
        //buscando ensino atraves de turma
        $id_ensino = $turma->classe->id_ensino;

        //pegando ano lectivo e verificando
        $ano_lectivos = AnoLectivo::where('ano_lectivo', $ano_lectivo)->first();
        if (!$ano_lectivos) {
            return back()->with(['error' => "Não encontrou ano lectivo"]);
        }

        //verificando disciplina
        $disciplina = Disciplina::find($id_disciplina);
        if (!$disciplina) {
            return back()->with(['error' => "Não encontrou disciplina"]);
        }

        //verificando se o professor e dono desta turma
        if (Session::has('id_funcionario')) {
            //verificando horario e funcionario
            $data['where_horario'] = [
                'id_funcionario' => Session::get('id_funcionario'),
                'id_turma' => $id_turma,
                'id_disciplina' => $id_disciplina,
                'ano_lectivo' => $ano_lectivo,
                'estado' => "visivel"
            ];

            $horario = Horario::where($data['where_horario'])->first();
            if (!$horario) {
                return back()->with(['error' => "Não é professor desta turma"]);
            }
        } else {
            return back()->with(['error' => "Deve iniciar sessão"]);
        }
        //prova e avalicao
        $data2 = [
            'id_disciplinaCAD' => $id_disciplina,
            'id_turmaCAD' => $id_turma,
            'ano_lectivoCAD' => $ano_lectivo,
            'epocaCAD' => $epoca,
        ];

        Session::put($data2);

        $avalicao = null;
        $prova = null;
        $global = null;

        if ($epoca != 4) {
            //pegando avalicao
            $avalicao = Avaliacao::whereHas('estudante', function ($query) use ($data2) {
                $query->where('id_turma', $data2['id_turmaCAD']);
                $query->where('ano_lectivo', $data2['ano_lectivoCAD']);
            })->where(['epoca' => $data2['epocaCAD'], 'id_disciplina' => $data2['id_disciplinaCAD']])
                ->get()->sortBy('estudante.pessoa.nome');

            //pegando prova
            $prova = Prova::whereHas('estudante', function ($query) use ($data2) {
                $query->where('id_turma', $data2['id_turmaCAD']);
                $query->where('ano_lectivo', $data2['ano_lectivoCAD']);
            })->where(['epoca' => $data2['epocaCAD'], 'id_disciplina' => $data2['id_disciplinaCAD']])
                ->get()->sortBy('estudante.pessoa.nome');
        } else {
            //pegando global
            $global = NotaFinal::whereHas('estudante', function ($query) use ($data2) {
                $query->where('id_turma', $data2['id_turmaCAD']);
                $query->where('ano_lectivo', $data2['ano_lectivoCAD']);
            })->where(['id_disciplina' => $data2['id_disciplinaCAD']])
                ->get()->sortBy('estudante.pessoa.nome');
        }

        $data = [
            'title' => "Caderneta",
            'type' => "caderneta",
            'menu' => "Caderneta",
            'submenu' => "Lancamento",
            'getHorario' => $horario,
            'getId_turma' => $id_turma,
            'getId_disciplina' => $id_disciplina,
            'getAno_lectivo' => $ano_lectivo,
            'getAvaliacao' => $avalicao,
            'getProva' => $prova,
            'getGlobal' => $global,
        ];

        if ($id_ensino == 1) {
            return "ensino primario iniciacao ate 6 classe";
        } elseif ($id_ensino == 2) {
            return view('caderneta.ensinos.ensino_1ciclo_7_9', $data);
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store($id_turma, $id_disciplina, $ano_lectivo)
    {
        $epocas = [
            1, 2, 3
        ];
        $turma = Turma::find($id_turma);
        if (!$turma) {
            return back()->with(['error' => "Não encontrou turma"]);
        }

        $ano_lectivos = AnoLectivo::where('ano_lectivo', $ano_lectivo)->first();
        if (!$ano_lectivos) {
            return back()->with(['error' => "Não encontrou ano lectivo"]);
        }

        $disciplina = Disciplina::find($id_disciplina);
        if (!$disciplina) {
            return back()->with(['error' => "Não encontrou disciplina"]);
        }

        if (Session::has('id_funcionario')) {
            //verificando horario e funcionario
            $data['where_horario'] = [
                'id_funcionario' => Session::get('id_funcionario'),
                'id_turma' => $id_turma,
                'id_disciplina' => $id_disciplina,
                'ano_lectivo' => $ano_lectivo,
                'estado' => "visivel"
            ];

            $horario = Horario::where($data['where_horario'])->first();
            if (!$horario) {
                return back()->with(['error' => "Não é professor desta turma"]);
            }
        } else {
            return back()->with(['error' => "Deve iniciar sessão"]);
        }

        $data['avaliacao'] = [
            'id_estudante' => null,
            'id_disciplina' => $id_disciplina,
            'epoca' => null,
            'ano_lectivo' => $ano_lectivo,
        ];

        $data['prova'] = [
            'id_estudante' => null,
            'id_disciplina' => $id_disciplina,
            'epoca' => null,
            'ano_lectivo' => $ano_lectivo,
        ];

        $data['trimestral'] = [
            'id_estudante' => null,
            'id_disciplina' => $id_disciplina,
            'epoca' => null,
            'ano_lectivo' => $ano_lectivo,
        ];

        $data['final'] = [
            'id_estudante' => null,
            'id_disciplina' => $id_disciplina,
            'ano_lectivo' => $ano_lectivo,
        ];

        $estudantes = Estudante::where(['id_turma' => $id_turma, 'ano_lectivo' => $ano_lectivo])->get();

        //cadastrar avaliacao
        foreach ($epocas as $epoca) {
            $data['avaliacao']['epoca'] = $epoca;
            foreach ($estudantes as $estudante) {
                $data['avaliacao']['id_estudante'] = $estudante->id;
                if (!Avaliacao::where($data['avaliacao'])->first()) {
                    $avaliacao = Avaliacao::create($data['avaliacao']);
                }
            }
        }
        //cadastrar prova
        foreach ($epocas as $epoca) {
            $data['prova']['epoca'] = $epoca;
            foreach ($estudantes as $estudante) {
                $data['prova']['id_estudante'] = $estudante->id;
                if (!Prova::where($data['prova'])->first()) {
                    $prova = Prova::create($data['prova']);
                }
            }
        }

        //cadastrar notas trimestrais
        foreach ($epocas as $epoca) {
            $data['trimestral']['epoca'] = $epoca;
            foreach ($estudantes as $estudante) {
                $data['trimestral']['id_estudante'] = $estudante->id;
                if (!NotaTrimestral::where($data['trimestral'])->first()) {
                    $nota_trimestral = NotaTrimestral::create($data['trimestral']);
                }
            }
        }
        //cadastrar notas finais
        foreach ($estudantes as $estudante) {
            $data['final']['id_estudante'] = $estudante->id;
            if (!NotaFinal::where($data['final'])->first()) {
                $nota_trimestral = NotaFinal::create($data['final']);
            }
        }

        return back()->with(['success' => "Actualizou com sucesso"]);
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

    public function store_copy($id_turma, $id_disciplina, $epoca, $ano_lectivo)
    {
        if (($epoca == 1) || ($epoca == 2) || ($epoca == 3)) {

            $turma = Turma::find($id_turma);
            if (!$turma) {
                return back()->with(['error' => "Não encontrou turma"]);
            }

            $ano_lectivos = AnoLectivo::where('ano_lectivo', $ano_lectivo)->first();
            if (!$ano_lectivos) {
                return back()->with(['error' => "Não encontrou ano lectivo"]);
            }

            $disciplina = Disciplina::find($id_disciplina);
            if (!$disciplina) {
                return back()->with(['error' => "Não encontrou disciplina"]);
            }

            if (Session::has('id_funcionario')) {
                //verificando horario e funcionario
                $data['where_horario'] = [
                    'id_funcionario' => Session::get('id_funcionario'),
                    'id_turma' => $id_turma,
                    'id_disciplina' => $id_disciplina,
                    'ano_lectivo' => $ano_lectivo,
                    'estado' => "visivel"
                ];

                $horario = Horario::where($data['where_horario'])->first();
                if (!$horario) {
                    return back()->with(['error' => "Não é professor desta turma"]);
                }
            } else {
                return back()->with(['error' => "Deve iniciar sessão"]);
            }

            $data['avaliacao'] = [
                'id_estudante' => null,
                'id_disciplina' => $id_disciplina,
                'epoca' => $epoca,
                'ano_lectivo' => $ano_lectivo,
            ];

            $data['prova'] = [
                'id_estudante' => null,
                'id_disciplina' => $id_disciplina,
                'epoca' => $epoca,
                'ano_lectivo' => $ano_lectivo,
            ];

            $data['trimestral'] = [
                'id_estudante' => null,
                'id_disciplina' => $id_disciplina,
                'epoca' => $epoca,
                'ano_lectivo' => $ano_lectivo,
            ];

            $data['final'] = [
                'id_estudante' => null,
                'id_disciplina' => $id_disciplina,
                'ano_lectivo' => $ano_lectivo,
            ];

            $estudantes = Estudante::where(['id_turma' => $id_turma, 'ano_lectivo' => $ano_lectivo])->get();

            //cadastrar avaliacao

            foreach ($estudantes as $estudante) {
                $data['avaliacao']['id_estudante'] = $estudante->id;
                if (!Avaliacao::where($data['avaliacao'])->first()) {
                    $avaliacao = Avaliacao::create($data['avaliacao']);
                }
            }

            //cadastrar prova

            foreach ($estudantes as $estudante) {
                $data['prova']['id_estudante'] = $estudante->id;
                if (!Prova::where($data['prova'])->first()) {
                    $prova = Prova::create($data['prova']);
                }
            }

            foreach ($estudantes as $estudante) {
                $data['trimestral']['id_estudante'] = $estudante->id;
                if (!NotaTrimestral::where($data['trimestral'])->first()) {
                    $nota_trimestral = NotaTrimestral::create($data['trimestral']);
                }
            }

            //cadastrar notas finais
            foreach ($estudantes as $estudante) {
                $data['final']['id_estudante'] = $estudante->id;
                if (!NotaFinal::where($data['final'])->first()) {
                    $nota_trimestral = NotaFinal::create($data['final']);
                }
            }

            return back()->with(['success' => "Actualizou com sucesso"]);
        } else {
            return back(['success' => "Actualizado com sucesso"]);
        }
    }
}