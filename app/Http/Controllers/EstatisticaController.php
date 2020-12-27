<?php

namespace App\Http\Controllers;

use App\AnoLectivo;
use App\Curso;
use App\EpocaPagamento;
use App\FormaPagamento;
use App\TipoPagamento;
use Illuminate\Http\Request;

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

}