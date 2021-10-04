<?php

namespace App\Exports;

use App\Funcionario;
use Illuminate\Contracts\Support\Responsable;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class FuncionarioExport implements FromView, ShouldAutoSize
{
    use Exportable;

    public function view(): View
    {
        $funcionarios = Funcionario::all();

        $data = [
            'getFuncionarios'=>$funcionarios,
        ];
        return view('funcionarios.export', $data);
    }
}