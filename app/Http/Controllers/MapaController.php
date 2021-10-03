<?php

namespace App\Http\Controllers;

use App\AnoLectivo;
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


    public function coordenadores($ano_lectivo){
        $ano_lectivos = AnoLectivo::where('ano_lectivo', $ano_lectivo)->first();
        if(!$ano_lectivos){
            return back()->with(['error' => "Não encontrou ano lectivo"]);
        }

        $anos = AnoLectivo::orderBy('id', 'desc')->get();
        $ensinos = Ensino::orderBy('id', 'asc')->get();
        $data = [
            'title' => "Mapas",
            'type' => "mapas",
            'menu' => "Mapas",
            'submenu' => "Coordenadores",
            'getEnsinos'=> $ensinos,
            'getAnos' =>$anos,
            'getAno'=>$ano_lectivo,
        ];
        return view('mapas.coordenadores', $data);
    }

    public function aproveitamento($ano_lectivo){
        $ano_lectivos = AnoLectivo::where('ano_lectivo', $ano_lectivo)->first();
        if(!$ano_lectivos){
            return back()->with(['error' => "Não encontrou ano lectivo"]);
        }

        $anos = AnoLectivo::orderBy('id', 'desc')->get();
        $ensinos = Ensino::orderBy('id', 'asc')->get();
        $data = [
            'title' => "Mapas",
            'type' => "mapas",
            'menu' => "Mapas",
            'submenu' => "Aproveitamento",
            'getEnsinos'=> $ensinos,
            'getAnos' =>$anos,
            'getAno'=>$ano_lectivo,
        ];
        return view('mapas.aproveitamento', $data);
    }
}