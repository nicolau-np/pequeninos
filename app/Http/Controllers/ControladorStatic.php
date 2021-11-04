<?php

namespace App\Http\Controllers;

use App\AnoLectivo;
use App\CadeiraExame;
use App\CadeiraRecurso;
use App\Classe;
use App\Desistencia;
use App\DirectorTurma;
use App\Disciplina;
use App\EpocaPagamento;
use App\Estudante;
use App\FormaPagamento;
use App\Grade;
use App\HistoricEstudante;
use App\Horario;
use App\Multado;
use App\Pagamento;
use App\PagamentoPai;
use App\TabelaPreco;
use App\TipoPagamento;
use App\Transferencia;
use App\Trimestral;
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

    public static function converterMesExtensao($mes_compreensao)
    {
        $mes_extenso = null;
        try {
            if ($mes_compreensao == 1) :
                $mes_extenso = "Janeiro";
            elseif ($mes_compreensao == 2) :
                $mes_extenso = "Fevereiro";
            elseif ($mes_compreensao == 3) :
                $mes_extenso = "Março";
            elseif ($mes_compreensao == 4) :
                $mes_extenso = "Abril";
            elseif ($mes_compreensao == 5) :
                $mes_extenso = "Maio";
            elseif ($mes_compreensao == 6) :
                $mes_extenso = "Junho";
            elseif ($mes_compreensao == 7) :
                $mes_extenso = "Julho";
            elseif ($mes_compreensao == 8) :
                $mes_extenso = "Agosto";
            elseif ($mes_compreensao == 9) :
                $mes_extenso = "Setembro";
            elseif ($mes_compreensao == 10) :
                $mes_extenso = "Outubro";
            elseif ($mes_compreensao == 11) :
                $mes_extenso = "Novembro";
            elseif ($mes_compreensao == 12) :
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
        })->where('turma', '!=', "Nenhuma")->get()->sortBy('classe.id');

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

    public static function getDisciplinasGrade($id_curso, $id_classe)
    {
        $grades = Grade::where(['id_curso' => $id_curso, 'id_classe' => $id_classe])->get();
        return $grades;
    }

    public static function getExameStatus($id_curso, $id_classe, $id_disciplina)
    {
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

    public static function getRecursoStatus($id_curso, $id_classe, $id_disciplina)
    {
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

    public static function getTurmaTurnoCurso($id_turno, $id_curso)
    {
        $turmas = Turma::where(['id_curso' => $id_curso, 'id_turno' => $id_turno])
            ->where('turma', '!=', "Nenhuma")->orderBy('id_classe', 'asc')->get();
        return $turmas;
    }

    public static function getTotalEstudantes($id_turma, $ano_lectivo)
    {
        $historico = HistoricEstudante::where(['id_turma' => $id_turma, 'ano_lectivo' => $ano_lectivo])->get();
        return $historico;
    }

    public static function getCoordenadorTurma($id_turma, $ano_lectivo)
    {
        $directores = DirectorTurma::where(['id_turma' => $id_turma, 'ano_lectivo' => $ano_lectivo])->first();
        return $directores;
    }

    public static function getDisciplinaCurso($id_curso)
    {
        $grade_curricular = Grade::where(['id_curso' => $id_curso])->distinct('id_disciplina')->get();
        return $grade_curricular;
    }

    public static function getEstatisticaMariculados($id_classe, $ano_lectivo)
    {
        $data1 = [
            'id_classe' => $id_classe,
        ];
        $historico = HistoricEstudante::whereHas('turma.classe', function ($query) use ($data1) {
            $query->where(['id_classe' => $data1['id_classe']]);
        })->where(['ano_lectivo' => $ano_lectivo])->get();

        return $historico;
    }

    public static function getEstatisticaDesistidos($id_classe, $ano_lectivo)
    {
        $data1 = [
            'id_classe' => $id_classe,
            'ano_lectivo' => $ano_lectivo,
        ];
        $historico = HistoricEstudante::whereHas('turma.classe', function ($query) use ($data1) {
            $query->where(['id_classe' => $data1['id_classe']]);
        })->where(['ano_lectivo' => $data1['ano_lectivo'], 'observacao_final' => "desistencia"])->get();

        return $historico;
    }

    public static function getDesistidosEpoca($epoca, $id_estudante, $ano_lectivo)
    {
        $desistidos = Desistencia::where(['epoca' => $epoca, 'ano_lectivo' => $ano_lectivo, 'id_estudante' => $id_estudante])->first();
        return $desistidos;
    }


    public static function getEstatisticaTransferencia($id_classe, $ano_lectivo)
    {
        $data1 = [
            'id_classe' => $id_classe,
            'ano_lectivo' => $ano_lectivo,
        ];
        $historico = HistoricEstudante::whereHas('turma.classe', function ($query) use ($data1) {
            $query->where(['id_classe' => $data1['id_classe']]);
        })->where(['ano_lectivo' => $data1['ano_lectivo'], 'observacao_final' => "transferido"])->get();

        return $historico;
    }

    public static function getTransferidosEpoca($epoca, $id_estudante, $ano_lectivo)
    {
        $transferidos = Transferencia::where(['epoca' => $epoca, 'ano_lectivo' => $ano_lectivo, 'id_estudante' => $id_estudante])->first();
        return $transferidos;
    }

    public static function getMultas($id_estudante, $id_tipo_pagamento, $mes, $ano_lectivo)
    {
        $multa = Multado::where([
            'id_estudante' => $id_estudante,
            'id_tipo_pagamento' => $id_tipo_pagamento,
            'mes' => $mes,
            'estado' => "on",
            'ano_lectivo' => $ano_lectivo,
        ])->first();
        return $multa;
    }

    public static function getMultasOFF($id_estudante, $id_tipo_pagamento, $mes, $ano_lectivo)
    {
        $multa = Multado::where([
            'id_estudante' => $id_estudante,
            'id_tipo_pagamento' => $id_tipo_pagamento,
            'mes' => $mes,
            'estado' => "off",
            'ano_lectivo' => $ano_lectivo,
        ])->first();
        return $multa;
    }

    public static function marcarMultas()
    {
        $dia = date('d'); // dia de hoje
        $mes = date('m'); // mes de hoje
        $lastYear = AnoLectivo::latest('ano_lectivo')->first();

        $ano_lectivo = $lastYear->ano_lectivo; //ultimo ano lectivo

        /**primeiro deve pegar os tipos de pagamentos que tem multa com os seus respentivos dias */
        $tipo_pagamentos = TipoPagamento::where(['multa' => "sim"])->where('dia_cobranca_multa', '<=', $dia)->get();
        foreach ($tipo_pagamentos as $tipo_pagamento) {

            /**pegar todas tabelas de precos dos pagamentos com multas */
            $tabela_precos = TabelaPreco::where(['id_tipo_pagamento' => $tipo_pagamento->id])->get();
            foreach ($tabela_precos as $tabela_preco) {

                /**pegar id de forma de pagamento */
                $forma_pagamento = FormaPagamento::where(['forma_pagamento' => $tabela_preco->forma_pagamento])->first();

                /*se a forma de pagamento for mensal*/
                if ($forma_pagamento->forma_pagamento == "Mensal") {
                    /**pegar o id do mes actual em epocas de pagamento */
                    $epocaID = EpocaPagamento::where(['numero' => $mes])->first();
                    /**pegar epocas de pagamentos */

                    $epoca_pagamentos = EpocaPagamento::where(['id_forma_pagamento' => $forma_pagamento->id])
                        ->where('id', '<', $epocaID->id)->get();


                    foreach ($epoca_pagamentos as $epocas) {

                        /**pesquisar estudantes deste ano com multas */
                        $data = [
                            'epoca' => $epocas->epoca,
                            'id_classe' => $tabela_preco->id_classe,
                            'id_curso' => $tabela_preco->id_curso,
                        ];
                        $estudantes = Estudante::whereHas('turma', function ($query) use ($data) {
                            $query->where(['id_curso' => $data['id_curso'], 'id_classe' => $data['id_classe']]);
                        })->whereDoesntHave('pagamento', function ($query) use ($data) {
                            $query->where(['epoca' => $data['epoca']]);
                        })->where(['ano_lectivo' => $ano_lectivo])->get();
                        foreach ($estudantes as $estudante) {
                            //buscar estudantes que nao pagaram para aplicar multas

                            $data = [
                                'id_estudante' => $estudante->id,
                                'id_tipo_pagamento' => $tipo_pagamento->id,
                                'mes_multa' => $epocas->numero,
                                'mes' => $epocas->epoca,
                                'percentagem' => $tabela_preco->percentagem_multa,
                                'dia_multado' => $dia,
                                'estado' => "on",
                                'ano_lectivo' => $ano_lectivo,
                            ];
                            if (!Multado::where(['id_estudante' => $estudante->id, 'id_tipo_pagamento' => $tipo_pagamento->id, 'mes_multa' => $epocas->numero, 'ano_lectivo' => $ano_lectivo])->first()) {
                                if (Multado::create($data)) {
                                    echo "multado <br/>";
                                }
                            }
                        }
                    }
                }
            }
        }
    }

    public static function getTabelaPreco($id_tipo_pagamento)
    {
        $tabela_preco = TabelaPreco::where(['id_tipo_pagamento' => $id_tipo_pagamento])->first();
        return $tabela_preco;
    }

    public static function getTotalCategoriaTurma($id_turma, $categoria, $ano_lectivo)
    {
        $historico = HistoricEstudante::where(['id_turma' => $id_turma, 'categoria' => $categoria, 'ano_lectivo' => $ano_lectivo])->get();
        return $historico;
    }

    public static function getTotalTurma($id_turma, $ano_lectivo)
    {
        $historico = HistoricEstudante::where(['id_turma' => $id_turma, 'ano_lectivo' => $ano_lectivo])->get();
        return $historico;
    }

    public static function getTotalCategoria($categoria, $ano_lectivo)
    {
        $historico = HistoricEstudante::where(['categoria' => $categoria, 'ano_lectivo' => $ano_lectivo])->get();
        return $historico;
    }

    public static function getTotal($ano_lectivo)
    {
        $historico = HistoricEstudante::where(['ano_lectivo' => $ano_lectivo])->get();
        return $historico;
    }

    public static function getTotalValoresCategoria($ano_lectivo, $id_tipo_pagamento, $categoria)
    {
        $data = [
            'categoria' => $categoria,
            'ano_lectivo' => $ano_lectivo,
            'id_tipo_pagamento' => $id_tipo_pagamento,
        ];

        $valoresPagamentos = Pagamento::whereHas('estudante', function ($query) use ($data){
            $query->whereHas('historico', function ($query2)  use($data){
                $query2->where(['ano_lectivo'=>$data['ano_lectivo']]);
                $query2->where(['categoria'=>$data['categoria']]);
            });
        })->where(['id_tipo_pagamento'=>$data['id_tipo_pagamento']])->get();

        return $valoresPagamentos;
    }

    public static function getValoresTotalCategoria($ano_lectivo, $categoria)
    {
        $data = [
            'categoria' => $categoria,
            'ano_lectivo' => $ano_lectivo,
        ];

        $valoresPagamentos = Pagamento::whereHas('estudante', function ($query) use ($data){
            $query->whereHas('historico', function ($query2)  use($data){
                $query2->where(['ano_lectivo'=>$data['ano_lectivo']]);
                $query2->where(['categoria'=>$data['categoria']]);
            });
        })->get();

        return $valoresPagamentos;
    }

    public static function getTotalValoresTipoPagamento($ano_lectivo, $id_tipo_pagamento)
    {
        $data = [
            'ano_lectivo' => $ano_lectivo,
            'id_tipo_pagamento' => $id_tipo_pagamento,
        ];

        $valoresPagamentos = Pagamento::whereHas('estudante', function ($query) use ($data){
            $query->whereHas('historico', function ($query2)  use($data){
                $query2->where(['ano_lectivo'=>$data['ano_lectivo']]);

            });
        })->where(['id_tipo_pagamento'=>$data['id_tipo_pagamento']])->get();

        return $valoresPagamentos;
    }

    public static function getBalanco($data1, $data2, $id_tipo_pagamento){
        $pagamentos = Pagamento::where('data_pagamento','>=',$data1)->where('data_pagamento','<=',$data2)->where(['id_tipo_pagamento'=>$id_tipo_pagamento])->get();
        return $pagamentos;
    }


}