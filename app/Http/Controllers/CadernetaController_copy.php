<?php

namespace App\Http\Controllers;

use App\Funcionario;
use App\Horario;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class CadernetaController_copy extends Controller
{
    public function index(){
        $id_pessoa = Auth::user()->pessoa->id;
        $funcionario = Funcionario::where('id_pessoa', $id_pessoa)->first();
        $data['where'] = [
            'id_funcionario' => $funcionario->id,
            'estado' => "visivel",
        ];
        $horarios = Horario::where($data['where'])->orderBy('ano_lectivo', 'desc')->paginate(8);
        Session::put('id_funcionario', $funcionario->id);
        $data = [
            'title' => "Caderneta",
            'type' => "caderneta",
            'menu' => "Caderneta",
            'submenu' => "Listar",
            'getHorario' => $horarios,
        ];
        return view('caderneta.list', $data);
    }
}