<?php

namespace App\Http\Controllers;

use App\BloqueioEpoca;
use App\ConfigBloqueio;
use Illuminate\Http\Request;

class BloqueioController extends Controller
{



    public function index(){
        $bloqueios = BloqueioEpoca::all();
        $data = [
            'title' => "Bloqueios de Epocas",
            'type' => "bloqueios",
            'menu' => "Bloqueios de Epocas",
            'submenu' => "Listar",
            'getBloqueios' => $bloqueios,
        ];
        return view('bloqueio.list', $data);
    }

    public function update($id){
        $bloqueio = BloqueioEpoca::find($id);
        if(!$bloqueio){
            return back()->with(['error' => "Não encontrou"]);
        }

        if($bloqueio->estado == "on"){
            $estado = "off";
        }else{
            $estado = "on";
        }
        $data = [
            'estado'=>$estado,
        ];

        if(BloqueioEpoca::find($id)->update($data)){
            return back()->with(['success' => "Epoca ".$bloqueio->epoca." mudado para o estado ".$estado]);
        }
    }

    public function config($id){
        $bloqueio = BloqueioEpoca::find($id);
        if(!$bloqueio){
            return back()->with(['error' => "Não encontrou"]);
        }
        $config_bloqueios = ConfigBloqueio::where(['id_bloqueio'=>$id])->get();
        $data = [
            'title' => "Bloqueios de Epocas",
            'type' => "bloqueios",
            'menu' => "Bloqueios de Epocas",
            'submenu' => "Configurar",
            'getBloqueio'=>$bloqueio,
            'getConfigBloqueio'=>$config_bloqueios,
        ];

        return view('bloqueio.configurar', $data);
    }
}