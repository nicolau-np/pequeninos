<?php

namespace App\Http\Controllers;

use App\Curso;
use App\TipoPagamento;
use Illuminate\Http\Request;

class EstatisticaController extends Controller
{
    public function __construct()
    {
        $this->middleware('admin');
    }
    
    public function lista_pagamento(){
        $tipo_pagamentos = TipoPagamento::pluck('tipo', 'id');
        $cursos = Curso::pluck('curso', 'id');
        $data = [
            'title' => "Lista de Pagamentos",
            'type' => "estatisticas",
            'menu' => "Listas de Pagamentos",
            'submenu' => "Listar",
            'getTipoPagamentos'=>$tipo_pagamentos,
            'getCursos'=>$cursos,
        ];
        return view('estatistica.pagamento.list', $data);
    }

    public function balanco(){
        $data = [
            'title' => "Balanços",
            'type' => "estatisticas",
            'menu' => "Balanços",
            'submenu' => "Listar",
        ];
        return view('estatistica.balanco.list', $data);
    }
}