<?php

namespace App\Imports;

use App\DirectorTurma;
use Maatwebsite\Excel\Concerns\ToModel;

class DirectorImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new DirectorTurma([
            //
        ]);
    }
}
