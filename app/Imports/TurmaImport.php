<?php

namespace App\Imports;

use App\Turma;
use Maatwebsite\Excel\Concerns\ToModel;

class TurmaImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new Turma([
            //
        ]);
    }
}
