<?php

namespace App\Exports;

use App\Estudante;
use App\HistoricEstudante;
use App\Turma;
use Illuminate\Contracts\Support\Responsable;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class EstudanteExport implements FromView, ShouldAutoSize
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
        $historico = HistoricEstudante::where([
            'id_turma'=>$this->id_turma,
            'ano_lectivo'=>$this->ano_lectivo,
        ])->get()->sortBy('estudante.pessoa.nome');

        $turma = Turma::find($this->id_turma);
        
        $data = [
            'getAno'=>$this->ano_lectivo,
            'getHistorico'=>$historico,
            'getTurma'=>$turma,
        ];
        return view('relatorios.lista_nominal', $data);
    }
}