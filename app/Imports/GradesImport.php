<?php

namespace App\Imports;

use App\Grade;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\SkipsErrors;
use Maatwebsite\Excel\Concerns\SkipsOnError;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithChunkReading;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;

class GradesImport implements
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
            'id_componente' => 1,
            'disciplina' => null,
            'sigla' => null,
        ];

        foreach ($rows as $row) {
            if (!Grade::where(['disciplina' => $row['disciplina']])->first()) {
                $data['disciplina'] = $row['disciplina'];
                $data['sigla'] = $row['sigla'];

                $disciplina = Grade::create($data);
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