<?php

namespace App\Http\Controllers;

use App\AnoLectivo;
use App\Encarregado;
use App\EpocaPagamento;
use App\Estudante;
use App\Exports\EstudanteExport;
use App\Fatura;
use App\FormaPagamento;
use App\HistoricEstudante;
use App\Pagamento;
use App\PagamentoPai;
use App\TabelaPreco;
use App\TipoPagamento;
use App\Turma;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Maatwebsite\Excel\Facades\Excel;
use PDF;

class RelatorioController extends Controller
{
    public function __construct()
    {
        $this->middleware('admin');
    }

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
        $pdf = PDF::loadView('relatorios.lista_pagamento', $data)->setPaper('A4', 'normal');

        return $pdf->stream('Lista de ' . $tipo_pagamento->tipo . '-' . $turma->turma . ' ' . $request->ano_lectivo . '.pdf');
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
        $pdf = PDF::loadView('relatorios.lista_encarregados', $data)->setPaper('A4', 'normal');

        return $pdf->stream('Lista de Comparticipação ' . $ano_lectivo->ano_lectivo . '.pdf');
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

        return $pdf->stream('Lista Nominal ' . $turma->turma . '' . $ano_lectivo . '.pdf');
    }
}