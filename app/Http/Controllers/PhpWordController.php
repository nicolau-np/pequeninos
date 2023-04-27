<?php

namespace App\Http\Controllers;

use App\Declaracao;
use App\Encarregado;
use App\HistoricEstudante;
use Illuminate\Http\Request;
use App\Http\Controllers\ControladorStatic;
use App\Http\Controllers\ControladorNotas;
use App\OrdernaDisciplina;
use App\Turma;
use Illuminate\Support\Facades\Session;
use PhpOffice\PhpWord\Element\TextRun;

class PhpWordController extends Controller
{


    public function declaracaosemnota($id_declaracao)
    {
        $declaracao = Declaracao::find($id_declaracao);
        if (!$declaracao) {
            return back()->with(['error' => "Não encontrou declaração"]);
        }

        $historico = HistoricEstudante::where(['id_estudante' => $declaracao->id_estudante, 'ano_lectivo' => $declaracao->ano_lectivo])->first();
        if (!$historico) {
            return back()->with(['error' => "Não encontrou estudante"]);
        }

        $templateProcessor = new \PhpOffice\PhpWord\TemplateProcessor('word_models/declaracaosemnota.docx');

        /**variaveis */
        $nome = "[##############]";
        $pai = "[##############]";
        $mae = "[##############]";
        $dia = "[##############]";
        $mes = "[##############]";
        $ano = "[##############]";
        $naturalidade = "[##############]";
        $provincia = "[##############]";
        $ano_lectivo = "[##############]";
        $classe = "[##############]";
        $turma = "[##############]";
        $numero = "[##############]";
        $dia_hoje = "[##############]";
        $mes_hoje = "[##############]";
        $ano_hoje = "[##############]";
        $bilhete = "[##############]";
        /**fim variaveis */


        /**atribuindo valores nas variaveis */
        $mes1 = date('m', strtotime($historico->estudante->pessoa->data_nascimento));
        $mes = ControladorStatic::converterMesExtensao($mes1);
        $dia = date('d', strtotime($historico->estudante->pessoa->data_nascimento));
        $ano = date('Y', strtotime($historico->estudante->pessoa->data_nascimento));

        $nome = $historico->estudante->pessoa->nome;
        if ($historico->estudante->pessoa->pai) {
            $pai = $historico->estudante->pessoa->pai;
        }
        if ($historico->estudante->pessoa->mae) {
            $mae = $historico->estudante->pessoa->mae;
        }
        if ($historico->estudante->pessoa->bilhete) {
            $bilhete = $historico->estudante->pessoa->bilhete;
        }
        if ($historico->estudante->pessoa->naturalidade) {
            $naturalidade = $historico->estudante->pessoa->naturalidade;
        }
        if ($historico->estudante->pessoa->municipio->provincia->provincia) {
            $provincia = $historico->estudante->pessoa->municipio->provincia->provincia;
        }
        $numero = $historico->numero;
        $turma = $historico->turma->turma;
        $classe = $historico->turma->classe->classe;
        $ano_lectivo = $historico->ano_lectivo;


        $dia_hoje = date('d', strtotime($declaracao->data_emissao));
        $mes2 = date('m', strtotime($declaracao->data_emissao));
        $mes_hoje = ControladorStatic::converterMesExtensao($mes2);
        $ano_hoje = date('Y', strtotime($declaracao->data_emissao));
        /**fim */


       /* $word1 = new TextRun();
        $word2 = new TextRun();*/

        // Variables on different parts of document
        $templateProcessor->setValue('nome', $nome);
        /*$word1->addText($nome, array('name'=>"Arial Narrow",'size'=>13,"color" => "4680ff"));
        $templateProcessor->setComplexValue('nome', $word1);
        $word2->addText($pai, array('name'=>"Arial Narrow",'size'=>13,"color" => "FC6180"));        // On section/content
        $templateProcessor->setComplexValue('pai', $word2);*/
        $templateProcessor->setValue('pai', $pai);
        $templateProcessor->setValue('mae', $mae);
        $templateProcessor->setValue('dia', $dia);            // On section/content
        $templateProcessor->setValue('mes', $mes);
        $templateProcessor->setValue('ano', $ano);
        $templateProcessor->setValue('naturalidade', $naturalidade);            // On section/content
        $templateProcessor->setValue('provincia', $provincia);
        $templateProcessor->setValue('ano_lectivo', $ano_lectivo);
        $templateProcessor->setValue('classe', $classe);            // On section/content
        $templateProcessor->setValue('turma', $turma);
        $templateProcessor->setValue('numero', $numero);
        $templateProcessor->setValue('dia_hoje', $dia_hoje);            // On section/content
        $templateProcessor->setValue('mes_hoje', $mes_hoje);
        $templateProcessor->setValue('ano_hoje', $ano_hoje);
        $templateProcessor->setValue('bilhete', $bilhete);           // On footer
        // On header
        $filename = $historico->estudante->pessoa->nome . "declaracaosemnota.docx";
        try {
            $templateProcessor->saveAs('word_models/' . $filename . '.docx');
        } catch (\Exception $e) {
            echo $e->getMessage();
        }
        return response()->download('word_models/' . $filename . '.docx')->deleteFileAfterSend(true);
    }

