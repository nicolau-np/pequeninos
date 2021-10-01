<?php

namespace App\Http\Controllers;

use App\AnoLectivo;
use App\Ensino;
use App\Imports\EstudanteImport;
use App\Turma;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

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
            'menu' => "Turma",
            'submenu' => "Listar",
            'getEnsinos' => $ensinos,
            'getAno'=>$ano_lectivo,
            'getAnos'=>$ano_lectivos,
        ];
        return view('turmas.list', $data);
    }

    public function import_create($id_turma, $ano_lectivo){
        $turma = Turma::find($id_turma);
        if(!$turma){
            return back()->with(['error' => "Não encontrou"]);
        }
        $ano_lectivos = AnoLectivo::where(['ano_lectivo'=>$ano_lectivo])->first();
        if(!$ano_lectivos){
            return back()->with(['error' => "Não encontrou"]);
        }

        if($ano_lectivos->estado == "off"){
            return back()->with(['error' => "Já não pode importar para este ano lectivo"]);
        }

        Session::put([
            'id_turmaIMP'=>$id_turma,
            'ano_lectivoIMP' =>$ano_lectivo,
        ]);

        $data = [
            'title' => "Turmas",
            'type' => "turmas",
            'menu' => "Turma",
            'submenu' => "Importar",
            'getTurma' =>$turma,
            'getAno' =>$ano_lectivo,
        ];
        return view('turmas.import', $data);
    }

    public function import_store(Request $request){
        $request->validate([
            'arquivo' => ['required', 'mimes:xlsx,xls'],
        ]);
        $file = $request->file('arquivo');

        $import = new EstudanteImport;

        if($import->import($file)){
            return back()->with(['success'=>"Feito com sucesso"]);
        }

    }
}
