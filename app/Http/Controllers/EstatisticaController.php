<?php

namespace App\Http\Controllers;

use App\AnoLectivo;
use App\Curso;
use App\Disciplina;
use App\EpocaPagamento;
use App\FormaPagamento;
use App\HistoricEstudante;
use App\Horario;
use App\TipoPagamento;
use App\Turma;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class EstatisticaController extends Controller
{

    public function lista_pagamento(){
        $tipo_pagamentos = TipoPagamento::pluck('tipo', 'id');
        $ano_lectivo = AnoLectivo::pluck('ano_lectivo', 'ano_lectivo');
        $cursos = Curso::pluck('curso', 'id');
        $data = [
            'title' => "Lista de Pagamentos",
            'type' => "estatisticas",
            'menu' => "Listas de Pagamentos",
            'submenu' => "Listar",
            'getTipoPagamentos'=>$tipo_pagamentos,
            'getCursos'=>$cursos,
            'getAnoLectivos'=>$ano_lectivo,
        ];
        return view('estatistica.pagamento.list', $data);
    }

    public function balanco($ano){
        $anos = AnoLectivo::orderBy('id', 'desc')->get();
        $tipo_pagamentos = TipoPagamento::get();
        $data = [
            'title' => "Balanços",
            'type' => "estatisticas",
            'menu' => "Balanços",
            'submenu' => "Gráfico",
            'getTipoPagamentos'=>$tipo_pagamentos,
            'getAnos'=>$anos,
            'getAno'=>$ano,
        ];
        return view('estatistica.balanco.list', $data);
    }

    public function minipauta($id_turma, $id_disciplina, $ano_lectivo){
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

        $data = [
            'title' => "Estatística",
            'type' => "estatisticas",
            'menu' => "Caderneta",
            'submenu' => "Estatistica",
            'getAno'=>$ano_lectivo,
            'getHorario'=>$horario,
        ];

        return view('estatistica.mini_pauta.list', $data);
    }

}