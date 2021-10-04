<?php

namespace App\Exports;

use App\Funcionario;
use Maatwebsite\Excel\Concerns\FromCollection;

class FuncionarioExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Funcionario::all();
    }
}
