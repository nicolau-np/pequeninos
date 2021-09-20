<?php

namespace App\Http\Controllers;

use App\Disciplina;
use App\Estudante;
use App\Horario;
use App\NotaFinal;
use App\NotaTrimestral;
use App\ObservacaoGeral;
use App\ObservacaoUnica;
use App\Pagamento;
use App\PagamentoPai;
use App\TipoPagamento;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class ControladorStatic extends Controller
{
    public static function getPagamentosComparticipacao($id_encarregado, $epoca, $ano_lectivo)
    {
        $data = [
            'id_encarregado' => $id_encarregado,
            'epoca' => $epoca,
            'ano_lectivo' => $ano_lectivo
        ];
        $comparticipacao = PagamentoPai::where($data)->first();
        return $comparticipacao;
    }

    public static function getPagamentos($id_estudante, $epoca, $ano_lectivo)
    {
        $data = [
            'id_estudante' => $id_estudante,
            'epoca' => $epoca,
            'ano_lectivo' => $ano_lectivo
        ];
        $comparticipacao = Pagamento::where($data)->first();
        return $comparticipacao;
    }

    public static function converterMes($mes)
    {
        $mes_extenso = null;
        if ($mes == 1) {
            $mes_extenso = "Jan";
        } elseif ($mes == 2) {
            $mes_extenso = "Fev";
        } elseif ($mes == 3) {
            $mes_extenso = "Mar";
        } elseif ($mes == 4) {
            $mes_extenso = "Abr";
        } elseif ($mes == 5) {
            $mes_extenso = "Mai";
        } elseif ($mes == 6) {
            $mes_extenso = "Jun";
        } elseif ($mes == 7) {
            $mes_extenso = "Jul";
        } elseif ($mes == 8) {
            $mes_extenso = "Ago";
        } elseif ($mes == 9) {
            $mes_extenso = "Set";
        } elseif ($mes == 10) {
            $mes_extenso = "Out";
        } elseif ($mes == 11) {
            $mes_extenso = "Nov";
        } elseif ($mes == 12) {
            $mes_extenso = "Dez";
        }

        return $mes_extenso;
    }

    public static function getValoresBalancoTrimestral($epoca, $id_tipo_pagamento, $ano_lectivo)
    {
        $retorno = 0;
        $data = [
            'epoca' => $epoca,
            'id_tipo_pagamento' => $id_tipo_pagamento,
            'ano_lectivo' => $ano_lectivo,
        ];

        if ($id_tipo_pagamento == 3) {
            $pagamentos = PagamentoPai::where($data)->get();
            foreach ($pagamentos as $pagamento) {
                $retorno = $retorno + $pagamento->preco;
            }
        } else {
            $pagamentos = Pagamento::where($data)->get();
            foreach ($pagamentos as $pagamento) {
                $retorno = $retorno + $pagamento->preco;
            }
        }

        return $retorno;
    }

    public static function getValoresBalancoMensal($mes, $id_tipo_pagamento, $ano_lectivo)
    {
        $retorno = 0;
        $data = [
            'mes_pagamento' => $mes,
            'id_tipo_pagamento' => $id_tipo_pagamento,
            'ano_lectivo' => $ano_lectivo,
        ];

        if ($id_tipo_pagamento == 3) {
            $pagamentos = PagamentoPai::where($data)->get();
            foreach ($pagamentos as $pagamento) {
                $retorno = $retorno + $pagamento->preco;
            }
        } else {
            $pagamentos = Pagamento::where($data)->get();
            foreach ($pagamentos as $pagamento) {
                $retorno = $retorno + $pagamento->preco;
            }
        }

        return $retorno;
    }

    public static function getValoresBalancoAnual($id_tipo_pagamento, $ano_lectivo)
    {
        $retorno = 0;
        $data = [
            'id_tipo_pagamento' => $id_tipo_pagamento,
            'ano_lectivo' => $ano_lectivo,
        ];

        if ($id_tipo_pagamento == 3) {
            $pagamentos = PagamentoPai::where($data)->get();
            foreach ($pagamentos as $pagamento) {
                $retorno = $retorno + $pagamento->preco;
            }
        } else {
            $pagamentos = Pagamento::where($data)->get();
            foreach ($pagamentos as $pagamento) {
                $retorno = $retorno + $pagamento->preco;
            }
        }

        return $retorno;
    }

    public static function getEducandos($id_encarregado)
    {
        $estudante = Estudante::WhereHas('pessoa', function ($query) {
            $query->orderBy('nome', 'asc');
        })->where('id_encarregado', $id_encarregado)->get();

        return $estudante;
    }

    public static function getValoresComparticipacao($epoca, $id_encarregado, $ano_lectivo)
    {

        $data = [
            'epoca' => $epoca,
            'id_encarregado' => $id_encarregado,
            'ano_lectivo' => $ano_lectivo,
        ];

        $pagamentos = PagamentoPai::where($data)->first();


        return $pagamentos;
    }

    /*public static function getValoresMiniPautaTrimestral($id_estudante, $epoca)
    {
        $data = [
            'id_estudante' => $id_estudante,
            'epoca' => $epoca,
            'id_disciplina' => Session::get('id_disciplinaMIN'),
            'ano_lectivo' => Session::get('ano_lectivoMIN'),
        ];
        $trimestral = NotaTrimestral::where($data)->get();
        return $trimestral;
    }*/

    /*public static function getValoresMiniPautaFinal($id_estudante)
    {
        $data = [
            'id_estudante' => $id_estudante,
            'id_disciplina' => Session::get('id_disciplinaMIN'),
            'ano_lectivo' => Session::get('ano_lectivoMIN'),
        ];
        $final = NotaFinal::where($data)->get();
        return $final;
    }*/

    

    public static function getDisciplinaID($id_disciplina){
        $disciplina = Disciplina::find($id_disciplina);
        return $disciplina;
    }

    public static function getValoresMiniPautaFinal2($id_estudante, $id_disciplina){
        $data = [
            'id_estudante' => $id_estudante,
            'id_disciplina' => $id_disciplina,
            'ano_lectivo' => Session::get('ano_lectivoP'),
        ];
        $final = NotaFinal::where($data)->get();
        return $final;
    }

    public static function getHorario($id_hora, $id_turma, $ano_lectivo, $semana){
        $data = [
            'id_turma' => $id_turma,
            'ano_lectivo'=>$ano_lectivo,
            'id_hora'=>$id_hora,
            'semana'=>$semana,
        ];
        $horario = Horario::where($data)->get();
        return $horario;
    }

    public static function observacao_geral($classe, $curso){
        $observacao = ObservacaoGeral::where(['id_classe'=>$classe, 'id_curso'=>$curso])->first();
        return $observacao;
    }

    public static function observacao_especifica($classe, $curso, $disciplina){
        $observacao = ObservacaoUnica::where(['id_classe'=>$classe, 'id_curso'=>$curso, 'id_disciplina'=>$disciplina])->first();
        return $observacao;
    }
}
