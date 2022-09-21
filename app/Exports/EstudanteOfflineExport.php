<?php

namespace App\Exports;

use App\Estudante;
use App\AnoLectivo;
use Illuminate\Contracts\Support\Responsable;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Session;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class EstudanteOfflineExport implements FromView, ShouldAutoSize
{
    use Exportable;


    public function view(): View
    {
        $ano_lectivo = Session::get('ano_lectivoEx');
        $turma = Session::get('turmaEx');
        $estudantes = Estudante::where(['id_turma' => $turma, 'ano_lectivo'=>$ano_lectivo])->orderBy('numero', 'asc')->get();

        $data = [
            'getEstudantes' => $estudantes,
        ];
        return view('offlineOnlineExport.estudantes', $data);
    }
}
