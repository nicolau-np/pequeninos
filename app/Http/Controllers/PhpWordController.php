<?php

namespace App\Http\Controllers;

use App\Declaracao;
use App\HistoricEstudante;
use Illuminate\Http\Request;

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
        $dia_hoje="[##############]";
        $mes_hoje="[##############]";
        $ano_hoje="[##############]";
        $bilhete = "[##############]";
        /**fim variaveis */


        /**atribuindo valores nas variaveis */
            
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
}