<?php

namespace App\Http\Controllers;

use App\Declaracao;
use App\HistoricEstudante;
use Illuminate\Http\Request;
use App\Http\Controllers\ControladorStatic;
use App\Turma;

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
        if ($historico->estudante->pessoa->provincia) {
            $provincia = $historico->estudante->pessoa->provincia;
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
            if (($classe == "Iniciação") || ($classe == "1ª classe") || ($classe == "3ª classe") || ($classe == "5ª classe")) {
            } elseif ($classe == "6ª classe") {
            }
        } elseif ($id_ensino == 2) {
            if ($classe == "9ª classe") {
            } elseif (($classe == "7ª classe") || ($classe == "8ª classe")) {
                $templateProcessor = new \PhpOffice\PhpWord\TemplateProcessor('word_models/declaracao_notas/ensino_1ciclo_7_8_copy.docx');
            }
        }

    }
}