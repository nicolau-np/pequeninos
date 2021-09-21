<?php

namespace App\Http\Controllers;

use App\AnoLectivo;
use App\DirectorTurma;
use App\Funcionario;
use App\Grade;
use App\Turma;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PautaController_copy extends Controller
{
    public function create($id_turma, $ano_lectivo)
    {
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
        $grade_disciplinas = Grade::where([
            'id_curso' => $turma->id_curso,
            'id_classe' => $turma->id_classe,
        ])->get();

        $data = [
            'title' => "Pauta",
            'type' => "pauta",
            'menu' => "pauta",
            'submenu' => "Visualizar",
            'getDirector' => $directorTurma,
            'getGrade' => $grade_disciplinas,
        ];

        return view('minha_turma.new', $data);
    }
}
