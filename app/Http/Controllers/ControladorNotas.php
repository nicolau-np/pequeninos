<?php

namespace App\Http\Controllers;

use App\Finals;
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

    public static function nota_20($nota)
    {
        $retorno = null;
        if ($nota >= 9.5 && $nota <= 20) {
            $retorno = "positivo";
        } elseif ($nota >= 0 && $nota <= 9.4) {
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
        if ($nota <= 4.5 && $nota >= 10) {
            $retorno = "positivo";
        }elseif ($nota >= 0 && $nota <= 4.4) {
            $retorno = "negativo";
        } elseif ($nota == "") {
            $retorno = "nenhum";
        } else {
            $retorno = "nenhum";
        }

        return $retorno;
    }

    public static function getNotasEstudantes($ano_lectivo, $epoca){
        $data2 = [
            'id_disciplina'=>Session::get('id_disciplinaES'),
            'id_turma'=>Session::get('id_turmaES'),
        ];

        $trimestral = Trimestral::getNotasEstudantes($data2, $ano_lectivo, $epoca);

        return $trimestral;
    }
}
