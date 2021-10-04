<?php

namespace App\Exports;

use App\Horario;
use Maatwebsite\Excel\Concerns\FromCollection;

class HorarioExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Horario::all();
    }
}
