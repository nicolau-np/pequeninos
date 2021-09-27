<?php

namespace App\Http\Controllers;

use App\AnoLectivo;
use App\DirectorTurma;
use App\Disciplina;
use App\Encarregado;
use App\EpocaPagamento;
use App\Estudante;
use App\Fatura;
use App\FormaPagamento;
use App\Funcionario;
use App\HistoricEstudante;
use App\Horario;
use App\Pagamento;
use App\PagamentoPai;
use App\TabelaPreco;
use App\TipoPagamento;
use App\Turma;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Maatwebsite\Excel\Facades\Excel;
use PDF;


class RelatorioController extends Controller
{

    public function fatura($id_fatura)
    {

        $fatura = Fatura::find($id_fatura);
        if (!$fatura) {
            return back()->with(['error' => "Não encontrou numero da fatura"]);
        }
        $id_historico = Session::get('id_historico');
        $id_tipo_pagamento = Session::get('id_tipo_pagamento');
        $historico = HistoricEstudante::find($id_historico);
        if (!$historico) {
            return back()->with(['error' => "Não encontrou historico"]);
        }
        $tipo_pagamento = TipoPagamento::find($id_tipo_pagamento);
        if ($id_tipo_pagamento == 3) {
            $pagamento = PagamentoPai::where('fatura', $id_fatura)->get();
        } else {
            $pagamento = Pagamento::where('fatura', $id_fatura)->get();
        }
        $educandos = Estudante::where('id_encarregado', $historico->estudante->id_encarregado)->get();
        $data = [
            'getPagamento' => $pagamento,
            'getHistorico' => $historico,
            'getId_tipo_pagamento' => $id_tipo_pagamento,
            'getTipoPagamento' => $tipo_pagamento,
            'getFatura' => $fatura,
            'getEducandos' => $educandos,
        ];
        $pdf = PDF::loadView('relatorios.fatura', $data)->setPaper('A4', 'normal');

        return $pdf->stream('fatura' . $id_fatura . '-' . date('Y') . '.pdf');
    }

    public function lista_pagamentos(Request $request)
    {
        $request->validate([
            'tipo_pagamento' => ['required', 'Integer'],
            'curso' => ['required', 'Integer'],
            'classe' => ['required', 'Integer'],
            'turma' => ['required', 'Integer'],
            'ano_lectivo' => ['required', 'string', 'max:255'],
        ]);

        $tipo_pagamento = TipoPagamento::find($request->tipo_pagamento);
        if (!$tipo_pagamento) {
            return back()->with(['error' => "Não encontrou pagamento"]);
        }

        $turma = Turma::find($request->turma);
        if (!$turma) {
            return back()->with(['error' => "Não encontrou turma"]);
        }

        $ano_lectivo = AnoLectivo::where('ano_lectivo', $request->ano_lectivo)->first();
        if (!$ano_lectivo) {
            return back()->with(['error' => "Não encontrou este ano lectivo"]);
        }
        $data['where'] = [
            'id_curso' => $request->curso,
            'id_classe' => $request->classe,
            'id_tipo_pagamento' => $request->tipo_pagamento,
        ];
        $tabela_preco = TabelaPreco::where($data['where'])->first();
        if (!$tabela_preco) {
            return back()->with(['error' => "Não existe este pagamento"]);
        }
        $forma_pagamentos = FormaPagamento::where('forma_pagamento', $tabela_preco->forma_pagamento)->first();
        $epoca_pagamentos = EpocaPagamento::where('id_forma_pagamento', $forma_pagamentos->id)->get();
        $historico = HistoricEstudante::where(['id_turma' => $request->turma, 'ano_lectivo' => $request->ano_lectivo])->get()->sortBy('estudante.pessoa.nome');
        $data = [
            'getTipoPagamento' => $tipo_pagamento,
            'getTurma' => $turma,
            'getAno' => $request->ano_lectivo,
            'getTabelaPreco' => $tabela_preco,
            'getEpocasPagamento' => $epoca_pagamentos,
            'getHistoricoEstudante' => $historico,

        ];
        $pdf = PDF::loadView('relatorios.lista_pagamento', $data)->setPaper('A4', 'landscape');

        return $pdf->stream('LISTA DE ' . strtoupper($tipo_pagamento->tipo) . '-'.$request->ano_lectivo.'[ ' . strtoupper($turma->turma) . ' - '.$turma->turno->turno.' - ' . $turma->curso->curso . ' ].pdf');
    }

