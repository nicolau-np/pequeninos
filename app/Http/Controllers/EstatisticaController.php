<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class EstatisticaController extends Controller
{
    public function __construct()
    {
        $this->middleware('admin');
    }
    
    public function lista_pagamento(){
        $data = [
            'title' => "Lista de Pagamentos",
            'type' => "estatisticas",
            'menu' => "Listas de Pagamentos",
            'submenu' => "Listar",
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