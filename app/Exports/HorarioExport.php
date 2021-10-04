<?php

namespace App\Exports;

use App\Horario;
use Illuminate\Contracts\Support\Responsable;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class HorarioExport implements FromView, ShouldAutoSize
{
    use Exportable;

    public function view(): View
    {
        $horarios = Horario::all();

        $data = [
            'getHorarios'=>$horarios,
        ];
        return view('horarios.export', $data);
    }
}
