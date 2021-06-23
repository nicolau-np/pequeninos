<?php

namespace App\Http\Controllers;

use App\AnoLectivo;
use App\Disciplina;
use App\HistoricEstudante;
use App\Horario;
use App\Turma;
use Illuminate\Support\Facades\Session;

class EstatisticController extends Controller
{
    public function show($id_turma, $id_disciplina, $ano_lectivo){
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


        return view('estatic.list');
    }
}