<?php

namespace App\Exports;

use App\HistoricEstudante;
use App\Turma;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\Exportable;

class Pauta implements FromView, ShouldAutoSize
{
    use Exportable;
    private $id_turma;
    private $ano_lectivo;

    public function __construct($id_turma, $ano_lectivo)
    {
        $this->id_turma = $id_turma;
        $this->ano_lectivo = $ano_lectivo;
    }

    public function view(): View
    {
        $turma = Turma::find($this->turma);
        $id_ensino = $turma->classe->id_ensino;
        $historico = HistoricEstudante::where([
            'id_turma' => $this->id_turma,
            'ano_lectivo' => $this->ano_lectivo
        ])->get()->sortby('estudante.pessoa.nome');

        $data = [
            'getHistorico'=>$historico,
        ];
        if ($id_ensino == 1) {
            return "ensino primario iniciacao ate 6 classe";
        } else{
            return view('pauta.ensino_1ciclo_7_9_export', $data);
        }

    }
}
