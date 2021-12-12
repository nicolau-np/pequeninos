<?php

namespace App\Http\Controllers;

use App\AnoLectivo;
use App\DirectorTurma;
use App\Estudante;
use App\Funcionario;
use App\Grade;
use App\HistoricEstudante;
use App\Hora;
use App\Horario;
use App\Pessoa;
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

        if ((Auth::user()->nivel_acesso == "user") || (Auth::user()->nivel_acesso == "admin") || (Auth::user()->nivel_acesso == "super")) {
        } else {
            $funcionario = Funcionario::where('id_pessoa', $id_pessoa)->first();
            if (!$funcionario) {
                return back()->with(['error' => "Não encontrou funcionario"]);
            }
        }

        $data = [
            'id_classe' => $turma->id_classe,
            'id_curso' => $turma->id_curso,
        ];

        $grades = Grade::where($data)->get();

        $data = [
            'title' => "Horário",
            'type' => "Horário",
            'menu' => "Minha Turma",
            'submenu' => "Horário",
            'getTurma' => $turma,
            'getAno' => $ano_lectivo,
            'getGrades' => $grades,
        ];


        return view('minha_turma.horario', $data);
    }

    public function boletins_notas($id_turma, $ano_lectivo)
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
        if ((Auth::user()->nivel_acesso == "admin") || (Auth::user()->nivel_acesso == "user") || (Auth::user()->nivel_acesso == "super")) {
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

    public function fotografias($id_turma, $ano_lectivo)
    {
        $ano_lectivos = AnoLectivo::where(['ano_lectivo' => $ano_lectivo])->first();
        if (!$ano_lectivos) {
            return back()->with(['error' => "Não encontrou ano lectivo"]);
        }

        $turma = Turma::find($id_turma);
        if (!$turma) {
            return back()->with(['error' => "Não encontrou turma"]);
        }

        $historico = HistoricEstudante::whereHas('estudante.pessoa', function () {
        })->where(['id_turma' => $id_turma, 'ano_lectivo' => $ano_lectivo])->orderBy('numero', 'asc')->get();

        $data = [
            'title' => "Fotografias",
            'type' => "fotografias",
            'menu' => "Minha Turma",
            'submenu' => "Fotografias",
            'getHistorico' => $historico,
            'getTurma' => $turma,
            'getAno' => $ano_lectivo,
        ];

        return view('minha_turma.fotografias', $data);
    }

    public function updateFoto(Request $request, $id_pessoa, $ano_lectivo, $id_turma)
    {
        if ($request->foto) {
            $request->validate([
                'foto' => ['required', 'mimes:jpg,png,jpeg,JPG,PNG,JPEG', 'max:5000']
            ]);
        }


        if ($request->numero) {
            $request->validate([
                'numero' => ['required', 'integer', 'min:1'],
            ]);
        }

        $pessoa = Pessoa::find($id_pessoa);
        if (!$pessoa) {
            return back()->with(['error' => "Não encontrou estudante"]);
        }
        $ano_lectivos = AnoLectivo::where(['ano_lectivo' => $ano_lectivo])->first();
        if (!$ano_lectivos) {
            return back()->with(['error' => "Não encontrou ano lectivo"]);
        }
        $turma = Turma::find($id_turma);
        if (!$turma) {
            return back()->with(['error' => "Não encontrou turma"]);
        }

        $estudante = Estudante::where(['id_pessoa' => $id_pessoa])->first();
        if (!$estudante) {
            return back()->with(['error' => "Não encontrou"]);
        }

        $nome_pasta = $turma->turma . "-" . $ano_lectivo;

        $path = null;
        if ($request->hasFile('foto') && $request->foto->isValid()) {
            $request->validate([
                'foto' => ['required', 'mimes:jpg,png,jpeg,JPG,PNG,JPEG', 'max:5000']
            ]);
            if ($pessoa->foto != "" && file_exists($pessoa->foto)) {
                unlink($pessoa->foto);
            }
            $path = $request->foto->store('fotos_estudantes/' . $nome_pasta);
        }

        $data['pessoa'] = [
            'foto' => $path
        ];

        $data['estudante_historico'] = [
            'numero' => $request->numero,
        ];

        if (Pessoa::find($id_pessoa)->update($data['pessoa'])) {
            if (Estudante::where(['id' => $estudante->id, 'ano_lectivo' => $ano_lectivo])->update($data['estudante_historico'])) {
                if (HistoricEstudante::where(['id_estudante' => $estudante->id, 'ano_lectivo' => $ano_lectivo])->update($data['estudante_historico'])) {
                    return back()->with(['success' => "Feito com sucesso"]);
                }
            }
        }
    }

    public function pautatrimestre($id_turma, $ano_lectivo)
    {
        $turma = Turma::find($id_turma);
        if (!$turma) {
            return back()->with(['error' => "Não encontrou"]);
        }

        $anos = AnoLectivo::where(['ano_lectivo' => $ano_lectivo])->first();
        if (!$anos) {
            return back()->with(['error' => "Não encontrou"]);
        }

        $grade_disciplinas = Grade::where([
            'id_curso' => $turma->id_curso,
            'id_classe' => $turma->id_classe,
        ])->get();

        Session::forget('disciplinas');

        $data = [
            'title' => "Pauta do Trimestre",
            'type' => "pautatrimestre",
            'menu' => "Minha Turma",
            'submenu' => "Pauta do Trimestre",
            'getTurma' => $turma,
            'getGrade' => $grade_disciplinas,
            'getAno'=>$ano_lectivo
        ];
        return view('minha_turma.pautatrimestral', $data);
    }
}