    public function lista_comparticipacao(Request $request)
    {
        $request->validate([
            'ano_lectivo' => ['required', 'string', 'max:255'],
        ]);
        $ano_lectivo = AnoLectivo::find($request->ano_lectivo);
        if (!$ano_lectivo) {
            return back()->with(['error' => "Ano lectivo não encontrado"]);
        }

        $encarregados = Encarregado::WhereHas('pessoa', function ($query) {
            $query->orderBy('nome', 'desc');
        })->get();

        $data = [
            'getAno' => $ano_lectivo,
            'getEncarregados' => $encarregados,
        ];
        $pdf = PDF::loadView('relatorios.lista_encarregados', $data)->setPaper('A4', 'landscape');

        return $pdf->stream('LISTA DE COMPARTICIPAÇÃO - ' . $ano_lectivo->ano_lectivo . '.pdf');
    }

    public function lista_nominal($id_turma, $ano_lectivo)
    {
        $turma = Turma::find($id_turma);
        if (!$turma) {
            return back()->with(['error' => "Não encontrou"]);
        }

        $ano_lectivos = AnoLectivo::where('ano_lectivo', $ano_lectivo)->first();
        if (!$ano_lectivo) {
            return back()->with(['error' => "Não encontrou"]);
        }
        $historico = HistoricEstudante::whereHas('estudante.pessoa', function(){

        })->where(['id_turma' => $id_turma, 'ano_lectivo' => $ano_lectivo])->get()->sortBy('estudante.pessoa.nome');
        $data = [
            'getHistorico' => $historico,
            'getAno' => $ano_lectivo,
            'getTurma' => $turma,
        ];
        $pdf = PDF::loadView('relatorios.lista_nominal', $data)->setPaper('A4', 'normal');

        return $pdf->stream('LISTA NOMINAL '.$ano_lectivo. '[ '. strtoupper($turma->turma) . ' - ' . strtoupper($turma->turno->turno).' - ' .strtoupper($turma->curso->curso). ' ].pdf');
    }

    public function minipauta($id_turma, $id_disciplina, $ano_lectivo){

        $anos = AnoLectivo::where('ano_lectivo', $ano_lectivo)->first();
        if(!$anos){
            return back()->with(['error'=>"Ano Lectivo não encontrado"]);
        }

        $turma = Turma::find($id_turma);
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

        $data['view'] = [
            'getHorario' => $horario,
            'getHistorico' => $historico,
        ];

        //buscando ensino atraves de turma
        $id_ensino = $turma->classe->id_ensino;
        $classe = $turma->classe->classe;

        if ($id_ensino == 1) {//iniciacao ate 6
            //se for classificacao quantitativa
            if(($classe=="2ª classe") || ($classe=="4ª classe") || ($classe=="6ª classe")){
                $pdf = PDF::loadView('minipauta.pdf.ensino_primario_2_4_6_copy', $data['view'])->setPaper('A4', 'normal');


            }//se for classificacao quantitativa
            elseif(($classe=="Iniciação") || ($classe=="1ª classe") || ($classe=="3ª classe") || ($classe=="5ª classe")){
                $pdf = PDF::loadView('minipauta.pdf.ensino_primario_Ini_1_3_5_copy', $data['view'])->setPaper('A4', 'normal');


            }
        } elseif ($id_ensino == 2) {//7 classe ate 9 ensino geral
            if($classe == "9ª classe"){
                $pdf = PDF::loadView('minipauta.pdf.ensino_1ciclo_9_copy', $data['view'])->setPaper('A4', 'normal');


            }else{
                $pdf = PDF::loadView('minipauta.pdf.ensino_1ciclo_7_8_copy', $data['view'])->setPaper('A4', 'normal');

            }
        }
        return $pdf->stream('MINI-PAUTA '.$ano_lectivo.'[' . strtoupper($turma->turma) . ' ' . strtoupper($turma->turno->turno) .'-'.strtoupper($turma->curso->curso).'-'.strtoupper($horario->disciplina->disciplina). '].pdf');
    }


