<?php

namespace App\Http\Controllers;

use App\Declaracao;
use App\HistoricEstudante;
use Illuminate\Http\Request;

class PhpWordController extends Controller
{
    public function declaracaosemnota($id_declaracao){

        $declaracao = Declaracao::find($id_declaracao);
        if (!$declaracao) {
            return back()->with(['error' => "Não encontrou declaração"]);
        }

        $historico = HistoricEstudante::where(['id_estudante' => $declaracao->id_estudante, 'ano_lectivo' => $declaracao->ano_lectivo])->first();
        if (!$historico) {
            return back()->with(['error' => "Não encontrou estudante"]);
        }

        $templateProcessor = new \PhpOffice\PhpWord\TemplateProcessor('word_models/declaracaosemnota.docx');

        // Variables on different parts of document
        $templateProcessor->setValue('nome', $historico->estudante->pessoa->nome);            // On section/content
        $templateProcessor->setValue('pai', $historico->estudante->pessoa->pai);
        $templateProcessor->setValue('mae', $historico->estudante->pessoa->mae);           // On footer
        // On header
        $filename = $historico->estudante->pessoa->nome."declaracaosemnota.docx";
        try {
            $templateProcessor->saveAs('word_models/'.$filename.'.docx');
        } catch (\Exception $e) {
            echo $e->getMessage();
        }
        return response()->download('word_models/'.$filename . '.docx')->deleteFileAfterSend(true);
    }
}