<?php

namespace App\Http\Controllers;

use App\AnoLectivo;
use App\Turma;
use Illuminate\Http\Request;

class OfflineOnlineController extends Controller
{
    public function list(){

        $data = [
            'title' => "Offline/Online",
            'type' => "offline_online",
            'menu' => "Offline/Online",
            'submenu' => "Listar",
        ];
        return view('offline_online.list', $data);
    }

    public function estudantes(){
        $anos = AnoLectivo::orderBy('id','desc')->pluck('ano_lectivo','id');
        $ano = AnoLectivo::orderBy('id', 'desc')->limit(1)->first();
        $turmas = Turma::where('turma', '!=', "Nenhuma")->orderBy('id', 'asc')->pluck('turma', 'id');
        $data = [
            'title' => "Offline/Online",
            'type' => "offline_online",
            'menu' => "Offline/Online",
            'submenu' => "Criar",
            'getTurmas'=>$turmas,
            'getAnos'=>$anos,
            'getAno'=>$ano,
        ];
        return view('offline_online.estudantes', $data);
    }
}
