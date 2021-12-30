<?php

namespace App\Http\Controllers;

use App\AnoLectivo;
use App\HistoricEstudante;
use App\Turma;
use Illuminate\Http\Request;

class ExcelController extends Controller
{
    public function lista_nominal($turma, $ano_lectivo)
    {
        $turmas = Turma::find($turma);
        if (!$turmas) {
            return back()->with(['error' => "Nao encontrou"]);
        }
        $anos = AnoLectivo::where(['ano_lectivo' => $ano_lectivo])->first();
        if (!$anos) {
            return back()->with(['error' => "Não encontrou"]);
        }
        $historico = HistoricEstudante::whereHas('estudante.pessoa', function () {
        })->where(['id_turma' => $turma, 'ano_lectivo' => $ano_lectivo])
            ->orderBy('numero', 'asc')->get();
        $data = [
            'getHistorico' => $historico,
            'getAno' => $ano_lectivo,
            'getTurma' => $turma,
        ];
        $arquivo_saida = "Lista Nominal " . $turmas->turma . "-" . $ano_lectivo . ".xls";


        // configuracao header para forcar download
        header("Expires: Mon, 26 Jul 1997 05:00:00 GMT");
        header("Last-Modified:" . gmdate("D,d M YH:i:s") . "GMT");
        header("Cache-Control: no-cache, must-revalidate");
        header("Pragma: no-cache");
        header("Content-type: application/x-msexcel");
        header("Content-Disposition: attachment; filename=\"{$arquivo_saida}\"");
        header("Content-Description: PHP Generated Data");
        //fim
        return view('excel.lista_nominal', $data);
    }
}