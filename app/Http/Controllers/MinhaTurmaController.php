<?php

namespace App\Http\Controllers;

use App\AnoLectivo;
use App\DirectorTurma;
use App\Funcionario;
use App\Grade;
use App\Hora;
use App\Horario;
use App\Turma;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class MinhaTurmaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function list($ano_lectivo)
    {
        $ano_lectivos = AnoLectivo::where(['ano_lectivo' => $ano_lectivo])->first();
        if (!$ano_lectivos) {
            return back()->with(['error' => "Não encontrou"]);
        }
        $anos = AnoLectivo::orderBy('id', 'desc')->get();
        $id_pessoa = Auth::user()->pessoa->id;
        $funcionario = Funcionario::where('id_pessoa', $id_pessoa)->first();
        if (!$funcionario) {
            return back()->with(['error' => "Não encontrou"]);
        }
        $minha_turmas = DirectorTurma::orderBy('id', 'desc')->where(['id_funcionario' => $funcionario->id, 'ano_lectivo' => $ano_lectivo])->paginate('8');
        $data = [
            'title' => "Minha Turma",
            'type' => "minha turma",
            'menu' => "Minha Turma",
            'submenu' => "Listar",
            'getTurmas' => $minha_turmas,
            'getAnos' => $anos,
        ];
        return view('minha_turma.list', $data);
    }

    public function horario($id_turma, $ano_lectivo)
    {
        $id_pessoa = Auth::user()->pessoa->id;

        $turma = Turma::find($id_turma);
        if (!$turma) {
            return back()->with(['error' => "Não encontrou"]);
        }

        $ano = AnoLectivo::where(['ano_lectivo' => $ano_lectivo])->first();
        if (!$ano) {
            return back()->with(['error' => "Não encontrou"]);
        }

        if ((Auth::user()->nivel_acesso == "user") || (Auth::user()->nivel_acesso == "admin")) {
        } else {
            $funcionario = Funcionario::where('id_pessoa', $id_pessoa)->first();
            if (!$funcionario) {
                return back()->with(['error' => "Não encontrou funcionario"]);
            }
        }

        $hora = Hora::orderBy('hora_entrada', 'asc')->get();

        $data = [
            'title' => "Horário",
            'type' => "Horário",
            'menu' => "Minha Turma",
            'submenu' => "Horário",
            'getTurma' => $turma,
            'getAno' => $ano_lectivo,
            'getHora' => $hora,
        ];


        return view('minha_turma.horario', $data);
    }

    public function boletins_notas($id_turma, $ano_lectivo){
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
            'title' => "Boletins de Notas",
            'type' => "boletins",
            'menu' => "Minha Turma",
            'submenu' => "Boletins de Notas",
            'getDirector' => $directorTurma,
            'getGrade' => $grade_disciplinas,
        ];

        return view('minha_turma.new_boletins', $data);
    }

    public function fotografias($id_turma, $ano_lectivo){
        $ano_lectivos = AnoLectivo::where(['ano_lectivo'=>$ano_lectivo])->first();
        if(!$ano_lectivos){
            return back()->with(['error' => "Não encontrou ano lectivo"]);
        }

        $turma = Turma::find($id_turma);
        if(!$turma){
            return back()->with(['error' => "Não encontrou turma"]);
        }

        $data = [
            'title' => "Fotografias",
            'type' => "fotografias",
            'menu' => "Minha Turma",
            'submenu' => "Fotografias",
        ];

        return view('minha_turma.fotografias', $data);
    }
}