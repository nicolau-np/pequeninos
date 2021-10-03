<?php

namespace App\Http\Controllers;

use App\AnoLectivo;
use App\CadeiraExame;
use App\CadeiraRecurso;
use App\Classe;
use App\Disciplina;
use App\Estudante;
use App\Grade;
use App\HistoricEstudante;
use App\Horario;
use App\Pagamento;
use App\PagamentoPai;
use App\Turma;

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

    public static function converterMesExtensao($mes_compreensao) {
        $mes_extenso = null;
        try {
            if ($mes_compreensao == 1):
                $mes_extenso = "Janeiro";
            elseif ($mes_compreensao == 2):
                $mes_extenso = "Fevereiro";
            elseif ($mes_compreensao == 3):
                $mes_extenso = "Março";
            elseif ($mes_compreensao == 4):
                $mes_extenso = "Abril";
            elseif ($mes_compreensao == 5):
                $mes_extenso = "Maio";
            elseif ($mes_compreensao == 6):
                $mes_extenso = "Junho";
            elseif ($mes_compreensao == 7):
                $mes_extenso = "Julho";
            elseif ($mes_compreensao == 8):
                $mes_extenso = "Agosto";
            elseif ($mes_compreensao == 9):
                $mes_extenso = "Setembro";
            elseif ($mes_compreensao == 10):
                $mes_extenso = "Outubro";
            elseif ($mes_compreensao == 11):
                $mes_extenso = "Novembro";
            elseif ($mes_compreensao == 12):
                $mes_extenso = "Dezembro";
            endif;
        } catch (\Exception $ex) {
            echo '' . $ex->getMessage();
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

    public static function getDisciplinaID($id_disciplina)
    {
        $disciplina = Disciplina::find($id_disciplina);
        return $disciplina;
    }

    /*public static function getHorario($id_hora, $id_turma, $ano_lectivo, $semana)
    {
        $data = [
            'id_turma' => $id_turma,
            'ano_lectivo' => $ano_lectivo,
            'id_hora' => $id_hora,
            'semana' => $semana,
        ];
        $horario = Horario::where($data)->get();
        return $horario;
    }*/


    public static function getTurmaEnsino($ensino)
    {
        $data = [
            'id_ensino' => $ensino
        ];
        $turmas = Turma::whereHas('curso', function ($query) use ($data) {
            $query->where($data);
        })->where('turma', '!=', "Nenhuma")->get()->sortBy('curso.classe.id');

        return $turmas;
    }

    public static function getTotalEstudantesTurma($id_turma, $ano_lectivo)
    {
        $data = [
            'id_turma' => $id_turma,
            'ano_lectivo' => $ano_lectivo,
        ];
        $estudantes = HistoricEstudante::where($data)->get();
        return $estudantes;
    }

    public static function getLastYear()
    {
        $retorno = null;
        $ano_lectivo = AnoLectivo::orderBy('id', 'desc')->limit(1)->get();
        foreach ($ano_lectivo as $ano) {
            $retorno = $ano->ano_lectivo;
        }

        return $retorno;
    }

    public static function getObservacaofinal($id_estudante, $ano_lectivo)
    {
        $observacao_final = HistoricEstudante::where(['id_estudante' => $id_estudante, 'ano_lectivo' => $ano_lectivo])->first();
        return $observacao_final;
    }

    public static function getProfDisciplina($id_turma, $id_disciplina, $ano_lectivo)
    {
        $horario = Horario::where([
            'id_disciplina' => $id_disciplina,
            'id_turma' => $id_turma,
            'ano_lectivo' => $ano_lectivo,
        ])->first();
        return $horario;
    }

    public static function getClassesCurso($id_ensino)
    {
        $classes = Classe::where(['id_ensino' => $id_ensino])->get();
        return $classes;
    }

    public static function getDisciplinasGrade($id_curso, $id_classe){
        $grades = Grade::where(['id_curso'=>$id_curso, 'id_classe'=>$id_classe])->get();
        return $grades;
    }

    public static function getExameStatus($id_curso, $id_classe, $id_disciplina){
        //verificar cadeiras que tem exame
        $cadeira_exame = false;
        $cadeira_exame = CadeiraExame::where([
            'id_curso' => $id_curso,
            'id_classe' => $id_classe,
            'id_disciplina' => $id_disciplina,
            'estado' => "on",
        ])->first();

        return $cadeira_exame;
    }

    public static function getRecursoStatus($id_curso, $id_classe, $id_disciplina){
        //verificar se e uma cadeira de recursos
        $cadeira_recurso = false;
        $cadeira_recurso = CadeiraRecurso::where([
            'id_curso' => $id_curso,
            'id_classe' => $id_classe,
            'id_disciplina' => $id_disciplina,
            'estado' => "on",
        ])->first();

        return $cadeira_recurso;
    }
}