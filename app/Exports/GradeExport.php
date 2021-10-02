<?php

namespace App\Exports;

use App\Grade;
use Illuminate\Contracts\Support\Responsable;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class GradeExport implements FromView, ShouldAutoSize
{
    use Exportable;

    public function view(): View
    {
        $grades = Grade::all();

        $data = [
            'getGrades'=>$grades,
        ];
        return view('institucional.grades.export', $data);
    }
}