<?php

namespace App\Http\Controllers;

use App\Fatura;
use App\HistoricEstudante;
use App\Pagamento;
use App\PagamentoPai;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

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
            'getPagamento'=>$pagamento
        ];
        
        return view('relatorios.fatura', $data);
    }
}