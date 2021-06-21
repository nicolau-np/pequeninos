<?php

namespace App\Http\Controllers;

use App\Encarregado;
use App\Estudante;
use App\Funcionario;
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
            'title'=>"SIGE - Sistema de Gestão Escolar",
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
}