<?php

namespace App\Http\Controllers;

use App\Finals;
use App\ObservacaoGeral;
use App\ObservacaoUnica;
use App\Trimestral;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class ControladorNotas extends Controller
{
    public static function getValoresMiniPautaTrimestral($id_estudante, $epoca)
    {
        $data = [
            'id_estudante' => $id_estudante,
            'epoca' => $epoca,
            'id_disciplina' => Session::get('id_disciplinaMIN'),
            'ano_lectivo' => Session::get('ano_lectivoMIN'),
        ];
        $trimestral = Trimestral::where($data)->get();
        return $trimestral;
    }

    public static function getValoresMiniPautaFinal($id_estudante)
    {
        $data = [
            'id_estudante' => $id_estudante,
            'id_disciplina' => Session::get('id_disciplinaMIN'),
            'ano_lectivo' => Session::get('ano_lectivoMIN'),
        ];
        $final = Finals::where($data)->get();
        return $final;
    }


    public static function getValoresPautaFinal($id_estudante, $id_disciplina)
    {
        $data = [
            'id_estudante' => $id_estudante,
            'id_disciplina' => $id_disciplina,
            'ano_lectivo' => Session::get('ano_lectivoP'),
        ];
        $final = Finals::where($data)->get();
        return $final;
    }

    public static function nota_20($nota)
    {
        $retorno = null;
        if ($nota >= 10 && $nota <= 20) {
            $retorno = "positivo";
        } elseif ($nota >= 0 && $nota <= 9.99) {
            $retorno = "negativo";
        } elseif ($nota == "") {
            $retorno = "nenhum";
        } else {
            $retorno = "nenhum";
        }

        return $retorno;
    }

    public static function nota_10($nota)
    {
        $retorno = null;
        if ($nota >= 5 && $nota <= 10) {
            $retorno = "positivo";
        } elseif ($nota >= 0 && $nota <= 4.99) {
            $retorno = "negativo";
        } elseif ($nota == "") {
            $retorno = "nenhum";
        } else {
            $retorno = "nenhum";
        }

        return $retorno;
    }

    public static function nota_10Qualitativa($nota)
    {
        $retorno = null;
        if ($nota >= 7 && $nota <= 10) {
            $retorno = "positivo";
        } elseif ($nota >= 5.99 && $nota <= 6.99) {
            $retorno = "neutro";
        } elseif ($nota >= 0 && $nota <= 4.99) {
            $retorno = "negativo";
        } elseif ($nota == "") {
            $retorno = "nenhum";
        } else {
            $retorno = "nenhum";
        }

        return $retorno;
    }

    public function estado_nota_qualitativa($nota)
    {
        $retorno = null;
        if ($nota >= 8 && $nota <= 10) {
            $retorno = "MUITO BOM";
        } elseif ($nota >= 7 && $nota <= 7.99) {
            $retorno = "BOM";
        } elseif ($nota >= 5 && $nota <= 6.99) {
            $retorno = "SÚFICE";
        } elseif ($nota >= 3 && $nota <= 4.99) {
            $retorno = "SÚFICE";
        } elseif ($nota >= 0 && $nota <= 2.99) {
            $retorno = "MAU";
        } elseif ($nota == "") {
            $retorno = "nenhum";
        } else {
            $retorno = "nenhum";
        }

        return $retorno;
    }

    public static function getNotasEstudantes($ano_lectivo, $epoca)
    {
        $data2 = [
            'id_disciplina' => Session::get('id_disciplinaES'),
            'id_turma' => Session::get('id_turmaES'),
        ];

        $trimestral = Trimestral::getNotasEstudantes($data2, $ano_lectivo, $epoca);

        return $trimestral;
    }

    public static function getNotasEstudantesFinal($ano_lectivo)
    {
        $data2 = [
            'id_disciplina' => Session::get('id_disciplinaES'),
            'id_turma' => Session::get('id_turmaES'),
        ];

        $finals = Finals::getNotasEstudantes($data2, $ano_lectivo);

        return $finals;
    }

    public static function observacao_geral($classe, $curso)
    {
        $observacao = ObservacaoGeral::where(['id_classe' => $classe, 'id_curso' => $curso])->first();
        return $observacao;
    }

    public static function observacao_especifica($classe, $curso, $disciplina)
    {
        $observacao = ObservacaoUnica::where(['id_classe' => $classe, 'id_curso' => $curso, 'id_disciplina' => $disciplina])->first();
        return $observacao;
    }
}