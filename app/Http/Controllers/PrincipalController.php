<?php

namespace App\Http\Controllers;

use App\BloqueioEpoca;
use App\Estudante;
use App\Grade;
use App\HistoricEstudante;
use App\Pagamento;
use App\Trimestral;
use App\Turma;
use Illuminate\Http\Request;

class PrincipalController extends Controller
{
    public function index()
    {
        $data = [
            'title' => "SIGE - Sistema de Gestão Escolar",
            'type' => "principal",
            'menu' => "Principal",
            'submenu' => "",
        ];
        return view('principal.home', $data);
    }

    public function consultar()
    {
        $bloqueio_epocas = BloqueioEpoca::where(['epoca' => 7])->first();

        $data = [
            'title' => "SIGE - Sistema de Gestão Escolar",
            'type' => "consulta",
            'menu' => "Consultar",
            'submenu' => "",
            'getBloqueioEpoca' => $bloqueio_epocas,
        ];
        return view('principal.consulta', $data);
    }

    public function dados(Request $request)
    {
        $bloqueio_epocas = BloqueioEpoca::where(['epoca' => 7])->first();
        if ($bloqueio_epocas->estado == "off") {
            return redirect('/consultar');
        }
        $request->validate([
            'codigo_acesso' => ['required', 'string', 'min:6'],
        ]);

        $estudante = Estudante::where(['numero_acesso' => $request->codigo_acesso])->first();
        if (!$estudante) {
            return back()->with(['error' => "Código de Acesso Incorrecto"]);
        }

        $turma = Turma::find($estudante->id_turma);
        if (!$turma) {
            return back()->with(['error' => "Não encontrou turma do estudante"]);
        }

        $grades = Grade::where(['id_curso' => $turma->id_curso, 'id_classe' => $turma->id_classe])->get();
        $pagamentos = Pagamento::where([
            'id_estudante' => $estudante->id,
            'ano_lectivo' => $estudante->ano_lectivo,
        ])->get();
        $classe = $turma->classe->classe;
        $id_ensino = $turma->curso->id_ensino;

        $data = [
            'title' => "SIGE - Sistema de Gestão Escolar",
            'type' => "consulta",
            'menu' => "Consultar",
            'submenu' => "Dados",
            'getEstudante' => $estudante,
            'getGrades' => $grades,
            'getPagamentos' => $pagamentos,
        ];
        if ($id_ensino == 1) {
            if (($classe == "Iniciação")) {
                return view('principal.ensinos.ensino_primario_ini_copy', $data);
            } elseif (($classe == "2ª classe") || ($classe == "4ª classe") || ($classe == "1ª classe") || ($classe == "3ª classe") || ($classe == "5ª classe") || ($classe == "Módulo 1") || ($classe == "Módulo 2")) {
                return view('principal.ensinos.ensino_primario_2_4_copy', $data);
            } elseif (($classe == "6ª classe") || ($classe == "Módulo 3")) {
                return view('principal.ensinos.ensino_primario_6_copy', $data);
            }
        } elseif ($id_ensino == 2) {
            if (($classe == "7ª classe") || ($classe == "8ª classe")) {
                return view('principal.ensinos.ensino_1ciclo_7_8_copy', $data);
            } elseif (($classe == "9ª classe")) {
                return view('principal.ensinos.ensino_1ciclo_9_copy', $data);
            }
        }
    }
}