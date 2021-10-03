<?php

namespace App\Http\Controllers;

use App\Ensino;
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
        $ensinos = Ensino::orderBy('id', 'asc')->get();
        $data = [
            'title' => "Mapas",
            'type' => "mapas",
            'menu' => "Mapas",
            'submenu' => "Coordenadores",
            'getEnsinos'=> $ensinos,

        ];
        return view('mapas.coordenadores', $data);
    }

    public function aproveitamento(){
        $ensinos = Ensino::orderBy('id', 'asc')->get();
        $data = [
            'title' => "Mapas",
            'type' => "mapas",
            'menu' => "Mapas",
            'submenu' => "Aproveitamento",
            'getEnsinos'=> $ensinos,
        ];
        return view('mapas.aproveitamento', $data);
    }
}