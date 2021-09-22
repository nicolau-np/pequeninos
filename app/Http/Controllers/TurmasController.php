<?php

namespace App\Http\Controllers;

use App\AnoLectivo;
use App\Ensino;
use Illuminate\Http\Request;

class TurmasController extends Controller
{
    public function index(){
        $ensinos = Ensino::orderBy('id', 'asc')->get();
        $ano_lectivo = AnoLectivo::orderBy('id', "desc")->get();
        $data = [
            'title' => "Turmas",
            'type' => "turmas",
            'menu' => "Turmas",
            'submenu' => "Listar",
            'getEnsinos' => $ensinos,
            'getAno'=>$ano_lectivo,
        ];
        return view('turmas.list', $data);
    }
}