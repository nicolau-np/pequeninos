<?php

namespace App\Http\Controllers;

use App\AnoLectivo;
use App\CategoriaEstudante;
use App\Ensino;
use App\TipoPagamento;
use Illuminate\Http\Request;

class MapaController extends Controller
{
    public function index()
    {
        $ano_lectivos = AnoLectivo::pluck('ano_lectivo', 'id');
        $data = [
            'title' => "Mapas",
            'type' => "mapas",
            'menu' => "Mapas",
            'submenu' => "Listar",
            'getAnoLectivo' => $ano_lectivos

        ];
        return view('mapas.list', $data);
    }


    public function coordenadores($ano_lectivo)
    {
        $ano_lectivos = AnoLectivo::where('ano_lectivo', $ano_lectivo)->first();
        if (!$ano_lectivos) {
            return back()->with(['error' => "Não encontrou ano lectivo"]);
        }

        $anos = AnoLectivo::orderBy('id', 'desc')->get();
        $ensinos = Ensino::orderBy('id', 'asc')->get();
        $data = [
            'title' => "Mapas",
            'type' => "mapas",
            'menu' => "Mapas",
            'submenu' => "Coordenadores",
            'getEnsinos' => $ensinos,
            'getAnos' => $anos,
            'getAno' => $ano_lectivo,
        ];
        return view('mapas.coordenadores', $data);
    }

    public function aproveitamento($ano_lectivo)
    {
        $ano_lectivos = AnoLectivo::where('ano_lectivo', $ano_lectivo)->first();
        if (!$ano_lectivos) {
            return back()->with(['error' => "Não encontrou ano lectivo"]);
        }

        $anos = AnoLectivo::orderBy('id', 'desc')->get();
        $ensinos = Ensino::orderBy('id', 'asc')->get();
        $data = [
            'title' => "Mapas",
            'type' => "mapas",
            'menu' => "Mapas",
            'submenu' => "Aproveitamento",
            'getEnsinos' => $ensinos,
            'getAnos' => $anos,
            'getAno' => $ano_lectivo,
        ];
        return view('mapas.aproveitamento', $data);
    }

    public function estatistica($ano_lectivo)
    {
        $ano_lectivos = AnoLectivo::where('ano_lectivo', $ano_lectivo)->first();
        if (!$ano_lectivos) {
            return back()->with(['error' => "Não encontrou ano lectivo"]);
        }

        $anos = AnoLectivo::orderBy('id', 'desc')->get();
        $ensinos = Ensino::orderBy('id', 'asc')->get();
        $data = [
            'title' => "Mapas",
            'type' => "mapas",
            'menu' => "Mapas",
            'submenu' => "Estatística",
            'getEnsinos' => $ensinos,
            'getAnos' => $anos,
            'getAno' => $ano_lectivo,
        ];
        return view('mapas.estatistica', $data);
    }

    public function balancos()
    {
        $data = [
            'title' => "Mapas",
            'type' => "mapas",
            'menu' => "Mapas",
            'submenu' => "Balanços",
        ];
        return view('mapas.balancos', $data);
    }

    public function balanco_geral($ano_lectivo)
    {
        $ano_lect = AnoLectivo::where(['ano_lectivo' => $ano_lectivo])->first();
        if (!$ano_lect) {
            return back()->with(['error' => "Nao encontrou"]);
        }
        $ano_lectivos = AnoLectivo::orderBy('id', 'desc')->get();
        $tipo_pagamentos = TipoPagamento::get();
        $data = [
            'title' => "Balanços",
            'type' => "mobile",
            'menu' => "Mapas",
            'submenu' => "Geral",
            'getAnos' => $ano_lectivos,
            'getTipoPagamentos' => $tipo_pagamentos,
            'getAno' => $ano_lectivo,

        ];
        return view('mapas.balanco_geral', $data);
    }


    public function balanco_categoria($ano_lectivo)
    {
        $ano_lect = AnoLectivo::where(['ano_lectivo' => $ano_lectivo])->first();
        if (!$ano_lect) {
            return back()->with(['error' => "Nao encontrou"]);
        }
        $ano_lectivos = AnoLectivo::orderBy('id', 'desc')->get();
        $tipo_pagamentos = TipoPagamento::get();
        $categorias = CategoriaEstudante::get();
        $data = [
            'title' => "Balanços",
            'type' => "mobile",
            'menu' => "Mapas",
            'submenu' => "Categoria",
            'getAnos' => $ano_lectivos,
            'getTipoPagamentos' => $tipo_pagamentos,
            'getAno' => $ano_lectivo,
            'getCategorias' => $categorias,
        ];
        return view('mapas.balanco_categoria', $data);
    }

    public function balanco_diario()
    {
        $data = [
            'title' => "Balanços",
            'type' => "mapas",
            'menu' => "Mapas",
            'submenu' => "Período",
        ];
        return view('mapas.balanco_diario', $data);
    }

    public function saidas()
    {
        $data = [
            'title' => "Saídas",
            'type' => "mapas",
            'menu' => "Mapas",
            'submenu' => "Saídas",
        ];
        return view('mapas.saidas', $data);
    }
}