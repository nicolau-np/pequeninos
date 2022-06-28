<?php

namespace App\Http\Controllers;

use App\AnoLectivo;
use App\BloqueioEpoca;
use App\DirectorTurma;
use App\Funcionario;
use App\Grade;
use App\HistoricEstudante;
use App\OrdernaDisciplina;
use App\Turma;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class PautaController_copy extends Controller
{
    public function create($id_turma, $ano_lectivo)
    {
        $turma = Turma::find($id_turma);
        if (!$turma) {
            return back()->with(['error' => "Não encontrou turma"]);
        }

        $ano_lecti = AnoLectivo::where('ano_lectivo', $ano_lectivo)->first();
        if (!$ano_lecti) {
            return back()->with(['error' => "Não encontrou ano lectivo"]);
        }

        $id_pessoa = Auth::user()->pessoa->id;
        //se for administrador
        if ((Auth::user()->nivel_acesso == "admin") || (Auth::user()->nivel_acesso == "user")) {
            $directorTurma = DirectorTurma::where([
                'id_turma' => $id_turma,
                'ano_lectivo' => $ano_lectivo,
            ])->first();

            if (!$directorTurma) {
                return back()->with(['error' => "Não é Director desta turma"]);
            }
        } else {
            $funcionario = Funcionario::where('id_pessoa', $id_pessoa)->first();
            if (!$funcionario) {
                return back()->with(['error' => "Não encontrou funcionario"]);
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
        }

        $grade_disciplinas = Grade::where([
            'id_curso' => $turma->id_curso,
            'id_classe' => $turma->id_classe,
        ])->get();

        Session::forget('disciplinas');

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
        $turma = Turma::find($id_turma);
        if (!$turma) {
            return back()->with(['error' => "Não encontrou turma"]);
        }

        $ano_lecti = AnoLectivo::where('ano_lectivo', $ano_lectivo)->first();
        if (!$ano_lecti) {
            return back()->with(['error' => "Não encontrou ano lectivo"]);
        }

        $id_pessoa = Auth::user()->pessoa->id;
        //se for administrador
        if ((Auth::user()->nivel_acesso == "admin") || (Auth::user()->nivel_acesso == "user")) {
            $directorTurma = DirectorTurma::where([
                'id_turma' => $id_turma,
                'ano_lectivo' => $ano_lectivo,
            ])->first();

            if (!$directorTurma) {
                return back()->with(['error' => "Não é Director desta turma"]);
            }
        } else {
            $funcionario = Funcionario::where('id_pessoa', $id_pessoa)->first();
            if (!$funcionario) {
                return back()->with(['error' => "Não encontrou funcionario"]);
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
        }
        $id_ensino = $turma->classe->id_ensino;
        $classe = $turma->classe->classe;

        $historico = HistoricEstudante::where([
            'id_turma' => $id_turma,
            'ano_lectivo' => $ano_lectivo
        ])->orderBy('numero', 'asc')->get();

        //verificar se selecionou a ordem das disciplinas
        $ordena_disciplina = null;
        if (!Session::has('disciplinas')) {
            $ordena_disciplina = OrdernaDisciplina::where(['id_curso' => $turma->id_curso, 'id_classe' => $turma->id_classe])->get();
        }

        $epoca6 = BloqueioEpoca::where(['epoca'=>6])->first();
        $data = [
            'title' => "Pauta",
            'type' => "mobile",
            'menu' => "pauta",
            'submenu' => "Novo",
            'getDirector' => $directorTurma,
            'getHistorico' => $historico,
            'getOrdenaDisciplinas' =>$ordena_disciplina,
            'getEpocaBloqueio'=>$epoca6,
        ];


        if ($id_ensino == 1) {
            //se for classificacao quantitativa
            if (($classe == "2ª classe") || ($classe == "4ª classe") || ($classe == "1ª classe") || ($classe == "3ª classe") || ($classe == "5ª classe")) {
                return view('pauta.ensinos.ensino_primario_2_4_copy', $data);
            } //se for classificacao quantitativa
            elseif (($classe == "Iniciação")) {
                return view('pauta.ensinos.ensino_primario_Ini_1_3_5_copy', $data);
            } elseif (($classe == "6ª classe")) {
                return view('pauta.ensinos.ensino_primario_6_copy', $data);
            }
        } elseif ($id_ensino == 2) {
            if ($classe == "9ª classe") {
                return view('pauta.ensinos.ensino_1ciclo_9_copy', $data);
            } else {
                return view('pauta.ensinos.ensino_1ciclo_7_8_copy', $data);
            }
        }
    }
}