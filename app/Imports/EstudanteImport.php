<?php

namespace App\Imports;

use App\Estudante;
use Maatwebsite\Excel\Concerns\ToModel;

class EstudanteImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new Estudante([
            //
        ]);
    }
}
