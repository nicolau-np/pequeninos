<?php

namespace App\Http\Controllers;

use App\AnoLectivo;
use App\DirectorTurma;
use App\Funcionario;
use App\Hora;
use App\Horario;
use App\Turma;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MinhaTurmaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
   public function __construct()
   {
        $this->middleware('prof');
   }

    public function index()
    {
        $id_pessoa = Auth::user()->pessoa->id;
        $funcionario = Funcionario::where('id_pessoa', $id_pessoa)->first();
        if(!$funcionario){
            return back()->with(['error'=>"Não encontrou"]);
        }
        $minha_turmas = DirectorTurma::orderBy('id', 'desc')->where('id_funcionario', $funcionario->id)->paginate('8');
        $data = [
            'title' => "Minha Turma",
            'type' => "minha turma",
            'menu' => "Minha Turma",
            'submenu' => "Listar",
            'getTurmas'=>$minha_turmas,
        ];
        return view('minha_turma.list', $data);
    }

    public function horario($id_turma, $ano_lectivo){
        $turma = Turma::find($id_turma);
        if(!$turma){
            return back()->with(['error' => "Não encontrou"]);
        }

        $ano = AnoLectivo::where(['ano_lectivo'=>$ano_lectivo])->first();
        if(!$ano){
            return back()->with(['error' => "Não encontrou"]);
        }

        $id_pessoa = Auth::user()->pessoa->id;
        $funcionario = Funcionario::where('id_pessoa', $id_pessoa)->first();
        if(!$funcionario){
            return back()->with(['error'=>"Não encontrou"]);
        }

        $horario = Horario::where(['id_turma' => $id_turma, 'ano_lectivo'=>$ano_lectivo])->get();

        $hora = Hora::orderBy('hora_entrada', 'asc')->get();

        $data = [
            'title' => "Horário",
            'type' => "Horário",
            'menu' => "Minha Turma",
            'submenu' => "Horário",
            'getTurma'=>$turma,
            'getHorario'=>$horario,
            'getAno'=>$ano_lectivo,
            'getHora'=>$hora,
        ];


        return view('minha_turma.horario', $data);

    }
}