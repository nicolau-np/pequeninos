<?php

namespace App\Imports;

use App\Disciplina;
use Maatwebsite\Excel\Concerns\ToModel;

class DisciplinaImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new Disciplina([
            //
        ]);
    }
}
