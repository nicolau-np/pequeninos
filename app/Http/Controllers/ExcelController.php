<?php

namespace App\Http\Controllers;

use App\AnoLectivo;
use App\CadeiraExame;
use App\CadeiraRecurso;
use App\DirectorTurma;
use App\Disciplina;
use App\Funcionario;
use App\HistoricEstudante;
use App\Horario;
use App\OrdernaDisciplina;
use App\Turma;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class ExcelController extends Controller
{
    public function lista_nominal($turma, $ano_lectivo)
    {
        $turmas = Turma::find($turma);
        if (!$turmas) {
            return back()->with(['error' => "Nao encontrou"]);
        }
        $anos = AnoLectivo::where(['ano_lectivo' => $ano_lectivo])->first();
        if (!$anos) {
            return back()->with(['error' => "Não encontrou"]);
        }
        $historico = HistoricEstudante::whereHas('estudante.pessoa', function () {
        })->where(['id_turma' => $turma, 'ano_lectivo' => $ano_lectivo])
            ->orderBy('numero', 'asc')->get();
        $data = [
            'getHistorico' => $historico,
            'getAno' => $ano_lectivo,
            'getTurma' => $turma,
        ];
        $arquivo_saida = "Lista Nominal " . $turmas->turma . "-" . $ano_lectivo . ".xls";


        // configuracao header para forcar download
        header("Expires: Mon, 26 Jul 1997 05:00:00 GMT");
        header("Last-Modified:" . gmdate("D,d M YH:i:s") . "GMT");
        header("Cache-Control: no-cache, must-revalidate");
        header("Pragma: no-cache");
        header("Content-type: application/x-msexcel");
        header("Content-Disposition: attachment; filename=\"{$arquivo_saida}\"");
        header("Content-Description: PHP Generated Data");
        //fim
        return view('excel.lista_nominal', $data);
    }


    public function minipautas($id_turma, $id_disciplina, $ano_lectivo)
    {
        $anos = AnoLectivo::where('ano_lectivo', $ano_lectivo)->first();
        if (!$anos) {
            return back()->with(['error' => "Ano Lectivo não encontrado"]);
        }

        $turma = Turma::find($id_turma);
        if (!$turma) {
            return back()->with(['error' => "Turma não encontrada"]);
        }

        $disciplina = Disciplina::find($id_disciplina);
        if (!$disciplina) {
            return back()->with(['error' => "Não encontrou disciplina"]);
        }

        if (Session::has('id_funcionario')) {
            //verificando horario e funcionario
            $data['where_horario'] = [
                'id_funcionario' => Session::get('id_funcionario'),
                'id_turma' => $id_turma,
                'id_disciplina' => $id_disciplina,
                'ano_lectivo' => $ano_lectivo,
                'estado' => "visivel"
            ];

            $horario = Horario::where($data['where_horario'])->first();
            if (!$horario) {
                return back()->with(['error' => "Não é professor desta turma"]);
            }
        } else {
            return back()->with(['error' => "Deve iniciar sessão"]);
        }

        $historico = HistoricEstudante::where(['id_turma' => $id_turma, 'ano_lectivo' => $ano_lectivo])
            ->orderBy('numero', 'asc')->get();


        //verificar se e uma cadeira de recursos
        $cadeira_recurso = false;
        $cadeira_recurso = CadeiraRecurso::where([
            'id_curso' => $turma->id_curso,
            'id_classe' => $turma->id_classe,
            'id_disciplina' => $id_disciplina,
            'estado' => "on",
        ])->first();

        //verificar cadeiras que tem exame
        $cadeira_exame = false;
        $cadeira_exame = CadeiraExame::where([
            'id_curso' => $turma->id_curso,
            'id_classe' => $turma->id_classe,
            'id_disciplina' => $id_disciplina,
            'estado' => "on",
        ])->first();


        $data['view'] = [
            'getHorario' => $horario,
            'getHistorico' => $historico,
            'getCadeiraRecurso' => $cadeira_recurso,
            'getCadeiraExame' => $cadeira_exame,
        ];

        //buscando ensino atraves de turma
        $id_ensino = $turma->classe->id_ensino;
        $classe = $turma->classe->classe;

        $arquivo_saida = 'MINI-PAUTA ' . $ano_lectivo . '[' . strtoupper($turma->turma) . ' ' . strtoupper($turma->turno->turno) . '-' . strtoupper($turma->curso->curso) . '-' . strtoupper($horario->disciplina->disciplina) . '].xls';

        if ($id_ensino == 1) { //iniciacao ate 6
            //se for classificacao quantitativa
            if (($classe == "2ª classe") || ($classe == "4ª classe") || ($classe == "1ª classe") || ($classe == "3ª classe") || ($classe == "5ª classe")) {
                $return = "minipauta.excel.ensino_primario_2_4_copy";
            } //se for classificacao quantitativa
            elseif (($classe == "Iniciação")) {
                $return = "minipauta.excel.ensino_primario_Ini_1_3_5_copy";
            } elseif (($classe == "6ª classe")) {
                $return = "minipauta.excel.ensino_primario_6_copy";
            }
        } elseif ($id_ensino == 2) { //7 classe ate 9 ensino geral
            if ($classe == "9ª classe") {
                $return = "minipauta.excel.ensino_1ciclo_9_copy";
            } else {
                $return = "minipauta.excel.ensino_1ciclo_7_8_copy";
            }
        }

        //
        // configuracao header para forcar download
        header("Expires: Mon, 26 Jul 1997 05:00:00 GMT");
        header("Last-Modified:" . gmdate("D,d M YH:i:s") . "GMT");
        header("Cache-Control: no-cache, must-revalidate");
        header("Pragma: no-cache");
        header("Content-type: application/x-msexcel");
        header("Content-Disposition: attachment; filename=\"{$arquivo_saida}\"");
        header("Content-Description: PHP Generated Data");
        //fim
        return view("$return", $data['view']);
    }

    public function pauta($id_turma, $ano_lectivo)
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

        //verificar se selecionou a ordem das disciplinas
        $ordena_disciplina = null;
        if (!Session::has('disciplinas')) {
            $ordena_disciplina = OrdernaDisciplina::where(['id_curso' => $turma->id_curso, 'id_classe' => $turma->id_classe])->get();
        }

        $historico = HistoricEstudante::where(['id_turma' => $id_turma, 'ano_lectivo' => $ano_lectivo])
            ->orderBy('numero', 'asc')->get();

        $data['view'] = [
            'getDirector' => $directorTurma,
            'getHistorico' => $historico,
            'getOrdenaDisciplinas' => $ordena_disciplina,
        ];

        //buscando ensino atraves de turma
        $id_ensino = $turma->classe->id_ensino;
        $classe = $turma->classe->classe;


        if ($id_ensino == 1) { //iniciacao ate 6
            //se for classificacao quantitativa
            if (($classe == "2ª classe") || ($classe == "4ª classe") || ($classe == "1ª classe") || ($classe == "3ª classe") || ($classe == "5ª classe")) {
                $return = 'pauta.excel.ensino_primario_2_4_copy';
            } //se for classificacao quantitativa
            elseif (($classe == "Iniciação")) {
                $return = 'pauta.pdf.ensino_primario_Ini_1_3_5_copy';
            } elseif (($classe == "6ª classe")) {
                $return = 'pauta.pdf.ensino_primario_6_copy';
            }
        } elseif ($id_ensino == 2) { //7 classe ate 9 ensino geral
            if ($classe == "9ª classe") {
                $return = 'pauta.pdf.ensino_1ciclo_9_copy';
            } else {
                $return = 'pauta.pdf.ensino_1ciclo_7_8_copy';
            }
        }

        $arquivo_saida = 'PAUTA ' . $ano_lectivo . '[ ' . strtoupper($turma->turma) . ' ' . strtoupper($turma->turno->turno) . '-' . strtoupper($turma->curso->curso) . ' ].xls';
        //
        // configuracao header para forcar download
        header("Expires: Mon, 26 Jul 1997 05:00:00 GMT");
        header("Last-Modified:" . gmdate("D,d M YH:i:s") . "GMT");
        header("Cache-Control: no-cache, must-revalidate");
        header("Pragma: no-cache");
        header("Content-type: application/x-msexcel");
        header("Content-Disposition: attachment; filename=\"{$arquivo_saida}\"");
        header("Content-Description: PHP Generated Data");
        //fim
        return view("$return", $data['view']);
    }
}