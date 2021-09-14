<?php

namespace App\Http\Controllers;

use App\AnoLectivo;
use App\DirectorTurma;
use App\Disciplina;
use App\Exports\ExportDocs;
use App\Funcionario;
use App\HistoricEstudante;
use App\Turma;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

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

    public function exports($id_turma, $ano_lectivo){
        $id_pessoa = Auth::user()->pessoa->id;
        $funcionario = Funcionario::where('id_pessoa', $id_pessoa)->first();
        if (!$funcionario) {
            return back()->with(['error' => "Não encontrou"]);
        }

        $turma = Turma::find($id_turma);
        if (!$turma) {
            return back()->with(['error' => "Não encontrou"]);
        }

        $ano_lecti = AnoLectivo::where('ano_lectivo', $ano_lectivo)->first();
        if (!$ano_lecti) {
            return back()->with(['error' => "Não encontrou"]);
        }

        if (Auth::user()->nivel_acesso == "professor") {
            $directorTurma = DirectorTurma::where([
                'id_funcionario' => $funcionario->id,
                'id_turma' => $id_turma,
                'ano_lectivo' => $ano_lectivo,
            ])->first();
            if (!$directorTurma) {
                return back()->with(['error' => "Não é Director desta turma"]);
            }
        }

        $fileName = "Pauta-" .$turma->turma." ".$ano_lectivo.".xlsx";
        return (new ExportDocs($id_turma,  $ano_lectivo))->download($fileName);
    }
}