    public function pauta($id_turma, $ano_lectivo){
        $turma = Turma::find($id_turma);
        if (!$turma) {
            return back()->with(['error' => "Não encontrou turma"]);
        }

        $ano_lecti = AnoLectivo::where('ano_lectivo', $ano_lectivo)->first();
        if (!$ano_lecti) {
            return back()->with(['error' => "Não encontrou ano lectivo"]);
        }

        $id_pessoa = Auth::user()->pessoa->id;
        //se for administrador
        if ((Auth::user()->nivel_acesso == "admin") || (Auth::user()->nivel_acesso == "user")) {
            $directorTurma = DirectorTurma::where([
                'id_turma' => $id_turma,
                'ano_lectivo' => $ano_lectivo,
            ])->first();

            if (!$directorTurma) {
                return back()->with(['error' => "Não é Director desta turma"]);
            }
        } else {
            $funcionario = Funcionario::where('id_pessoa', $id_pessoa)->first();
            if (!$funcionario) {
                return back()->with(['error' => "Não encontrou funcionario"]);
            }

            if (Auth::user()->nivel_acesso == "professor") {
                $directorTurma = DirectorTurma::where([
                    'id_funcionario' => $funcionario->id,
                    'id_turma' => $id_turma,
                    'ano_lectivo' => $ano_lectivo,
                ])->first();

                if (!$directorTurma) {
                    return back()->with(['error' => "Não é Director desta turma"]);
                }
            }
        }

        if(!Session::has('disciplinas')){
            return back()->with(['error'=>"Deve selecionar as disciplinas"]);
        }

        $historico = HistoricEstudante::where(['id_turma'=>$id_turma, 'ano_lectivo'=>$ano_lectivo])
        ->get()->sortBy('estudante.pessoa.nome');

        $data['view'] = [
            'getDirector' => $directorTurma,
            'getHistorico' => $historico,
        ];

        //buscando ensino atraves de turma
        $id_ensino = $turma->classe->id_ensino;
        $classe = $turma->classe->classe;


        if ($id_ensino == 1) {//iniciacao ate 6
            //se for classificacao quantitativa
            if(($classe=="2ª classe") || ($classe=="4ª classe") || ($classe=="6ª classe")){
                $pdf = PDF::loadView('pauta.pdf.ensino_primario_2_4_6_copy', $data['view'])->setPaper('A3', 'landscape');


            }//se for classificacao quantitativa
            elseif(($classe=="Iniciação") || ($classe=="1ª classe") || ($classe=="3ª classe") || ($classe=="5ª classe")){
                $pdf = PDF::loadView('pauta.pdf.ensino_primario_Ini_1_3_5_copy', $data['view'])->setPaper('A3', 'landscape');


            }
        } elseif ($id_ensino == 2) {//7 classe ate 9 ensino geral
            if($classe == "9ª classe"){
                $pdf = PDF::loadView('pauta.pdf.ensino_1ciclo_9_copy', $data['view'])->setPaper('A3', 'landscape');


            }else{
                $pdf = PDF::loadView('pauta.pdf.ensino_1ciclo_7_8_copy', $data['view'])->setPaper('A3', 'landscape');

            }
        }
        return $pdf->stream('PAUTA '.$ano_lectivo.'[ ' . strtoupper($turma->turma) . ' ' . strtoupper($turma->turno->turno) .'-'.strtoupper($turma->curso->curso).' ].pdf');
    }
}
