<?php

namespace App\Http\Controllers;

use App\AnoLectivo;
use App\Disciplina;
use App\Exports\ExportDocs;
use App\Turma;
use Illuminate\Http\Request;

class ExportController extends Controller
{
    public function minipauta($id_turma, $id_disciplina, $ano_lectivo){
        $turma = Turma::find($id_turma);
        if(!$turma){
            return back()->with(['error'=>"Turma não encontrada"]);
        }

        $ano_lectivos = AnoLectivo::where('ano_lectivo', $ano_lectivo)->first();
        if(!$ano_lectivos){
            return back()->with(['error'=>"Não encontrou ano lectivo"]);
        }

        $disciplina = Disciplina::find($id_disciplina);
        if(!$disciplina){
            return back()->with(['error' => "Não encontrou disciplina"]);
        }

        $fileName = "Mini Pauta-" .$turma->turma." ".$disciplina->disciplina." ".$ano_lectivo.".xlsx";
        return (new ExportDocs($id_turma, $id_disciplina, $ano_lectivo))->download($fileName);
    }
}