    public function declaracaocomnota($id_declaracao)
    {
        $declaracao = Declaracao::find($id_declaracao);
        if (!$declaracao) {
            return back()->with(['error' => "Não encontrou declaração"]);
        }

        $historico = HistoricEstudante::where(['id_estudante' => $declaracao->id_estudante, 'ano_lectivo' => $declaracao->ano_lectivo])->first();
        if (!$historico) {
            return back()->with(['error' => "Não encontrou estudante"]);
        }
        $turma = Turma::find($historico->id_turma);
        $classe = $turma->classe->classe;
        $id_ensino = $turma->curso->id_ensino;

        if ($id_ensino == 1) {
            if (($classe == "Iniciação")) {
                $templateProcessor = new \PhpOffice\PhpWord\TemplateProcessor('word_models/declaracao_notas/ensino_primario_ini_1_3_5_copy.docx');
            } elseif (($classe == "2ª classe") || ($classe == "4ª classe") || ($classe == "1ª classe") || ($classe == "3ª classe") || ($classe == "5ª classe")  || ($classe == "Módulo 1") || ($classe == "Módulo 2")) {
                $templateProcessor = new \PhpOffice\PhpWord\TemplateProcessor('word_models/declaracao_notas/ensino_primario_2_4_copy.docx');
            } elseif (($classe == "6ª classe") || ($classe == "Módulo 3")) {
                $templateProcessor = new \PhpOffice\PhpWord\TemplateProcessor('word_models/declaracao_notas/ensino_primario_6_copy.docx');
            }
        } elseif ($id_ensino == 2) {
            if ($classe == "9ª classe") {
                $templateProcessor = new \PhpOffice\PhpWord\TemplateProcessor('word_models/declaracao_notas/ensino_1ciclo_9_copy.docx');
            } elseif (($classe == "7ª classe") || ($classe == "8ª classe")) {
                $templateProcessor = new \PhpOffice\PhpWord\TemplateProcessor('word_models/declaracao_notas/ensino_1ciclo_7_8_copy.docx');
            }
        }

        /**variaveis */
        $nome = "[##############]";
        $pai = "[##############]";
        $mae = "[##############]";
        $dia = "[##############]";
        $mes = "[##############]";
        $ano = "[##############]";
        $naturalidade = "[##############]";
        $provincia = "[##############]";
        $ano_lectivo = "[##############]";
        $classe = "[##############]";
        $turmaF = "[##############]";
        $numero = "[##############]";
        $dia_hoje = "[##############]";
        $mes_hoje = "[##############]";
        $ano_hoje = "[##############]";
        $bilhete = "[##############]";
        /**fim variaveis */


        /**atribuindo valores nas variaveis */
        $mes1 = date('m', strtotime($historico->estudante->pessoa->data_nascimento));
        $mes = ControladorStatic::converterMesExtensao($mes1);
        $dia = date('d', strtotime($historico->estudante->pessoa->data_nascimento));
        $ano = date('Y', strtotime($historico->estudante->pessoa->data_nascimento));

        $nome = $historico->estudante->pessoa->nome;
        if ($historico->estudante->pessoa->pai) {
            $pai = $historico->estudante->pessoa->pai;
        }
        if ($historico->estudante->pessoa->mae) {
            $mae = $historico->estudante->pessoa->mae;
        }
        if ($historico->estudante->pessoa->bilhete) {
            $bilhete = $historico->estudante->pessoa->bilhete;
        }
        if ($historico->estudante->pessoa->naturalidade) {
            $naturalidade = $historico->estudante->pessoa->naturalidade;
        }
        if ($historico->estudante->pessoa->municipio->provincia->provincia) {
            $provincia = $historico->estudante->pessoa->municipio->provincia->provincia;
        }
        $numero = $historico->numero;
        $turmaF = $historico->turma->turma;
        $classe = $historico->turma->classe->classe;
        $ano_lectivo = $historico->ano_lectivo;


        $dia_hoje = date('d', strtotime($declaracao->data_emissao));
        $mes2 = date('m', strtotime($declaracao->data_emissao));
        $mes_hoje = ControladorStatic::converterMesExtensao($mes2);
        $ano_hoje = date('Y', strtotime($declaracao->data_emissao));
        /**fim */




        /*$word1->addText($nome, array('name'=>"Arial Narrow",'size'=>13,"color" => "4680ff"));
        $templateProcessor->setComplexValue('nome', $word1);
        $word2->addText($pai, array('name'=>"Arial Narrow",'size'=>13,"color" => "FC6180"));        // On section/content
        $templateProcessor->setComplexValue('pai', $word2);*/

        // Variables on different parts of document
        $templateProcessor->setValue('nome', $nome);            // On section/content
        $templateProcessor->setValue('pai', $pai);
        $templateProcessor->setValue('mae', $mae);
        $templateProcessor->setValue('dia', $dia);            // On section/content
        $templateProcessor->setValue('mes', $mes);
        $templateProcessor->setValue('ano', $ano);
        $templateProcessor->setValue('naturalidade', $naturalidade);            // On section/content
        $templateProcessor->setValue('provincia', $provincia);
        $templateProcessor->setValue('ano_lectivo', $ano_lectivo);
        $templateProcessor->setValue('classe', $classe);            // On section/content
        $templateProcessor->setValue('turma', $turmaF);
        $templateProcessor->setValue('numero', $numero);
        $templateProcessor->setValue('dia_hoje', $dia_hoje);            // On section/content
        $templateProcessor->setValue('mes_hoje', $mes_hoje);
        $templateProcessor->setValue('ano_hoje', $ano_hoje);
        $templateProcessor->setValue('bilhete', $bilhete);           // On footer
        // On header


        /**trabalhando nas notas */

        $values = [];
        $nota_valor = "[######]";
        $nota_extensao = "[####]";
        //verificar se selecionou a ordem das disciplinas
        $ordena_disciplina = null;
        if (!Session::has('disciplinas')) {
            $ordena_disciplina = OrdernaDisciplina::where(['id_curso' => $turma->id_curso, 'id_classe' => $turma->id_classe])->get();
        }

        if (!$ordena_disciplina) {
            if (($id_ensino == 1) && (($classe == "Iniciação"))) { //para notas qualitativa
                foreach (Session::get('disciplinas') as $disciplina) {
                    $getDisciplina = ControladorStatic::getDisciplinaID($disciplina['id_disciplina']);
                    $final = ControladorNotas::getValoresPautaFinalPDF($historico->id_estudante, $disciplina['id_disciplina'], $historico->ano_lectivo);
                    if ($final) {
                        foreach ($final as $valorf) {
                            if ($valorf->rec == null) {
                                $nota_valor = ControladorNotas::estado_nota_qualitativa($valorf->mf);
                            } else {
                                $nota_valor = ControladorNotas::estado_nota_qualitativaRec($valorf->rec);
                            }
                        }
                    }

                    array_push($values, ['disciplinas' => $getDisciplina->disciplina, 'valores' => $nota_valor, 'extensao' => $nota_extensao]);

                    $nota_valor = "[######]";
                    $nota_extensao = "[####]";
                }
            } else { //para notas quantitativa
                foreach (Session::get('disciplinas') as $disciplina) {
                    $getDisciplina = ControladorStatic::getDisciplinaID($disciplina['id_disciplina']);
                    $final = ControladorNotas::getValoresPautaFinalPDF($historico->id_estudante, $disciplina['id_disciplina'], $historico->ano_lectivo);
                    if ($final) {
                        foreach ($final as $valorf) {
                            if ($valorf->rec == null) {
                                $nota_valor = str_pad($valorf->mf, 2, 0, STR_PAD_LEFT);
                                $nota_extensao = ControladorNotas::converter_nota($valorf->mf);
                            } else {
                                $nota_valor = str_pad($valorf->rec, 2, 0, STR_PAD_LEFT);
                                $nota_extensao = ControladorNotas::converter_nota($valorf->rec);
                            }
                        }
                    }

                    array_push($values, ['disciplinas' => $getDisciplina->disciplina, 'valores' => $nota_valor, 'extensao' => $nota_extensao]);

                    $nota_valor = "[######]";
                    $nota_extensao = "[####]";
                }
            }
        } else {
            if (($id_ensino == 1) && (($classe == "Iniciação"))) { //para notas qualitativa
                foreach ($ordena_disciplina as $disciplina) {
                    $getDisciplina = ControladorStatic::getDisciplinaID($disciplina->id_disciplina);
                    $final = ControladorNotas::getValoresPautaFinalPDF($historico->id_estudante, $disciplina->id_disciplina, $historico->ano_lectivo);
                    if ($final) {
                        foreach ($final as $valorf) {
                            if ($valorf->rec == null) {
                                $nota_valor = ControladorNotas::estado_nota_qualitativa($valorf->mf);
                            } else {
                                $nota_valor = ControladorNotas::estado_nota_qualitativaRec($valorf->rec);
                            }
                        }
                    }

                    array_push($values, ['disciplinas' => $getDisciplina->disciplina, 'valores' => $nota_valor, 'extensao' => $nota_extensao]);

                    $nota_valor = "[######]";
                    $nota_extensao = "[####]";
                }
            } else { //para notas quantitativa
                foreach ($ordena_disciplina as $disciplina) {
                    $getDisciplina = ControladorStatic::getDisciplinaID($disciplina->id_disciplina);
                    $final = ControladorNotas::getValoresPautaFinalPDF($historico->id_estudante, $disciplina->id_disciplina, $historico->ano_lectivo);
                    if ($final) {
                        foreach ($final as $valorf) {
                            if ($valorf->rec == null) {
                                $nota_valor = str_pad($valorf->mf, 2, 0, STR_PAD_LEFT);
                                $nota_extensao = ControladorNotas::converter_nota($valorf->mf);

                            } else {
                                $nota_valor = str_pad($valorf->rec, 2, 0, STR_PAD_LEFT);
                                $nota_extensao = ControladorNotas::converter_nota($valorf->rec);
                            }
                        }
                    }


                    array_push($values, ['disciplinas' => $getDisciplina->disciplina, 'valores' => $nota_valor, 'extensao' => $nota_extensao]);

                    $nota_valor = "[######]";
                    $nota_extensao = "[####]";
                }
            }
        }



        $templateProcessor->cloneRowAndSetValues('disciplinas', $values);
        /**fim */


        $filename = $historico->estudante->pessoa->nome . "declaracaocomnota.docx";
        try {
            $templateProcessor->saveAs('word_models/declaracao_notas/' . $filename . '.docx');
        } catch (\Exception $e) {
            echo $e->getMessage();
        }
        return response()->download('word_models/declaracao_notas/' . $filename . '.docx')->deleteFileAfterSend(true);
    }

