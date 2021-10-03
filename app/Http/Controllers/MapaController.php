<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MapaController extends Controller
{
    public function index()
    {
        $data = [
            'title' => "Mapas",
            'type' => "mapas",
            'menu' => "Mapas",
            'submenu' => "Listar",

        ];
        return view('mapas.list', $data);
    }


    public function coordenadores(){
        $data = [
            'title' => "Mapas",
            'type' => "mapas",
            'menu' => "Mapas",
            'submenu' => "Coordenadores",

        ];
        return view('mapas.coordenadores', $data);
    }

    public function aproveitamento(){
        $data = [
            'title' => "Mapas",
            'type' => "mapas",
            'menu' => "Mapas",
            'submenu' => "Aproveitamento",

        ];
        return view('mapas.aproveitamento', $data);
    }
}