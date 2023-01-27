<?php

namespace App\Http\Controllers;

use App\Encarregado;
use App\Estudante;
use App\Funcionario;
use App\HistoricEstudante;
use App\User;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {

        $usuarios = User::all();
        $funcionarios = Funcionario::all();
        $estudantes = Estudante::all();
        $encarregados = Encarregado::all();
        $data = [
            'title'=>"SIGE OKUSSOLEKA - Sistema de Gestão Escolar",
            'type'=>"home",
            'menu'=>"Home",
            'submenu'=>"",
            'getUsuarios'=>$usuarios,
            'getFuncionarios'=>$funcionarios,
            'getEstudantes'=>$estudantes,
            'getEncarregados'=>$encarregados,
        ];
        return view('home', $data);
    }

    public function lista_alterados(){
        $ano_lectivo = "2022-2023";
        $getHistoricoEstudanteAnos = HistoricEstudante::whereHas('turma', function($query){
           
        })->get();
        $data = [
            'title'=>"Estudantes alterados",
            'type'=>"home",
            'menu'=>"Home",
            'submenu'=>"",
            'getHistoricoEstudanteAnos'=>$getHistoricoEstudanteAnos,
        ];

        return view('lista-alterados',$data);
    }
}
