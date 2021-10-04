<?php

namespace App\Exports;

use App\DirectorTurma;
use Illuminate\Contracts\Support\Responsable;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class DirectorExport implements FromView, ShouldAutoSize
{
    use Exportable;

    public function view(): View
    {
        $grades = DirectorTurma::all();

        $data = [
            'getDirectores'=>$grades,
        ];
        return view('institucional.directores.export', $data);
    }
}