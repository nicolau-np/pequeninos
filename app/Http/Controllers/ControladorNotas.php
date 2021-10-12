<?php

namespace App\Http\Controllers;

use App\EjaNotaMensal;
use App\Finals;
use App\ObservacaoGeral;
use App\ObservacaoUnica;
use App\Trimestral;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class ControladorNotas extends Controller
{

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

    public static function notaRec_10($nota)
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

    public static function notaRec_5($nota)
    {
        $retorno = null;
        if ($nota >= 3 && $nota <= 5) {
            $retorno = "positivo";
        } elseif ($nota >= 0 && $nota <= 2.99) {
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
        } elseif ($nota >= 5 && $nota <= 6.99) {
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

    public static function estado_nota_qualitativa($nota)
    {
        $retorno = null;
        if ($nota >= 8 && $nota <= 10) {
            $retorno = "M BOM";
        } elseif ($nota >= 7 && $nota <= 7.99) {
            $retorno = "BOM";
        } elseif ($nota >= 5 && $nota <= 6.99) {
            $retorno = "SUF";
        } elseif ($nota >= 3 && $nota <= 4.99) {
            $retorno = "MED";
        } elseif ($nota >= 0 && $nota <= 2.99) {
            $retorno = "MAU";
        } elseif ($nota == "") {
            $retorno = "nenhum";
        } else {
            $retorno = "nenhum";
        }

        return $retorno;
    }

    public static function estado_nota_qualitativaRec($nota)
    {
        $retorno = null;
        if ($nota >= 3 && $nota <= 5) {
            $retorno = "M BOM";
        } elseif ($nota >= 0 && $nota <= 2.99) {
            $retorno = "MAU";
        } elseif ($nota == "") {
            $retorno = "nenhum";
        } else {
            $retorno = "nenhum";
        }

        return $retorno;
    }


    public static function converter_nota($nota_compreensao)
    {
        $nota_extensao = null;
        try {
            if ($nota_compreensao == 0) :
                $nota_extensao = "Zero";
            elseif ($nota_compreensao == 1) :
                $nota_extensao = "Um valor";
            elseif ($nota_compreensao == 2) :
                $nota_extensao = "Dois valores";
            elseif ($nota_compreensao == 3) :
                $nota_extensao = "Três valores";
            elseif ($nota_compreensao == 4) :
                $nota_extensao = "Quatro valores";
            elseif ($nota_compreensao == 5) :
                $nota_extensao = "Cinco valores";
            elseif ($nota_compreensao == 6) :
                $nota_extensao = "Seis valores";
            elseif ($nota_compreensao == 7) :
                $nota_extensao = "Sete valores";
            elseif ($nota_compreensao == 8) :
                $nota_extensao = "Oito valores";
            elseif ($nota_compreensao == 9) :
                $nota_extensao = "Nove valores";
            elseif ($nota_compreensao == 10) :
                $nota_extensao = "Dez valores";
            elseif ($nota_compreensao == 11) :
                $nota_extensao = "Onze valores";
            elseif ($nota_compreensao == 12) :
                $nota_extensao = "Doze valores";
            elseif ($nota_compreensao == 13) :
                $nota_extensao = "Treze valores";
            elseif ($nota_compreensao == 14) :
                $nota_extensao = "Catorze valores";
            elseif ($nota_compreensao == 15) :
                $nota_extensao = "Quinze valores";
            elseif ($nota_compreensao == 16) :
                $nota_extensao = "Dezasseis valores";
            elseif ($nota_compreensao == 17) :
                $nota_extensao = "Dezassete valores";
            elseif ($nota_compreensao == 18) :
                $nota_extensao = "Dezoito valores";
            elseif ($nota_compreensao == 19) :
                $nota_extensao = "Dezanove valores";
            elseif ($nota_compreensao == 20) :
                $nota_extensao = "Vinte valores";
            endif;
        } catch (\Exception $ex) {
            echo 'CONVERSAO::converter => ' . $ex->getMessage();
        }
        return $nota_extensao;
    }

    public static function observacao_geral($classe, $curso)
    {
        $observacao = ObservacaoGeral::where(['id_classe' => $classe, 'id_curso' => $curso])->first();
        return $observacao;
    }

  


    /*carregar para os PDFs, pautas minipautas e estatisticas */

    public static function getValoresPautaFinalPDF($id_estudante, $id_disciplina, $ano_lectivo)
    {
        $data = [
            'id_estudante' => $id_estudante,
            'id_disciplina' => $id_disciplina,
            'ano_lectivo' => $ano_lectivo,
        ];
        $final = Finals::where($data)->get();
        return $final;
    }

    public static function getNotasEstudantesFinalPDF($id_turma, $id_disciplina, $ano_lectivo)
    {
        $data2 = [
            'id_disciplina' => $id_disciplina,
            'id_turma' => $id_turma,
        ];

        $finals = Finals::getNotasEstudantes($data2, $ano_lectivo);

        return $finals;
    }

    public static function getNotasEstudantesPDF($id_turma, $id_disciplina, $ano_lectivo, $epoca)
    {
        $data2 = [
            'id_disciplina' => $id_disciplina,
            'id_turma' => $id_turma,
        ];

        $trimestral = Trimestral::getNotasEstudantes($data2, $ano_lectivo, $epoca);

        return $trimestral;
    }

    public static function getValoresMiniPautaTrimestralPDF($id_disciplina, $id_estudante, $epoca, $ano_lectivo)
    {
        $data = [
            'id_estudante' => $id_estudante,
            'epoca' => $epoca,
            'id_disciplina' => $id_disciplina,
            'ano_lectivo' => $ano_lectivo,
        ];
        $trimestral = Trimestral::where($data)->get();
        return $trimestral;
    }

    public static function getValoresMiniPautaFinalPDF($ano_lectivo, $id_disciplina, $id_estudante)
    {
        $data = [
            'id_estudante' => $id_estudante,
            'id_disciplina' => $id_disciplina,
            'ano_lectivo' => $ano_lectivo,
        ];
        $final = Finals::where($data)->get();
        return $final;
    }

    /*fim carregar para PDF*/

    public static function getNotasEstudantesAproveitamentoDisciplina($id_curso, $id_classe, $epoca, $id_disciplina, $ano_lectivo)
    {
        $data1 = [
            'epoca' => $epoca,
            'id_disciplina' => $id_disciplina,
            'ano_lectivo' => $ano_lectivo,
            'id_curso' => $id_curso,
            'id_classe' => $id_classe,
        ];


        $trimestal = Trimestral::whereHas('estudante.turma', function ($query) use ($data1) {
            $query->where([
                'id_curso' => $data1['id_curso'],
                'id_classe' => $data1['id_classe'],
            ]);
        })->where(['epoca' => $data1['epoca'], 'ano_lectivo' => $data1['ano_lectivo'], 'id_disciplina' => $data1['id_disciplina']])
            ->where('mt', '!=', null)
            ->get();

        return $trimestal;
    }

    public static function getNotasEstudantesAproveitamentoClasse($id_curso, $id_classe, $epoca, $ano_lectivo){
        $data1 = [
            'epoca' => $epoca,
            'ano_lectivo' => $ano_lectivo,
            'id_curso' => $id_curso,
            'id_classe' => $id_classe,
        ];


        $trimestal = Trimestral::whereHas('estudante.turma', function ($query) use ($data1) {
            $query->where([
                'id_curso' => $data1['id_curso'],
                'id_classe' => $data1['id_classe'],
            ]);
        })->where(['epoca' => $data1['epoca'], 'ano_lectivo' => $data1['ano_lectivo']])
            ->where('mt', '!=', null)
            ->get();

        return $trimestal;
    }

    public static function getNotaMes($id_estudante, $ano_lectivo, $id_disciplina, $epoca, $mes){
        $data=[
            'id_estudante' =>$id_estudante,
            'id_disciplina'=> $id_disciplina,
            'ano_lectivo' => $ano_lectivo,
            'epoca'=> $epoca,
            'mes' =>$mes,
        ];
        $nota_mes = EjaNotaMensal::where($data)->first();
        return $nota_mes;
    }
}
