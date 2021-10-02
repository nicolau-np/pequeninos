<?php

namespace App\Exports;

use App\Grade;
use Maatwebsite\Excel\Concerns\FromCollection;

class GradeExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Grade::all();
    }
}
