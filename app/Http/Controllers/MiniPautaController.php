<?php

namespace App\Http\Controllers;

use App\AnoLectivo;
use App\Disciplina;
use App\HistoricEstudante;
use App\Horario;
use App\Turma;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class MiniPautaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id_turma, $id_disciplina, $ano_lectivo)
    {
        $anos = AnoLectivo::where('ano_lectivo', $ano_lectivo)->first();
        if(!$anos){
            return back()->with(['error'=>"Ano Lectivo não encontrado"]);
        }
        $turma = Turma::find($id_turma)->first();
        if(!$turma){
            return back()->with(['error'=>"Turma não encontrada"]);
        }

        $disciplina = Disciplina::find($id_disciplina);
        if(!$disciplina){
            return back()->with(['error'=>"Não encontrou disciplina"]);
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

        $historico = HistoricEstudante::where(['id_turma'=>$id_turma, 'ano_lectivo'=>$ano_lectivo])
        ->get()->sortBy('estudante.pessoa.nome');

        $data2 = [
            'id_disciplinaMIN' => $id_disciplina,
            'ano_lectivoMIN' => $ano_lectivo,
        ];

        Session::put($data2);

        $data = [
            'title' => "Mini Pauta",
            'type' => "minipauta",
            'menu' => "Caderneta",
            'submenu' => "Listar",
            'getHorario' => $horario,
            'getHistorico'=>$historico,
        ];
        $id_ensino = $horario->turma->classe->id_ensino;

        if ($id_ensino == 1) {
            return "ensino primario iniciacao ate 6 classe";
        } else {
            return view('minipauta.ensino_1ciclo_7_9', $data);
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