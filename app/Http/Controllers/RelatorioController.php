<?php

namespace App\Http\Controllers;

use App\Fatura;
use App\HistoricEstudante;
use App\Pagamento;
use App\PagamentoPai;
use App\TipoPagamento;
use App\Turma;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use PDF;

class RelatorioController extends Controller
{
    public function __construct()
    {
        $this->middleware('admin');
    }

    public function fatura($id_fatura){
        
        $fatura = Fatura::find($id_fatura);
        if(!$fatura){
            return back()->with(['error'=>"Não encontrou numero da fatura"]);
        }
        $id_historico = Session::get('id_historico');
        $id_tipo_pagamento = Session::get('id_tipo_pagamento');
        $historico = HistoricEstudante::find($id_historico);
        if (!$historico) {
            return back()->with(['error' => "Não encontrou historico"]);
        }

        if($id_tipo_pagamento == 3){
            $pagamento = PagamentoPai::where('fatura', $id_fatura)->get();
        }else{
            $pagamento = Pagamento::where('fatura', $id_fatura)->get();
        }
        
        $data = [
            'getPagamento'=>$pagamento,
            'getHistorico'=>$historico,
            'getId_tipo_pagamento'=>$id_tipo_pagamento,
        ];
        $pdf = PDF::loadView('relatorios.fatura', $data)->setPaper('A4', 'normal');

        return $pdf->stream('fatura' . $id_fatura . '-' . date('Y') . '.pdf');
        
    }

    public function lista_pagamentos(Request $request){
        $request->validate([
            'tipo_pagamento'=>['required', 'Integer'],
            'curso'=>['required', 'Integer'],
            'classe'=>['required', 'Integer'],
            'turma'=>['required', 'Integer'],
            'ano_lectivo'=>['required', 'Integer'],
        ]);

        $tipo_pagamento = TipoPagamento::find($request->tipo_pagamento);
        if(!$tipo_pagamento){
            return back()->with(['error'=>"Não encontrou pagamento"]);
        } 

        $turma = Turma::find($request->turma);
        if(!$turma){
            return back()->with(['error'=>"Não encontrou turma"]);
        }

        $data = [
            'getTipoPagamento'=>$tipo_pagamento,
            'getTurma'=>$turma,
            'getAno'=>$request->ano_lectivo,
        ];
        $pdf = PDF::loadView('relatorios.lista_pagamento', $data)->setPaper('A4', 'normal');

        return $pdf->stream('Lista de ' . $tipo_pagamento->tipo . '-' . $turma->turma .' '.$request->ano_lectivo .'.pdf');
    }
}