    public function termo(Request $request, $id_estudante, $ano_lectivo)
    {
        $historico = HistoricEstudante::where(['id_estudante' => $id_estudante, 'ano_lectivo' => $ano_lectivo])->first();
        if (!$historico) {
            return back()->with(['error' => "Não encontrou estudante"]);
        }
        $turma = Turma::find($historico->id_turma);
        $classe = $turma->classe->classe;
        $id_ensino = $turma->curso->id_ensino;


        if ($id_ensino == 1) {
            if (($classe == "Iniciação")) {
                $templateProcessor = new \PhpOffice\PhpWord\TemplateProcessor('word_models/termos/ensino_primario_ini_1_3_5_copy.docx');
            } elseif (($classe == "2ª classe") || ($classe == "4ª classe") || ($classe == "1ª classe") || ($classe == "3ª classe") || ($classe == "5ª classe")|| ($classe == "Módulo 1") || ($classe == "Módulo 2")) {
                $templateProcessor = new \PhpOffice\PhpWord\TemplateProcessor('word_models/termos/ensino_primario_2_4_copy.docx');
            } elseif (($classe == "6ª classe") || ($classe == "Módulo 3")) {
                $templateProcessor = new \PhpOffice\PhpWord\TemplateProcessor('word_models/termos/ensino_primario_6_copy.docx');
            }
        } elseif ($id_ensino == 2) {
            if ($classe == "9ª classe") {
                $templateProcessor = new \PhpOffice\PhpWord\TemplateProcessor('word_models/termos/ensino_1ciclo_9_copy.docx');
            } elseif (($classe == "7ª classe") || ($classe == "8ª classe")) {
                $templateProcessor = new \PhpOffice\PhpWord\TemplateProcessor('word_models/termos/ensino_1ciclo_7_8_copy.docx');
            }
        }

        /**variaveis */
        $nome = "[##############]";
        $pai = "[##############]";
        $mae = "[##############]";
        $dia = "[##############]";
        $mes = "[##############]";
        $ano = "[##############]";

        $dia_hoje = "[#####]";
        $mes_hoje = "[#####]";
        $ano_hoje = "[#####]";

        $naturalidade = "[##############]";
        $provincia = "[##############]";
        $ano_lectivo = "[##############]";
        $classe = "[##############]";
        $turmaF = "[##############]";
        $numero = "[##############]";
        $bairro = "[##############]";
        $bilhete = "[##############]";
        $cidade = "[##############]";
        $encarregado = "[##############]";
        $telefone = "[##############]";
        $municipio = "[##############]";
        $processo = "[##############]";
        $resultado_final = "[##############]";
        /**fim variaveis */

        /**variaveis das notas */
        $mt1 = "[##]";
        $mt2 = "[##]";
        $mt3 = "[##]";
        $mfd = "[##]";
        $mf = "[##]";
        /**fim */

        /**atribuindo valores nas variaveis */
        $mes1 = date('m', strtotime($historico->estudante->pessoa->data_nascimento));
        $mes = ControladorStatic::converterMesExtensao($mes1);
        $dia = date('d', strtotime($historico->estudante->pessoa->data_nascimento));
        $ano = date('Y', strtotime($historico->estudante->pessoa->data_nascimento));

        $nome = $historico->estudante->pessoa->nome;
        if ($historico->estudante->pessoa->pai) {
            $pai = $historico->estudante->pessoa->pai;
        }
        if ($historico->estudante->pessoa->mae) {
            $mae = $historico->estudante->pessoa->mae;
        }
        if ($historico->estudante->pessoa->bilhete) {
            $bilhete = $historico->estudante->pessoa->bilhete;
        }
        if ($historico->estudante->pessoa->naturalidade) {
            $naturalidade = $historico->estudante->pessoa->naturalidade;
        }
        if ($historico->estudante->pessoa->municipio->provincia->provincia) {
            $provincia = $historico->estudante->pessoa->municipio->provincia->provincia;
        }
        if ($historico->estudante->pessoa->bairro) {
            $bairro = $historico->estudante->pessoa->bairro;
        }
        if ($historico->estudante->pessoa->municipio) {
            $municipio = $historico->estudante->pessoa->municipio->municipio;
        }
        if ($historico->estudante->pessoa->comuna) {
            $cidade = $historico->estudante->pessoa->comuna;
        }
        if ($historico->estudante->encarregado->pessoa->nome) {
            $encarregado = $historico->estudante->encarregado->pessoa->nome;
        }
        if ($historico->estudante->encarregado->pessoa->telefone) {
            $telefone = $historico->estudante->encarregado->pessoa->telefone;
        }
        if ($historico->obs_pauta) {
            $resultado_final = $historico->obs_pauta;
        }


        $numero = $historico->numero;
        $turmaF = $historico->turma->turma;
        $classe = $historico->turma->classe->classe;
        $ano_lectivo = $historico->ano_lectivo;
        $processo = $historico->id_estudante;

        $dia_hoje = date('d');
        $mes2 = date('m');
        $mes_hoje = ControladorStatic::converterMesExtensao($mes2);
        $ano_hoje = date('Y');
        /**fim */

        // Variables on different parts of document
        $templateProcessor->setValue('nome', $nome);            // On section/content
        $templateProcessor->setValue('pai', $pai);
        $templateProcessor->setValue('mae', $mae);
        $templateProcessor->setValue('dia', $dia);            // On section/content
        $templateProcessor->setValue('mes', $mes);
        $templateProcessor->setValue('ano', $ano);
        $templateProcessor->setValue('naturalidade', $naturalidade);            // On section/content
        $templateProcessor->setValue('provincia', $provincia);
        $templateProcessor->setValue('ano_lectivo', $ano_lectivo);
        $templateProcessor->setValue('classe', $classe);            // On section/content
        $templateProcessor->setValue('turma', $turmaF);
        $templateProcessor->setValue('numero', $numero);
        $templateProcessor->setValue('bi', $bilhete);           // On footer
        $templateProcessor->setValue('bairro', $bairro);
        $templateProcessor->setValue('municipio', $municipio);
        $templateProcessor->setValue('cidade', $cidade);
        $templateProcessor->setValue('encarregado', $encarregado);
        $templateProcessor->setValue('telefone', $telefone);
        $templateProcessor->setValue('processo', $processo);
        $templateProcessor->setValue('classe', $classe);

        $templateProcessor->setValue('dia_hoje', $dia_hoje);            // On section/content
        $templateProcessor->setValue('mes_hoje', $mes_hoje);
        $templateProcessor->setValue('ano_hoje', $ano_hoje);

        $templateProcessor->setValue('resultado_final', $resultado_final);
        // On header


        //verificar se selecionou a ordem das disciplinas
        $ordena_disciplina = null;
        if (!Session::has('disciplinas')) {
            $ordena_disciplina = OrdernaDisciplina::where(['id_curso' => $turma->id_curso, 'id_classe' => $turma->id_classe])->get();
        }

        /**trabalhando nas notas */

        $values = [];
        if (!$ordena_disciplina) {
            if (($id_ensino == 1) && (($classe == "Iniciação"))) { //para notas qualitativa
                foreach (Session::get('disciplinas') as $disciplina) {
                    $getDisciplina = ControladorStatic::getDisciplinaID($disciplina['id_disciplina']);
                    $trimestre1 = ControladorNotas::getValoresMiniPautaTrimestralPDF($disciplina['id_disciplina'], $historico->id_estudante, 1, $historico->ano_lectivo);
                    if ($trimestre1->count() >= 1) {
                        foreach ($trimestre1 as $t1) {
                            if ($t1 != null) {
                                $mt1 = ControladorNotas::estado_nota_qualitativa($t1->mt);
                            } else {
                                $mt1 = "[##]";
                            }
                        }
                    }

                    $trimestre2 = ControladorNotas::getValoresMiniPautaTrimestralPDF($disciplina['id_disciplina'], $historico->id_estudante, 2, $historico->ano_lectivo);
                    if ($trimestre2->count() >= 1) {
                        foreach ($trimestre2 as $t2) {
                            if ($t2 != null) {
                                $mt2 = ControladorNotas::estado_nota_qualitativa($t2->mt);
                            } else {
                                $mt2 = "[##]";
                            }
                        }
                    }

                    $trimestre3 = ControladorNotas::getValoresMiniPautaTrimestralPDF($disciplina['id_disciplina'], $historico->id_estudante, 3, $historico->ano_lectivo);
                    if ($trimestre3->count() >= 1) {
                        foreach ($trimestre3 as $t3) {
                            if ($t3 != null) {
                                $mt3 = ControladorNotas::estado_nota_qualitativa($t3->mt);
                            } else {
                                $mt3 = "[##]";
                            }
                        }
                    }

                    $final = ControladorNotas::getValoresPautaFinalPDF($historico->id_estudante, $disciplina['id_disciplina'], $historico->ano_lectivo);
                    if ($final->count() >= 1) {
                        foreach ($final as $f) {
                            if ($f != null) {
                                $mfd = ControladorNotas::estado_nota_qualitativa($f->mfd);
                                $mf = ControladorNotas::estado_nota_qualitativa($f->mf);
                            } else {
                                $mfd = "[##]";
                                $mf = "[##]";
                            }
                        }
                    }
                    array_push($values, ['disciplinas' => $getDisciplina->disciplina, 'mt1' => $mt1, 'mt2' => $mt2, 'mt3' => $mt3, 'mfd' => $mfd, 'mf' => $mf]);

                    $mfd = "[##]";
                    $mf = "[##]";
                    $mt3 = "[##]";
                    $mt2 = "[##]";
                    $mt1 = "[##]";
                }
            } else { //para notas quantitativa
                foreach (Session::get('disciplinas') as $disciplina) {
                    $getDisciplina = ControladorStatic::getDisciplinaID($disciplina['id_disciplina']);
                    $trimestre1 = ControladorNotas::getValoresMiniPautaTrimestralPDF($disciplina['id_disciplina'], $historico->id_estudante, 1, $historico->ano_lectivo);
                    if ($trimestre1->count() >= 1) {
                        foreach ($trimestre1 as $t1) {
                            if ($t1 != null) {
                                $mt1 = str_pad($t1->mt, 2, 0, STR_PAD_LEFT);
                            } else {
                                $mt1 = "[##]";
                            }
                        }
                    }

                    $trimestre2 = ControladorNotas::getValoresMiniPautaTrimestralPDF($disciplina['id_disciplina'], $historico->id_estudante, 2, $historico->ano_lectivo);
                    if ($trimestre2->count() >= 1) {
                        foreach ($trimestre2 as $t2) {
                            if ($t2 != null) {
                                $mt2 = str_pad($t2->mt, 2, 0, STR_PAD_LEFT);
                            } else {
                                $mt2 = "[##]";
                            }
                        }
                    }

                    $trimestre3 = ControladorNotas::getValoresMiniPautaTrimestralPDF($disciplina['id_disciplina'], $historico->id_estudante, 3, $historico->ano_lectivo);
                    if ($trimestre3->count() >= 1) {
                        foreach ($trimestre3 as $t3) {
                            if ($t3 != null) {
                                $mt3 = str_pad($t3->mt, 2, 0, STR_PAD_LEFT);
                            } else {
                                $mt3 = "[##]";
                            }
                        }
                    }

                    $final = ControladorNotas::getValoresPautaFinalPDF($historico->id_estudante, $disciplina['id_disciplina'], $historico->ano_lectivo);
                    if ($final->count() >= 1) {
                        foreach ($final as $f) {
                            if ($f != null) {
                                $mfd = str_pad($f->mfd, 2, 0, STR_PAD_LEFT);
                                $mf = str_pad($f->mf, 2, 0, STR_PAD_LEFT);
                            } else {
                                $mfd = "[##]";
                                $mf = "[##]";
                            }
                        }
                    }
                    array_push($values, ['disciplinas' => $getDisciplina->disciplina, 'mt1' => $mt1, 'mt2' => $mt2, 'mt3' => $mt3, 'mfd' => $mfd, 'mf' => $mf]);

                    $mfd = "[##]";
                    $mf = "[##]";
                    $mt3 = "[##]";
                    $mt2 = "[##]";
                    $mt1 = "[##]";
                }
            }
        } else {
            if (($id_ensino == 1) && (($classe == "Iniciação"))) { //para notas qualitativa
                foreach ($ordena_disciplina as $disciplina) {
                    $getDisciplina = ControladorStatic::getDisciplinaID($disciplina->id_disciplina);
                    $trimestre1 = ControladorNotas::getValoresMiniPautaTrimestralPDF($disciplina->id_disciplina, $historico->id_estudante, 1, $historico->ano_lectivo);
                    if ($trimestre1->count() >= 1) {
                        foreach ($trimestre1 as $t1) {
                            if ($t1 != null) {
                                $mt1 = ControladorNotas::estado_nota_qualitativa($t1->mt);
                            } else {
                                $mt1 = "[##]";
                            }
                        }
                    }

                    $trimestre2 = ControladorNotas::getValoresMiniPautaTrimestralPDF($disciplina->id_disciplina, $historico->id_estudante, 2, $historico->ano_lectivo);
                    if ($trimestre2->count() >= 1) {
                        foreach ($trimestre2 as $t2) {
                            if ($t2 != null) {
                                $mt2 = ControladorNotas::estado_nota_qualitativa($t2->mt);
                            } else {
                                $mt2 = "[##]";
                            }
                        }
                    }

                    $trimestre3 = ControladorNotas::getValoresMiniPautaTrimestralPDF($disciplina->id_disciplina, $historico->id_estudante, 3, $historico->ano_lectivo);
                    if ($trimestre3->count() >= 1) {
                        foreach ($trimestre3 as $t3) {
                            if ($t3 != null) {
                                $mt3 = ControladorNotas::estado_nota_qualitativa($t3->mt);
                            } else {
                                $mt3 = "[##]";
                            }
                        }
                    }

                    $final = ControladorNotas::getValoresPautaFinalPDF($historico->id_estudante, $disciplina->id_disciplina, $historico->ano_lectivo);
                    if ($final->count() >= 1) {
                        foreach ($final as $f) {
                            if ($f != null) {
                                $mfd = ControladorNotas::estado_nota_qualitativa($f->mfd);
                                $mf = ControladorNotas::estado_nota_qualitativa($f->mf);
                            } else {
                                $mfd = "[##]";
                                $mf = "[##]";
                            }
                        }
                    }
                    array_push($values, ['disciplinas' => $getDisciplina->disciplina, 'mt1' => $mt1, 'mt2' => $mt2, 'mt3' => $mt3, 'mfd' => $mfd, 'mf' => $mf]);

                    $mfd = "[##]";
                    $mf = "[##]";
                    $mt3 = "[##]";
                    $mt2 = "[##]";
                    $mt1 = "[##]";
                }
            } else { //para notas quantitativa
                foreach ($ordena_disciplina as $disciplina) {
                    $getDisciplina = ControladorStatic::getDisciplinaID($disciplina->id_disciplina);
                    $trimestre1 = ControladorNotas::getValoresMiniPautaTrimestralPDF($disciplina->id_disciplina, $historico->id_estudante, 1, $historico->ano_lectivo);
                    if ($trimestre1->count() >= 1) {
                        foreach ($trimestre1 as $t1) {
                            if ($t1 != null) {
                                $mt1 = str_pad($t1->mt, 2, 0, STR_PAD_LEFT);
                            } else {
                                $mt1 = "[##]";
                            }
                        }
                    }

                    $trimestre2 = ControladorNotas::getValoresMiniPautaTrimestralPDF($disciplina->id_disciplina, $historico->id_estudante, 2, $historico->ano_lectivo);
                    if ($trimestre2->count() >= 1) {
                        foreach ($trimestre2 as $t2) {
                            if ($t2 != null) {
                                $mt2 = str_pad($t2->mt, 2, 0, STR_PAD_LEFT);
                            } else {
                                $mt2 = "[##]";
                            }
                        }
                    }

                    $trimestre3 = ControladorNotas::getValoresMiniPautaTrimestralPDF($disciplina->id_disciplina, $historico->id_estudante, 3, $historico->ano_lectivo);
                    if ($trimestre3->count() >= 1) {
                        foreach ($trimestre3 as $t3) {
                            if ($t3 != null) {
                                $mt3 = str_pad($t3->mt, 2, 0, STR_PAD_LEFT);
                            } else {
                                $mt3 = "[##]";
                            }
                        }
                    }

                    $final = ControladorNotas::getValoresPautaFinalPDF($historico->id_estudante, $disciplina->id_disciplina, $historico->ano_lectivo);
                    if ($final->count() >= 1) {
                        foreach ($final as $f) {
                            if ($f != null) {
                                $mfd = str_pad($f->mfd, 2, 0, STR_PAD_LEFT);
                                $mf = str_pad($f->mf, 2, 0, STR_PAD_LEFT);
                            } else {
                                $mfd = "[##]";
                                $mf = "[##]";
                            }
                        }
                    }
                    array_push($values, ['disciplinas' => $getDisciplina->disciplina, 'mt1' => $mt1, 'mt2' => $mt2, 'mt3' => $mt3, 'mfd' => $mfd, 'mf' => $mf]);

                    $mfd = "[##]";
                    $mf = "[##]";
                    $mt3 = "[##]";
                    $mt2 = "[##]";
                    $mt1 = "[##]";
                }
            }
        }

        $templateProcessor->cloneRowAndSetValues('disciplinas', $values);
        /**fim */

        $filename = $historico->estudante->pessoa->nome . "termo.docx";
        try {
            $templateProcessor->saveAs('word_models/termos/' . $filename . '.docx');
        } catch (\Exception $e) {
            echo $e->getMessage();
        }
        return response()->download('word_models/termos/' . $filename . '.docx')->deleteFileAfterSend(true);
    }
}