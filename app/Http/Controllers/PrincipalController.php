<?php

namespace App\Http\Controllers;

use App\Estudante;
use App\Grade;
use App\HistoricEstudante;
use App\Trimestral;
use App\Turma;
use Illuminate\Http\Request;

class PrincipalController extends Controller
{
    public function index(){
        $data = [
            'title'=>"SIGE - Sistema de Gestão Escolar",
            'type'=>"principal",
            'menu'=>"Principal",
            'submenu'=>"",
        ];
        return view('principal.home', $data);
    }

    public function consultar()
    {
        $data = [
            'title'=>"SIGE - Sistema de Gestão Escolar",
            'type'=>"consulta",
            'menu'=>"Consultar",
            'submenu'=>"",
        ];
        return view('principal.consulta', $data);
    }

    public function dados(Request $request){

        $request->validate([
            'codigo_acesso'=> ['required', 'string', 'min:6'],
        ]);

        $estudante = Estudante::where(['numero_acesso'=>$request->codigo_acesso])->first();
        if(!$estudante){
            return back()->with(['error' => "Código de Acesso Incorrecto"]);
        }

        $turma = Turma::find($estudante->id_turma);
        if(!$turma){
            return back()->with(['error' => "Não encontrou turma do estudante"]);
        }

        $grades = Grade::where(['id_curso'=>$turma->id_curso, 'id_classe' => $turma->id_classe])->get();

        $data = [
            'title'=>"SIGE - Sistema de Gestão Escolar",
            'type'=>"consulta",
            'menu'=>"Consultar",
            'submenu'=>"Dados",
            'getEstudante'=> $estudante,
            'getGrades'=>$grades,
        ];
        return view('principal.dados', $data);
    }
}
