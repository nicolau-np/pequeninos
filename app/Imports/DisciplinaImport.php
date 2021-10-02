<?php

namespace App\Imports;

use App\Disciplina;
use Maatwebsite\Excel\Concerns\ToModel;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\SkipsErrors;
use Maatwebsite\Excel\Concerns\SkipsOnError;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithChunkReading;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;


class DisciplinaImport implements
    ToCollection,
    WithHeadingRow,
    SkipsOnError,
    WithValidation,
    WithChunkReading,
    ShouldQueue
{
    use Importable, SkipsErrors;

    public function collection(Collection $rows)
    {

        $data = [
            'id_componente'=>1,
            'disciplina'=>null,
            'sigla'=>null,
        ];

        foreach ($rows as $row) {
            if (!Disciplina::where(['disciplina' => $row['disciplina']])->first()) {
                $data['disciplina'] = $row['disciplina'];
                $data['sigla'] = $row['sigla'];
                
                $disciplina = Disciplina::create($data);
            }
        }
    }


    public function rules(): array
    {
        return [];
    }

    public function chunkSize(): int
    {
        return 1000;
    }
}