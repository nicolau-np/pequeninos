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

    public function coodernador(){
        
    }

    public function aproveitamento(){

    }
}