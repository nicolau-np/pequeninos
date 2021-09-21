<?php

namespace App\Http\Controllers;

use App\AnoLectivo;
use App\DirectorTurma;
use App\Funcionario;
use App\Grade;
use App\HistoricEstudante;
use App\Turma;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

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

    public function show($id_turma, $ano_lectivo)
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

        //verificar se e director desta turma
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

        Session::put('ano_lectivoP', $ano_lectivo);

        $id_ensino = $turma->classe->id_ensino;

        $historico = HistoricEstudante::where([
            'id_turma' => $id_turma,
            'ano_lectivo' => $ano_lectivo
        ])->get()->sortby('estudante.pessoa.nome');

        $data = [
            'title' => "Pauta",
            'type' => "pauta",
            'menu' => "pauta",
            'submenu' => "Novo",
            'getDirector' => $directorTurma,
            'getHistorico' => $historico,
        ];

        //verificar se selecionou a ordem das disciplinas
        if (!Session::has('disciplinas')) {
            return back()->with(['error' => "Deve selecionar as disciplinas"]);
        }
        if ($id_ensino == 1) {
            return "ensino primario iniciacao ate 6 classe";
        } elseif ($id_ensino == 2) {
            return view('pauta.ensinos.ensino_1ciclo_7_9_copy', $data);
        }
    }
}