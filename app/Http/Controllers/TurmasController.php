<?php

namespace App\Http\Controllers;

use App\AnoLectivo;
use App\Ensino;
use Illuminate\Http\Request;

class TurmasController extends Controller
{
    public function index($ano_lectivo){
        $ano_lectivoV = AnoLectivo::where(['ano_lectivo'=>$ano_lectivo])->first();
        if(!$ano_lectivoV){
            return back()->with(['error' => "Não encontrou"]);
        }
        $ensinos = Ensino::orderBy('id', 'asc')->get();
        $ano_lectivos = AnoLectivo::orderBy('id', "desc")->get();
        $data = [
            'title' => "Turmas",
            'type' => "turmas",
            'menu' => "Turmas",
            'submenu' => "Listar",
            'getEnsinos' => $ensinos,
            'getAno'=>$ano_lectivo,
            'getAnos'=>$ano_lectivos,
        ];
        return view('turmas.list', $data);
    }
}