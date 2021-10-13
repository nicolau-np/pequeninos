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

        $templateProcessor = new \PhpOffice\PhpWord\TemplateProcessor('word_models/example.docx');

        // Variables on different parts of document
        $templateProcessor->setValue('id', $user->id);            // On section/content
        $templateProcessor->setValue('username', $user->username);             // On footer
        // On header
        $filename = "";
        try {
            $templateProcessor->saveAs('word_models/'.$filename.'.docx');
        } catch (\Exception $e) {
            echo $e->getMessage();
        }
        return response()->download('word_models/'.$filename . '.docx')->deleteFileAfterSend(true);
    }
}