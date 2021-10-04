<?php

namespace App\Imports;

use App\Horario;
use Maatwebsite\Excel\Concerns\ToModel;

class HorarioImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new Horario([
            //
        ]);
    }
}
